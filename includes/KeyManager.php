<?php
/**
 * License Key Manager for HOQQDMD
 * Handles key generation, assignment, and validation
 */

class KeyManager {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Generate a unique license key
     */
    public function generateKey($productId) {
        $prefix = ($productId == 1) ? 'HOQQ1' : 'HOQQ2';
        
        do {
            // Generate key format: HOQQ1-XXXXX-XXXXX-XXXXX
            $key = $prefix . '-' . 
                   $this->randomString(5) . '-' . 
                   $this->randomString(5) . '-' . 
                   $this->randomString(5);
            
            // Check if key already exists
            $stmt = $this->db->prepare("SELECT id FROM license_keys WHERE key_value = ?");
            $stmt->bind_param("s", $key);
            $stmt->execute();
            $result = $stmt->get_result();
        } while ($result->num_rows > 0);
        
        return $key;
    }
    
    /**
     * Generate random alphanumeric string
     */
    private function randomString($length) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
    
    /**
     * Assign a key to user when they subscribe
     */
    public function assignKeyToUser($userId, $productId, $expiryDate) {
        // Start transaction
        $this->db->begin_transaction();
        
        try {
            // First try to find an available pre-generated key
            $stmt = $this->db->prepare("
                SELECT id, key_value 
                FROM license_keys 
                WHERE product_id = ? 
                AND status = 'available' 
                AND user_id IS NULL 
                LIMIT 1 
                FOR UPDATE
            ");
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Use existing available key
                $keyData = $result->fetch_assoc();
                $keyId = $keyData['id'];
                $keyValue = $keyData['key_value'];
                
                // Update the key assignment
                $stmt = $this->db->prepare("
                    UPDATE license_keys 
                    SET user_id = ?, 
                        activated_at = NOW(), 
                        expires_at = ?,
                        status = 'active'
                    WHERE id = ?
                ");
                $stmt->bind_param("isi", $userId, $expiryDate, $keyId);
                $stmt->execute();
            } else {
                // Generate new key if no available keys
                $keyValue = $this->generateKey($productId);
                
                // Insert new key
                $stmt = $this->db->prepare("
                    INSERT INTO license_keys 
                    (key_value, product_id, user_id, activated_at, expires_at, status)
                    VALUES (?, ?, ?, NOW(), ?, 'active')
                ");
                $stmt->bind_param("siis", $keyValue, $productId, $userId, $expiryDate);
                $stmt->execute();
                $keyId = $this->db->insert_id;
            }
            
            // Commit transaction
            $this->db->commit();
            
            return [
                'success' => true,
                'key_id' => $keyId,
                'key_value' => $keyValue
            ];
            
        } catch (Exception $e) {
            // Rollback on error
            $this->db->rollback();
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Validate a license key
     */
    public function validateKey($keyValue, $hwid = null) {
        $stmt = $this->db->prepare("
            SELECT k.*, u.username, p.name as product_name
            FROM license_keys k
            JOIN users u ON k.user_id = u.id
            JOIN products p ON k.product_id = p.id
            WHERE k.key_value = ?
        ");
        $stmt->bind_param("s", $keyValue);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 0) {
            return ['valid' => false, 'error' => 'Invalid key'];
        }
        
        $keyData = $result->fetch_assoc();
        
        // Check if key is active
        if ($keyData['status'] != 'active') {
            return ['valid' => false, 'error' => 'Key is ' . $keyData['status']];
        }
        
        // Check expiry
        if (strtotime($keyData['expires_at']) < time()) {
            // Update status to expired
            $stmt = $this->db->prepare("UPDATE license_keys SET status = 'expired' WHERE id = ?");
            $stmt->bind_param("i", $keyData['id']);
            $stmt->execute();
            
            return ['valid' => false, 'error' => 'Key has expired'];
        }
        
        // Check HWID binding
        if ($hwid) {
            if ($keyData['hwid'] === null) {
                // First time use, bind HWID
                $stmt = $this->db->prepare("UPDATE license_keys SET hwid = ? WHERE id = ?");
                $stmt->bind_param("si", $hwid, $keyData['id']);
                $stmt->execute();
            } elseif ($keyData['hwid'] !== $hwid) {
                // HWID mismatch
                $this->logKeyAction($keyData['id'], $keyData['user_id'], 'hwid_changed', $hwid);
                return ['valid' => false, 'error' => 'Key is bound to different hardware'];
            }
        }
        
        // Update last used and usage count
        $stmt = $this->db->prepare("
            UPDATE license_keys 
            SET last_used = NOW(), usage_count = usage_count + 1 
            WHERE id = ?
        ");
        $stmt->bind_param("i", $keyData['id']);
        $stmt->execute();
        
        // Log successful validation
        $this->logKeyAction($keyData['id'], $keyData['user_id'], 'used', $hwid);
        
        return [
            'valid' => true,
            'username' => $keyData['username'],
            'product' => $keyData['product_name'],
            'expires_at' => $keyData['expires_at'],
            'days_remaining' => floor((strtotime($keyData['expires_at']) - time()) / 86400)
        ];
    }
    
    /**
     * Log key actions
     */
    private function logKeyAction($keyId, $userId, $action, $hwid = null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $stmt = $this->db->prepare("
            INSERT INTO key_logs (key_id, user_id, action, ip_address, hwid, created_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->bind_param("iisss", $keyId, $userId, $action, $ip, $hwid);
        $stmt->execute();
    }
    
    /**
     * Get user's active keys
     */
    public function getUserKeys($userId) {
        $stmt = $this->db->prepare("
            SELECT k.*, p.name as product_name, p.type as product_type
            FROM license_keys k
            JOIN products p ON k.product_id = p.id
            WHERE k.user_id = ? 
            AND k.status IN ('active', 'suspended')
            ORDER BY k.expires_at DESC
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Suspend a key
     */
    public function suspendKey($keyId, $adminId, $reason) {
        $stmt = $this->db->prepare("
            UPDATE license_keys 
            SET status = 'suspended' 
            WHERE id = ?
        ");
        $stmt->bind_param("i", $keyId);
        $success = $stmt->execute();
        
        if ($success) {
            // Log admin action
            $stmt = $this->db->prepare("
                INSERT INTO admin_logs (admin_id, action, target_type, target_id, details)
                VALUES (?, 'suspend_key', 'license_key', ?, ?)
            ");
            $stmt->bind_param("iis", $adminId, $keyId, $reason);
            $stmt->execute();
        }
        
        return $success;
    }
    
    /**
     * Check and update expired keys
     */
    public function updateExpiredKeys() {
        $stmt = $this->db->prepare("
            UPDATE license_keys 
            SET status = 'expired' 
            WHERE status = 'active' 
            AND expires_at < NOW()
        ");
        return $stmt->execute();
    }
}
?>

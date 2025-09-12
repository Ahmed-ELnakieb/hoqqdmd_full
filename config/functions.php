<?php
/**
 * Helper Functions
 * Common functions used throughout the application
 */

/**
 * Sanitize input data
 */
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Validate email
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Generate random string
 */
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)))), 1, $length);
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Check if admin is logged in
 */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

/**
 * Redirect to URL
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * Display alert message
 */
function showAlert($message, $type = 'info') {
    $alertTypes = [
        'success' => 'alert-success',
        'error' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-info'
    ];
    
    $alertClass = isset($alertTypes[$type]) ? $alertTypes[$type] : 'alert-info';
    
    return '<div class="alert ' . $alertClass . ' alert-dismissible fade show" role="alert">
                ' . $message . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
}

/**
 * Format date
 */
function formatDate($date, $format = 'F j, Y') {
    return date($format, strtotime($date));
}

/**
 * Format date time
 */
function formatDateTime($datetime, $format = 'F j, Y g:i A') {
    return date($format, strtotime($datetime));
}

/**
 * Get time ago
 */
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $current = time();
    $seconds = $current - $time;
    
    $intervals = [
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    ];
    
    foreach ($intervals as $seconds_per_unit => $unit) {
        $quotient = floor($seconds / $seconds_per_unit);
        if ($quotient >= 1) {
            $plural = ($quotient > 1) ? 's' : '';
            return $quotient . ' ' . $unit . $plural . ' ago';
        }
    }
    
    return 'just now';
}

/**
 * Upload image
 */
function uploadImage($file, $target_dir = "uploads/") {
    $target_file = $target_dir . time() . '_' . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is actual image
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        return ['success' => false, 'message' => 'File is not an image.'];
    }
    
    // Check file size (5MB max)
    if ($file["size"] > 5242880) {
        return ['success' => false, 'message' => 'File is too large. Max size is 5MB.'];
    }
    
    // Allow certain file formats
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if(!in_array($imageFileType, $allowed_types)) {
        return ['success' => false, 'message' => 'Only JPG, JPEG, PNG & GIF files are allowed.'];
    }
    
    // Upload file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ['success' => true, 'filename' => basename($target_file), 'path' => $target_file];
    } else {
        return ['success' => false, 'message' => 'Sorry, there was an error uploading your file.'];
    }
}

/**
 * Create pagination
 */
function createPagination($total_records, $current_page, $records_per_page = 10, $url = '') {
    $total_pages = ceil($total_records / $records_per_page);
    $pagination = '';
    
    if($total_pages > 1) {
        $pagination .= '<nav aria-label="Page navigation">';
        $pagination .= '<ul class="pagination justify-content-center">';
        
        // Previous button
        if($current_page > 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="'.$url.'?page='.($current_page-1).'">Previous</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
        }
        
        // Page numbers
        for($i = 1; $i <= $total_pages; $i++) {
            if($i == $current_page) {
                $pagination .= '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
            } else {
                $pagination .= '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
            }
        }
        
        // Next button
        if($current_page < $total_pages) {
            $pagination .= '<li class="page-item"><a class="page-link" href="'.$url.'?page='.($current_page+1).'">Next</a></li>';
        } else {
            $pagination .= '<li class="page-item disabled"><span class="page-link">Next</span></li>';
        }
        
        $pagination .= '</ul>';
        $pagination .= '</nav>';
    }
    
    return $pagination;
}

/**
 * Get user IP address
 */
function getUserIP() {
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/**
 * Log activity
 */
function logActivity($conn, $user_id, $activity, $type = 'info') {
    $ip_address = getUserIP();
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
    $sql = "INSERT INTO activity_logs (user_id, activity, type, ip_address, user_agent, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issss", $user_id, $activity, $type, $ip_address, $user_agent);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

/**
 * Send email
 */
function sendEmail($to, $subject, $message, $headers = '') {
    if(empty($headers)) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: HOQQDMD <noreply@hoqqdmd.com>' . "\r\n";
    }
    
    return mail($to, $subject, $message, $headers);
}

/**
 * Encrypt password
 */
function encryptPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Verify password
 */
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Generate SEO friendly URL
 */
function generateSlug($string) {
    $string = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $string = strtolower($string);
    $string = trim($string, '-');
    return $string;
}

/**
 * Get settings from database
 */
function getSettings($conn) {
    $settings = [];
    $sql = "SELECT * FROM settings";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
    }
    
    return $settings;
}

/**
 * Update setting
 */
function updateSetting($conn, $key, $value) {
    $sql = "UPDATE settings SET setting_value = ? WHERE setting_key = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $value, $key);
    return mysqli_stmt_execute($stmt);
}
?>

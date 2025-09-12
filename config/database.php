<?php
/**
 * Database Configuration and Connection Class
 * This file handles all database connections and configurations
 */

class Database {
    // Database credentials
    private $host = "localhost";
    private $db_name = "hoqqdmd_db";
    private $username = "root";
    private $password = "";
    private $conn;

    /**
     * Get database connection
     * @return PDO connection object
     */
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

/**
 * Alternative mysqli connection function for simpler usage
 */
function connectDB() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "hoqqdmd_db";
    
    $conn = mysqli_connect($host, $username, $password, $database);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    mysqli_set_charset($conn, "utf8");
    
    return $conn;
}

/**
 * Configuration settings array
 */
$config = [
    'site_name' => 'HOQQDMD Gaming Platform',
    'site_url' => 'http://localhost/hoqqdmd/',
    'admin_email' => 'admin@hoqqdmd.com',
    'items_per_page' => 10,
    'upload_path' => $_SERVER['DOCUMENT_ROOT'] . '/hoqqdmd/uploads/',
    'allowed_image_types' => ['jpg', 'jpeg', 'png', 'gif'],
    'max_file_size' => 5242880, // 5MB in bytes
    'session_timeout' => 3600, // 1 hour in seconds
    'timezone' => 'America/New_York'
];

// Set timezone
date_default_timezone_set($config['timezone']);

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

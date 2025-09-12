<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

// If admin is already logged in, redirect to dashboard
if(isAdminLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    
    if(empty($username) || empty($password)) {
        $error = 'Please enter username and password';
    } else {
        $conn = connectDB();
        
        // Check if admin table exists
        $check_table = mysqli_query($conn, "SHOW TABLES LIKE 'admins'");
        if(mysqli_num_rows($check_table) > 0) {
            $sql = "SELECT * FROM admins WHERE username = ? AND status = 'active'";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if(mysqli_num_rows($result) == 1) {
                $admin = mysqli_fetch_assoc($result);
                if(verifyPassword($password, $admin['password'])) {
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_username'] = $admin['username'];
                    $_SESSION['admin_name'] = $admin['name'];
                    
                    // Log the login
                    logActivity($conn, $admin['id'], 'Admin login', 'admin');
                    
                    redirect('dashboard.php');
                } else {
                    $error = 'Invalid username or password';
                }
            } else {
                $error = 'Invalid username or password';
            }
        } else {
            // For initial setup, use default credentials
            if($username == 'admin' && $password == 'admin123') {
                $_SESSION['admin_id'] = 1;
                $_SESSION['admin_username'] = 'admin';
                $_SESSION['admin_name'] = 'Administrator';
                redirect('dashboard.php');
            } else {
                $error = 'Invalid username or password. Default: admin/admin123';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HOQQDMD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .login-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .login-header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        .login-body {
            padding: 40px 30px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .input-group-text {
            background: transparent;
            border-right: none;
            border-radius: 8px 0 0 8px;
        }
        .form-control.with-icon {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: transform 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .remember-forgot a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }
        .remember-forgot a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 8px;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: #667eea;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-user-shield"></i> Admin Panel</h2>
            <p>HOQQDMD Gaming Platform</p>
        </div>
        <div class="login-body">
            <?php if($error): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control with-icon" id="username" name="username" required placeholder="Enter username">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control with-icon" id="password" name="password" required placeholder="Enter password">
                    </div>
                </div>
                
                <div class="remember-forgot">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <a href="#">Forgot Password?</a>
                </div>
                
                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="back-link">
                <a href="../home.php"><i class="fas fa-arrow-left"></i> Back to Website</a>
            </div>
        </div>
    </div>
</body>
</html>

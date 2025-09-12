<?php
require_once 'config/database.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all fields';
    } else {
        // Create database connection
        $database = new Database();
        $pdo = $database->getConnection();
        
        // Check user credentials
        $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            
            // Update last login
            $updateStmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $updateStmt->execute([$user['id']]);
            
            // Redirect to dashboard or requested page
            $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard.php';
            header('Location: ' . $redirect);
            exit();
        } else {
            $error = 'Invalid email/username or password';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HOQQDMD HOK Service</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-image: url('img/bg/header_background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('img/images/dots.png');
            background-repeat: repeat;
            z-index: -1;
        }
        .login-container {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            border: 2px solid #00d4ff;
            max-width: 450px;
            width: 100%;
            animation: slideInUp 0.5s ease-out;
        }
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            font-family: 'Oxanium', cursive;
            color: #00d4ff;
            font-size: 32px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .login-header p {
            color: #888;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            color: #00d4ff;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }
        .form-control {
            background: rgba(0,0,0,0.3);
            border: 1px solid #444;
            color: #fff;
            padding: 12px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .form-control:focus {
            background: rgba(0,0,0,0.5);
            border-color: #00d4ff;
            box-shadow: 0 0 10px rgba(200, 255, 11, 0.3);
            color: #fff;
        }
        .btn-login {
            background: #00d4ff;
            color: #1c1121;
            border: none;
            padding: 12px 30px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 5px;
            width: 100%;
            transition: all 0.3s;
            font-size: 16px;
            letter-spacing: 1px;
        }
        .btn-login:hover {
            background: #0099cc;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(200, 255, 11, 0.4);
        }
        .alert {
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid #dc3545;
            color: #ff6b6b;
        }
        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }
        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #444;
        }
        .divider span {
            background: rgba(31, 32, 41, 0.95);
            padding: 0 15px;
            color: #888;
            position: relative;
            font-size: 12px;
            text-transform: uppercase;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        .register-link a {
            color: #00d4ff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        .register-link a:hover {
            color: #0099cc;
            text-decoration: underline;
        }
        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-section img {
            height: 60px;
            filter: drop-shadow(0 5px 10px rgba(200, 255, 11, 0.3));
        }
        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .remember-forgot a {
            color: #888;
            text-decoration: none;
            transition: color 0.3s;
        }
        .remember-forgot a:hover {
            color: #00d4ff;
        }
        .custom-checkbox {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .custom-checkbox input[type="checkbox"] {
            margin-right: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <img src="img/logo/h6_logo.png" alt="HOQQDMD" style="width: 120px;">
        </div>
        
        <div class="login-header">
            <h2>Welcome Back</h2>
            <p>Login to access HOK premium services</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email or Username</label>
                <input type="text" class="form-control" id="email" name="email" 
                       placeholder="Enter your email or username" required
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Enter your password" required>
            </div>

            <div class="remember-forgot">
                <label class="custom-checkbox">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="forgot-password.php">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt"></i> Login Now
            </button>
        </form>

        <div class="divider">
            <span>or</span>
        </div>

        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register Now</a></p>
        </div>
    </div>

    <script src="js/vendor/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

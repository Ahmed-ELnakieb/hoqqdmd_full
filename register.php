<?php
require_once 'config/database.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$success = '';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = trim($_POST['phone'] ?? '');
    
    // Validation
    $errors = [];
    
    if (empty($username)) {
        $errors[] = 'Username is required';
    } elseif (strlen($username) < 3) {
        $errors[] = 'Username must be at least 3 characters long';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = 'Username can only contain letters, numbers, and underscores';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    if (empty($password)) {
        $errors[] = 'Password is required';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters long';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match';
    }
    
    if (empty($errors)) {
        // Create database connection
        $database = new Database();
        $pdo = $database->getConnection();
        
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        
        if ($stmt->rowCount() > 0) {
            $error = 'Username or email already exists';
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO users (username, email, phone, password, created_at) VALUES (?, ?, ?, ?, NOW())");
            
            if ($stmt->execute([$username, $email, $phone, $hashed_password])) {
                $user_id = $pdo->lastInsertId();
                
                // Auto-login after registration
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                
                // Redirect to dashboard
                header('Location: dashboard.php?welcome=1');
                exit();
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    } else {
        $error = implode('<br>', $errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HOQQDMD HOK Service</title>
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
            padding: 40px 20px;
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
        .register-container {
            background: rgba(31, 32, 41, 0.95);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            border: 2px solid #00d4ff;
            max-width: 500px;
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
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-header h2 {
            font-family: 'Oxanium', cursive;
            color: #00d4ff;
            font-size: 32px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .register-header p {
            color: #888;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            color: #00d4ff;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }
        .form-group label .required {
            color: #ff6b6b;
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
        .form-row {
            display: flex;
            gap: 15px;
        }
        .form-row .form-group {
            flex: 1;
        }
        .btn-register {
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
            margin-top: 10px;
        }
        .btn-register:hover {
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
        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #5cb85c;
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
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #00d4ff;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        .login-link a:hover {
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
        .password-strength {
            margin-top: 5px;
            font-size: 12px;
        }
        .password-strength.weak {
            color: #ff6b6b;
        }
        .password-strength.medium {
            color: #ffc107;
        }
        .password-strength.strong {
            color: #28a745;
        }
        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            font-size: 14px;
            color: #888;
        }
        .terms-checkbox input[type="checkbox"] {
            margin-right: 8px;
            margin-top: 4px;
            cursor: pointer;
        }
        .terms-checkbox a {
            color: #00d4ff;
            text-decoration: none;
        }
        .terms-checkbox a:hover {
            text-decoration: underline;
        }
        .benefits-list {
            background: rgba(200, 255, 11, 0.1);
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .benefits-list h4 {
            color: #00d4ff;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .benefits-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .benefits-list li {
            color: #888;
            font-size: 13px;
            padding: 3px 0;
            padding-left: 20px;
            position: relative;
        }
        .benefits-list li:before {
            content: "✓";
            color: #00d4ff;
            position: absolute;
            left: 0;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-section">
            <img src="img/logo/h6_logo.png" alt="HOQQDMD" style="width: 120px;">
        </div>
        
        <div class="register-header">
            <h2>Create Account</h2>
            <p>Join HOQQDMD for premium HOK services</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <div class="benefits-list">
            <h4>Member Benefits</h4>
            <ul>
                <li>Access to premium HOK tools</li>
                <li>24/7 customer support</li>
                <li>Regular updates and new features</li>
                <li>Secure and private service</li>
            </ul>
        </div>

        <form method="POST" action="" id="registerForm">
            <div class="form-group">
                <label for="username">Username <span class="required">*</span></label>
                <input type="text" class="form-control" id="username" name="username" 
                       placeholder="Choose a unique username" required
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" class="form-control" id="email" name="email" 
                       placeholder="Enter your email address" required
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number (Optional)</label>
                <input type="tel" class="form-control" id="phone" name="phone" 
                       placeholder="Enter your phone number"
                       value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Min. 6 characters" required>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password <span class="required">*</span></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                           placeholder="Re-enter password" required>
                </div>
            </div>

            <label class="terms-checkbox">
                <input type="checkbox" name="terms" required>
                I agree to the <a href="terms.php" target="_blank">Terms of Service</a> and 
                <a href="privacy.php" target="_blank">Privacy Policy</a>
            </label>

            <button type="submit" class="btn btn-register">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>

        <div class="divider">
            <span>or</span>
        </div>

        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login Now</a></p>
        </div>
    </div>

    <script src="js/vendor/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        // Password strength checker
        $('#password').on('input', function() {
            var password = $(this).val();
            var strength = 0;
            var feedback = $('#passwordStrength');
            
            if (password.length >= 6) strength++;
            if (password.length >= 10) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            if (password.length === 0) {
                feedback.text('').removeClass('weak medium strong');
            } else if (strength < 2) {
                feedback.text('Weak password').removeClass('medium strong').addClass('weak');
            } else if (strength < 4) {
                feedback.text('Medium strength').removeClass('weak strong').addClass('medium');
            } else {
                feedback.text('Strong password').removeClass('weak medium').addClass('strong');
            }
        });

        // Confirm password match
        $('#confirm_password').on('input', function() {
            var password = $('#password').val();
            var confirmPassword = $(this).val();
            
            if (confirmPassword.length > 0 && password !== confirmPassword) {
                $(this).css('border-color', '#dc3545');
            } else if (confirmPassword.length > 0) {
                $(this).css('border-color', '#28a745');
            } else {
                $(this).css('border-color', '#444');
            }
        });
    </script>
</body>
</html>

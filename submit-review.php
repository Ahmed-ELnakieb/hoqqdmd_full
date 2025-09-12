<?php
require_once 'config/database.php';

// Database connection
$database = new Database();
$conn = $database->getConnection();

// Form submission handling
$success_message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $reviewer_name = trim($_POST['reviewer_name']);
    $rating = (int)$_POST['rating'];
    $review_text = trim($_POST['review_text']);
    $product_name = trim($_POST['product_name']);

    // Validate form data
    if (empty($reviewer_name) || empty($review_text) || empty($product_name) || $rating < 1 || $rating > 5) {
        $error_message = "Please fill in all fields and select a valid rating.";
    } else {
        try {
            // Insert review into database
            $query = "INSERT INTO user_reviews (reviewer_name, rating, review_text, product_name, review_date) 
                      VALUES (:reviewer_name, :rating, :review_text, :product_name, CURDATE())";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':reviewer_name', $reviewer_name);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':review_text', $review_text);
            $stmt->bindParam(':product_name', $product_name);

            if ($stmt->execute()) {
                $success_message = "Your review has been submitted successfully! Thank you for your feedback.";
            } else {
                $error_message = "There was an error submitting your review. Please try again.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Submission Result</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .result-container {
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .result-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        .success-icon {
            color: #28a745;
        }
        .error-icon {
            color: #dc3545;
        }
        .result-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }
        .result-message {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(0,123,255,0.4);
        }
    </style>
</head>
<body>
    <div class="result-container">
        <?php if (!empty($success_message)): ?>
            <div class="result-icon success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="result-title">Thank You!</h2>
            <p class="result-message"><?php echo htmlspecialchars($success_message); ?></p>
            <a href="reviews.php" class="btn btn-primary">View Reviews</a>
        <?php elseif (!empty($error_message)): ?>
            <div class="result-icon error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h2 class="result-title">Oops!</h2>
            <p class="result-message"><?php echo htmlspecialchars($error_message); ?></p>
            <a href="javascript:history.back()" class="btn btn-primary">Try Again</a>
        <?php else: ?>
            <div class="result-icon">
                <i class="fas fa-arrow-left"></i>
            </div>
            <h2 class="result-title">Redirecting...</h2>
            <p class="result-message">If you are not redirected automatically, please <a href="reviews.php">click here</a>.</p>
            <script>
                setTimeout(function() {
                    window.location.href = 'reviews.php';
                }, 3000);
            </script>
        <?php endif; ?>
    </div>
</body>
</html>

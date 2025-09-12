<?php
$page_title = "Write Review";
$page_description = "Share your experience with Honor of Kings hacks and gaming tools";
require_once 'includes/header.php';
require_once 'config/database.php';

// Database connection
$database = new Database();
$conn = $database->getConnection();

// Get products for dropdown
$products_query = "SELECT name FROM products WHERE status = 'active'";
$products_stmt = $conn->prepare($products_query);
$products_stmt->execute();
$products = $products_stmt->fetchAll(PDO::FETCH_COLUMN);

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
                // Reset form
                $reviewer_name = "";
                $review_text = "";
                $product_name = "";
                $rating = 5;
            } else {
                $error_message = "There was an error submitting your review. Please try again.";
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
} else {
    // Set default values
    $reviewer_name = "";
    $review_text = "";
    $product_name = "";
    $rating = 5;
}
?>

<!-- Write Review Banner -->
<section class="write-review-banner-area breadcrumb-bg" style="background-image: url('http://localhost/hoqqdmd/img/bg/header_background2.jpg'); background-size: cover; background-position: center; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); z-index: 1;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 style="color: #fff; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Write Your <span style="color: #ffd700;">Review</span></h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php" style="color: #fff;">Home</a></li>
                            <li class="breadcrumb-item"><a href="reviews.php" style="color: #fff;">Reviews</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #ffd700;">Write Review</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Write Review Section -->
<section class="write-review-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <div class="section-title">
                    <span class="sub-title" style="color: #ffd700; font-weight: 600;">Share Your Experience</span>
                    <h2 style="color: #333; font-weight: 700;">Write Your <span style="color: #007bff;">Review</span></h2>
                    <p style="color: #666; max-width: 700px; margin: 0 auto;">Help other gamers by sharing your experience with our Honor of Kings tools and hacks.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="review-form">
                    <div class="form-card" style="background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                        <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success" style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                            <i class="fas fa-check-circle" style="margin-right: 10px;"></i><?php echo htmlspecialchars($success_message); ?>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger" style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                            <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i><?php echo htmlspecialchars($error_message); ?>
                        </div>
                        <?php endif; ?>

                        <form method="post" action="write-review.php">
                            <div class="form-group mb-4">
                                <label for="reviewer_name" style="color: #333; font-weight: 600; margin-bottom: 10px; display: block;">Your Name</label>
                                <input type="text" id="reviewer_name" name="reviewer_name" class="form-control" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 15px; font-size: 16px;" value="<?php echo htmlspecialchars($reviewer_name); ?>" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="product_name" style="color: #333; font-weight: 600; margin-bottom: 10px; display: block;">Product</label>
                                <select id="product_name" name="product_name" class="form-control" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 15px; font-size: 16px;" required>
                                    <option value="">Select a product</option>
                                    <?php foreach ($products as $product): ?>
                                    <option value="<?php echo htmlspecialchars($product); ?>" <?php echo $product_name == $product ? 'selected' : ''; ?>><?php echo htmlspecialchars($product); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label style="color: #333; font-weight: 600; margin-bottom: 10px; display: block;">Rating</label>
                                <div class="rating-input" style="display: flex; gap: 10px; margin-bottom: 15px;">
                                    <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <label class="rating-star" style="cursor: pointer;">
                                        <input type="radio" name="rating" value="<?php echo $i; ?>" <?php echo $rating == $i ? 'checked' : ''; ?> style="display: none;">
                                        <i class="far fa-star rating-icon" style="font-size: 30px; color: #ddd; transition: color 0.3s;" data-rating="<?php echo $i; ?>"></i>
                                    </label>
                                    <?php endfor; ?>
                                </div>
                                <div class="rating-text" style="font-size: 16px; color: #666; margin-top: 10px;">
                                    <?php 
                                    $rating_texts = [
                                        1 => "Poor",
                                        2 => "Fair",
                                        3 => "Good",
                                        4 => "Very Good",
                                        5 => "Excellent"
                                    ];
                                    echo isset($rating_texts[$rating]) ? $rating_texts[$rating] : "Select a rating";
                                    ?>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="review_text" style="color: #333; font-weight: 600; margin-bottom: 10px; display: block;">Your Review</label>
                                <textarea id="review_text" name="review_text" class="form-control" rows="6" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 15px; font-size: 16px;" required><?php echo htmlspecialchars($review_text); ?></textarea>
                                <div class="char-count" style="text-align: right; font-size: 14px; color: #666; margin-top: 5px;">0 characters</div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary" style="background: linear-gradient(135deg, #007bff, #0056b3); border: none; color: #fff; font-weight: 600; padding: 12px 30px; border-radius: 30px; font-size: 16px; box-shadow: 0 4px 15px rgba(0,123,255,0.3); transition: transform 0.3s, box-shadow 0.3s;">
                                    Submit Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Rating interaction
document.addEventListener('DOMContentLoaded', function() {
    const ratingStars = document.querySelectorAll('.rating-star');
    const ratingText = document.querySelector('.rating-text');
    const ratingInputs = document.querySelectorAll('input[name="rating"]');

    const ratingTexts = {
        1: "Poor",
        2: "Fair",
        3: "Good",
        4: "Very Good",
        5: "Excellent"
    };

    ratingStars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInputs.forEach(input => {
                if (input.value == rating) {
                    input.checked = true;
                }
            });

            // Update star colors
            ratingStars.forEach(s => {
                const starRating = s.getAttribute('data-rating');
                const icon = s.querySelector('.rating-icon');
                if (starRating <= rating) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    icon.style.color = '#ffd700';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    icon.style.color = '#ddd';
                }
            });

            // Update rating text
            ratingText.textContent = ratingTexts[rating];
        });

        star.addEventListener('mouseenter', function() {
            const rating = this.getAttribute('data-rating');
            ratingStars.forEach(s => {
                const starRating = s.getAttribute('data-rating');
                const icon = s.querySelector('.rating-icon');
                if (starRating <= rating) {
                    icon.style.color = '#ffd700';
                } else {
                    icon.style.color = '#ddd';
                }
            });
        });
    });

    // Reset to original color on mouse leave
    document.querySelector('.rating-input').addEventListener('mouseleave', function() {
        const checkedRating = document.querySelector('input[name="rating"]:checked');
        const rating = checkedRating ? checkedRating.value : 0;

        ratingStars.forEach(s => {
            const starRating = s.getAttribute('data-rating');
            const icon = s.querySelector('.rating-icon');
            if (starRating <= rating) {
                icon.style.color = '#ffd700';
            } else {
                icon.style.color = '#ddd';
            }
        });
    });

    // Character count for review text
    const reviewText = document.getElementById('review_text');
    const charCount = document.querySelector('.char-count');

    if (reviewText && charCount) {
        reviewText.addEventListener('input', function() {
            charCount.textContent = this.value.length + ' characters';
        });
    }
});
</script>

<?php
require_once 'includes/footer.php';
?>
?>

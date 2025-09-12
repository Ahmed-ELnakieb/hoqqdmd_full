<?php
$page_title = "Reviews";
$page_description = "Read and write reviews about Honor of Kings hacks and gaming tools";
require_once 'includes/header.php';
require_once 'config/database.php';

// Database connection
$database = new Database();
$conn = $database->getConnection();

// Pagination settings
$reviews_per_page = 3;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $reviews_per_page;

// Get total number of reviews
$total_query = "SELECT COUNT(*) FROM user_reviews WHERE status = 'active'";
$total_stmt = $conn->prepare($total_query);
$total_stmt->execute();
$total_reviews = $total_stmt->fetchColumn();
$total_pages = ceil($total_reviews / $reviews_per_page);

// Get reviews for current page
$query = "SELECT * FROM user_reviews WHERE status = 'active' ORDER BY review_date DESC LIMIT :limit OFFSET :offset";
$stmt = $conn->prepare($query);
$stmt->bindValue(':limit', $reviews_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Reviews Banner -->
<section class="reviews-banner-area breadcrumb-bg" style="background-image: url('http://localhost/hoqqdmd/img/bg/header_background2.jpg'); background-size: cover; background-position: center; position: relative;">
    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); z-index: 1;"></div>
    <div class="container" style="position: relative; z-index: 2;">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2 style="color: #fff; font-weight: 700; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">User <span style="color: #ffd700;">Reviews</span></h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php" style="color: #fff;">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #ffd700;">Reviews</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Write Review Modal -->
<div class="modal fade" id="writeReviewModal" tabindex="-1" aria-labelledby="writeReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2); overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, #007bff, #0056b3); padding: 20px 25px; border-bottom: none;">
                <h5 class="modal-title" id="writeReviewModalLabel" style="color: #fff; font-weight: 700; font-size: 1.5rem; margin: 0;">Write Your Review</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form id="reviewForm" action="submit-review.php" method="post">
                    <div class="mb-4">
                        <label for="reviewer_name" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 10px; display: block;">Your Name</label>
                        <input type="text" id="reviewer_name" name="reviewer_name" class="form-control" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 15px; font-size: 16px;" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="product_name" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 10px; display: block;">Product</label>
                        <select id="product_name" name="product_name" class="form-select" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 15px; font-size: 16px;" required>
                            <option value="">Select a product</option>
                            <option value="Honor of Kings Pro Hack">Honor of Kings Pro Hack</option>
                            <option value="Honor of Kings ESP Hack">Honor of Kings ESP Hack</option>
                            <option value="Honor of Kings Aimbot">Honor of Kings Aimbot</option>
                            <option value="Honor of Kings Anti-Ban">Honor of Kings Anti-Ban</option>
                            <option value="Honor of Kings Mobile Support">Honor of Kings Mobile Support</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label" style="color: #333; font-weight: 600; margin-bottom: 10px; display: block;">Rating</label>
                        <div class="rating-input" style="display: flex; gap: 10px; margin-bottom: 15px;">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                            <label class="rating-star" style="cursor: pointer;">
                                <input type="radio" name="rating" value="<?php echo $i; ?>" <?php echo $i == 5 ? 'checked' : ''; ?> style="display: none;">
                                <i class="far fa-star rating-icon" style="font-size: 30px; color: #ddd; transition: color 0.3s;" data-rating="<?php echo $i; ?>"></i>
                            </label>
                            <?php endfor; ?>
                        </div>
                        <div class="rating-text" style="font-size: 16px; color: #666; margin-top: 10px;">Excellent</div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="review_text" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 10px; display: block;">Your Review</label>
                        <textarea id="review_text" name="review_text" class="form-control" rows="6" style="border: 1px solid #ddd; border-radius: 8px; padding: 12px 15px; font-size: 16px;" required></textarea>
                        <div class="char-count" style="text-align: right; font-size: 14px; color: #666; margin-top: 5px;">0 characters</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="padding: 20px 25px; border-top: none;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: #6c757d; border: none; color: #fff; font-weight: 600; padding: 10px 25px; border-radius: 30px; font-size: 16px;">Cancel</button>
                <button type="submit" form="reviewForm" class="btn btn-primary" style="background: linear-gradient(135deg, #007bff, #0056b3); border: none; color: #fff; font-weight: 600; padding: 10px 25px; border-radius: 30px; font-size: 16px; box-shadow: 0 4px 15px rgba(0,123,255,0.3);">Submit Review</button>
            </div>
        </div>
    </div>
</div>

<!-- Reviews Section -->
<section class="reviews-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <div class="section-title">
                    <span class="sub-title" style="color: #ffd700; font-weight: 600;">User Feedback</span>
                    <h2 style="color: #333; font-weight: 700;">Honor of Kings <span style="color: #007bff;">Tool Reviews</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach ($reviews as $review): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="review-item">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar" style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden; border: 3px solid #007bff; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($review['reviewer_name']); ?>&background=<?php echo $review['rating'] >= 4 ? '007bff' : ($review['rating'] >= 3 ? '28a745' : 'ffc107'); ?>&color=<?php echo $review['rating'] >= 4 ? 'fff' : '000'; ?>&size=60" alt="Reviewer" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div class="reviewer-details">
                                <h4 style="color: #fff; font-weight: 600; margin-bottom: 8px;"><?php echo htmlspecialchars($review['reviewer_name']); ?></h4>
                                <div class="rating" style="display: flex; gap: 3px; margin-bottom: 10px;">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star<?php echo $i <= $review['rating'] ? '' : '-o'; ?>" style="color: #ffd700; font-size: 16px;"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <div class="review-date" style="background: linear-gradient(135deg, #007bff, #0056b3); color: #fff; padding: 8px 15px; border-radius: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); font-weight: 600; display: inline-flex; align-items: center; gap: 5px;">
                            <i class="far fa-calendar-alt" style="color: #ffd700;"></i>
                            <span><?php echo date('d', strtotime($review['review_date'])); ?></span>
                            <span><?php echo date('M', strtotime($review['review_date'])); ?></span>
                        </div>
                    </div>
                    <div class="review-content">
                        <div style="background-color: #f8f9fa; border-radius: 10px; padding: 15px; margin-bottom: 15px; border-left: 4px solid #007bff; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                            <p style="color: #555; font-style: italic; line-height: 1.6; margin: 0; position: relative;">
                                <i class="fas fa-quote-left" style="position: absolute; top: -10px; left: 10px; font-size: 24px; color: #007bff; opacity: 0.2;"></i>
                                <?php echo htmlspecialchars($review['review_text']); ?>
                            </p>
                        </div>
                        <div class="review-product" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-radius: 8px; padding: 12px; border-left: 4px solid #ffd700; box-shadow: 0 3px 6px rgba(0,0,0,0.1);">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-shield-alt" style="color: #007bff; font-size: 20px;"></i>
                                <h5 style="color: #007bff; font-weight: 600; margin: 0;"><?php echo htmlspecialchars($review['product_name']); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12 text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#writeReviewModal" style="background: linear-gradient(135deg, #007bff, #0056b3); border: none; color: #fff; font-weight: 600; padding: 12px 30px; border-radius: 30px; font-size: 16px; box-shadow: 0 4px 15px rgba(0,123,255,0.3); transition: transform 0.3s, box-shadow 0.3s; display: inline-flex; align-items: center; gap: 10px;">
                    <i class="fas fa-pen"></i>
                    Write Your Review
                </button>
            </div>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <div class="row mt-5">
            <div class="col-lg-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Product Ratings Section -->
<section class="product-ratings-area pt-120 pb-120" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <div class="section-title">
                    <span class="sub-title" style="color: #007bff; font-weight: 600;">Community Ratings</span>
                    <h2 style="color: #333; font-weight: 700;">Honor of Kings <span style="color: #007bff;">Tool Ratings</span></h2>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Rating Item 1 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rating-item text-center" style="background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease; border-left: 4px solid #007bff;">
                    <div class="rating-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                        <div class="rating-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #007bff, #0056b3); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-crosshairs" style="color: #fff; font-size: 20px;"></i>
                        </div>
                        <div class="rating-score" style="background: #f8f9fa; border-radius: 8px; padding: 5px 12px; display: inline-block;">
                            <h3 style="color: #333; font-weight: 700; margin: 0; font-size: 1.5rem;">4.8</h3>
                            <div class="rating-stars" style="color: #ffc107; font-size: 14px;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <h4 style="color: #333; font-weight: 600; font-size: 1.1rem; margin: 0; text-transform: uppercase; letter-spacing: 1px;">Aimbot</h4>
                </div>
            </div>

            <!-- Rating Item 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rating-item text-center" style="background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease; border-left: 4px solid #28a745;">
                    <div class="rating-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                        <div class="rating-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #28a745, #1e7e34); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-eye" style="color: #fff; font-size: 20px;"></i>
                        </div>
                        <div class="rating-score" style="background: #f8f9fa; border-radius: 8px; padding: 5px 12px; display: inline-block;">
                            <h3 style="color: #333; font-weight: 700; margin: 0; font-size: 1.5rem;">4.9</h3>
                            <div class="rating-stars" style="color: #ffc107; font-size: 14px;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <h4 style="color: #333; font-weight: 600; font-size: 1.1rem; margin: 0; text-transform: uppercase; letter-spacing: 1px;">ESP Hack</h4>
                </div>
            </div>

            <!-- Rating Item 3 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rating-item text-center" style="background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease; border-left: 4px solid #ffc107;">
                    <div class="rating-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                        <div class="rating-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ffc107, #e0a800); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-shield-alt" style="color: #fff; font-size: 20px;"></i>
                        </div>
                        <div class="rating-score" style="background: #f8f9fa; border-radius: 8px; padding: 5px 12px; display: inline-block;">
                            <h3 style="color: #333; font-weight: 700; margin: 0; font-size: 1.5rem;">4.7</h3>
                            <div class="rating-stars" style="color: #ffc107; font-size: 14px;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <h4 style="color: #333; font-weight: 600; font-size: 1.1rem; margin: 0; text-transform: uppercase; letter-spacing: 1px;">Anti-Ban</h4>
                </div>
            </div>

            <!-- Rating Item 4 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rating-item text-center" style="background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease; border-left: 4px solid #6f42c1;">
                    <div class="rating-header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                        <div class="rating-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6f42c1, #5a32a3); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-mobile-alt" style="color: #fff; font-size: 20px;"></i>
                        </div>
                        <div class="rating-score" style="background: #f8f9fa; border-radius: 8px; padding: 5px 12px; display: inline-block;">
                            <h3 style="color: #333; font-weight: 700; margin: 0; font-size: 1.5rem;">4.6</h3>
                            <div class="rating-stars" style="color: #ffc107; font-size: 14px;">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <h4 style="color: #333; font-weight: 600; font-size: 1.1rem; margin: 0; text-transform: uppercase; letter-spacing: 1px;">Mobile Support</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Initialize modal with a small delay to ensure DOM is fully loaded
window.addEventListener('load', function() {
    setTimeout(function() {
        const writeReviewModal = new bootstrap.Modal(document.getElementById('writeReviewModal'));
        
        // Add click event to the Write Review button
        const writeReviewButton = document.querySelector('[data-bs-target="#writeReviewModal"]');
        if (writeReviewButton) {
            writeReviewButton.addEventListener('click', function() {
                writeReviewModal.show();
            });
        }
    }, 100);
});
</script>

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
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    icon.style.color = '#ffd700';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
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
                icon.classList.remove('far');
                icon.classList.add('fas');
                icon.style.color = '#ffd700';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                icon.style.color = '#ddd';
            }
        });
    });
    
    // Character count for review text
    const reviewText = document.getElementById('review_text');
    const charCount = document.querySelector('.char-count');
    
    if (reviewText && charCount) {
        reviewText.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count + ' characters';
            
            // Change color based on character count
            if (count > 500) {
                charCount.style.color = '#dc3545';
            } else if (count > 300) {
                charCount.style.color = '#ffc107';
            } else {
                charCount.style.color = '#666';
            }
        });
    }
});
</script>

<?php require_once 'includes/footer.php'; ?>

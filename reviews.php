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
                <div class="rating-item text-center" style="background: #fff; border-radius: 15px; padding: 25px 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; border-top: 4px solid #007bff;">
                    <div class="rating-icon" style="width: 70px; height: 70px; background: linear-gradient(135deg, #007bff, #0056b3); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 5px 15px rgba(0,123,255,0.3);">
                        <i class="fas fa-crosshairs" style="color: #fff; font-size: 28px;"></i>
                    </div>
                    <div class="rating-score" style="background: linear-gradient(135deg, #ffd700, #ffed4e); border-radius: 50px; padding: 5px 15px; display: inline-block; margin-bottom: 15px; box-shadow: 0 4px 8px rgba(255,215,0,0.3);">
                        <h3 style="color: #333; font-weight: 700; margin: 0; font-size: 1.8rem;">4.8/5.0</h3>
                    </div>
                    <p style="color: #555; font-weight: 600; font-size: 1.1rem; margin: 0;">Aimbot</p>
                </div>
            </div>

            <!-- Rating Item 2 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rating-item text-center" style="background: #fff; border-radius: 15px; padding: 25px 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; border-top: 4px solid #28a745;">
                    <div class="rating-icon" style="width: 70px; height: 70px; background: linear-gradient(135deg, #28a745, #1e7e34); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 5px 15px rgba(40,167,69,0.3);">
                        <i class="fas fa-eye" style="color: #fff; font-size: 28px;"></i>
                    </div>
                    <div class="rating-score" style="background: linear-gradient(135deg, #ffd700, #ffed4e); border-radius: 50px; padding: 5px 15px; display: inline-block; margin-bottom: 15px; box-shadow: 0 4px 8px rgba(255,215,0,0.3);">
                        <h3 style="color: #333; font-weight: 700; margin: 0; font-size: 1.8rem;">4.9/5.0</h3>
                    </div>
                    <p style="color: #555; font-weight: 600; font-size: 1.1rem; margin: 0;">ESP Hack</p>
                </div>
            </div>

            <!-- Rating Item 3 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rating-item text-center" style="background: #fff; border-radius: 15px; padding: 25px 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; border-top: 4px solid #ffc107;">
                    <div class="rating-icon" style="width: 70px; height: 70px; background: linear-gradient(135deg, #ffc107, #e0a800); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 5px 15px rgba(255,193,7,0.3);">
                        <i class="fas fa-shield-alt" style="color: #fff; font-size: 28px;"></i>
                    </div>
                    <div class="rating-score" style="background: linear-gradient(135deg, #ffd700, #ffed4e); border-radius: 50px; padding: 5px 15px; display: inline-block; margin-bottom: 15px; box-shadow: 0 4px 8px rgba(255,215,0,0.3);">
                        <h3 style="color: #333; font-weight: 700; margin: 0; font-size: 1.8rem;">4.7/5.0</h3>
                    </div>
                    <p style="color: #555; font-weight: 600; font-size: 1.1rem; margin: 0;">Anti-Ban</p>
                </div>
            </div>

            <!-- Rating Item 4 -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="rating-item text-center" style="background: #fff; border-radius: 15px; padding: 25px 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: transform 0.3s ease, box-shadow 0.3s ease; border-top: 4px solid #dc3545;">
                    <div class="rating-icon" style="width: 70px; height: 70px; background: linear-gradient(135deg, #dc3545, #c82333); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; box-shadow: 0 5px 15px rgba(220,53,69,0.3);">
                        <i class="fas fa-mobile-alt" style="color: #fff; font-size: 28px;"></i>
                    </div>
                    <div class="rating-score" style="background: linear-gradient(135deg, #ffd700, #ffed4e); border-radius: 50px; padding: 5px 15px; display: inline-block; margin-bottom: 15px; box-shadow: 0 4px 8px rgba(255,215,0,0.3);">
                        <h3 style="color: #333; font-weight: 700; margin: 0; font-size: 1.8rem;">4.6/5.0</h3>
                    </div>
                    <p style="color: #555; font-weight: 600; font-size: 1.1rem; margin: 0;">Mobile Support</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>

<?php
$page_title = "Contact Us";
$page_description = "Get in touch with HOQQDMD Gaming Platform";
require_once 'includes/header.php';
?>

<!-- Page Banner -->
<section class="breadcrumb-area breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content text-center">
                    <h2>Contact <span>Us</span></h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="contact-info-area pt-120 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-box mb-60 text-center">
                    <div class="icon mb-30">
                        <i class="fas fa-map-marker-alt fa-3x" style="color: #667eea;"></i>
                    </div>
                    <h4>Our Location</h4>
                    <p>123 Gaming Street<br>New York, NY 10001<br>United States</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-box mb-60 text-center">
                    <div class="icon mb-30">
                        <i class="fas fa-phone-alt fa-3x" style="color: #667eea;"></i>
                    </div>
                    <h4>Phone Number</h4>
                    <p>+1 234 567 8900<br>+1 234 567 8901<br>Mon-Fri 9am-6pm</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="contact-info-box mb-60 text-center">
                    <div class="icon mb-30">
                        <i class="fas fa-envelope fa-3x" style="color: #667eea;"></i>
                    </div>
                    <h4>Email Address</h4>
                    <p>info@hoqqdmd.com<br>support@hoqqdmd.com<br>sales@hoqqdmd.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="contact-form-area pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-title text-center mb-50">
                    <h2>Send Us a <span>Message</span></h2>
                    <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                </div>
                <div class="contact-form">
                    <form id="contactForm" action="#" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-30">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name *" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-30">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email *" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-30">
                                    <input type="tel" class="form-control" name="phone" placeholder="Your Phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-30">
                                    <select class="form-control" name="subject">
                                        <option value="">Select Subject</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="support">Technical Support</option>
                                        <option value="sales">Sales Question</option>
                                        <option value="partnership">Partnership</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-30">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Your Message *" required></textarea>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn rotated-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                    <div id="formMessage" class="alert mt-30" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-area">
    <div class="container-fluid p-0">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1638360000000!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<style>
.breadcrumb-area {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 150px 0 120px;
    position: relative;
}
.breadcrumb-content h2 {
    color: white;
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
}
.breadcrumb-content h2 span {
    color: #ffd700;
}
.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    justify-content: center;
}
.breadcrumb-item {
    color: rgba(255,255,255,0.8);
}
.breadcrumb-item a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}
.breadcrumb-item.active {
    color: white;
}
.contact-info-box {
    padding: 40px 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 30px rgba(0,0,0,0.1);
    transition: all 0.3s;
}
.contact-info-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}
.contact-info-box h4 {
    font-size: 24px;
    margin-bottom: 15px;
    color: #333;
}
.contact-info-box p {
    color: #666;
    margin: 0;
}
.section-title h2 {
    font-size: 36px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}
.section-title h2 span {
    color: #667eea;
}
.form-control {
    height: 50px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 14px;
}
.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}
textarea.form-control {
    height: auto;
}
select.form-control {
    cursor: pointer;
}
</style>

<script>
// Simple form handling
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form message div
    var messageDiv = document.getElementById('formMessage');
    
    // Show success message
    messageDiv.className = 'alert alert-success mt-30';
    messageDiv.innerHTML = '<i class="fas fa-check-circle"></i> Thank you for your message! We will get back to you soon.';
    messageDiv.style.display = 'block';
    
    // Reset form
    this.reset();
    
    // Hide message after 5 seconds
    setTimeout(function() {
        messageDiv.style.display = 'none';
    }, 5000);
});
</script>

<?php require_once 'includes/footer.php'; ?>

    </main><!-- End Main Content Container -->
</div><!-- End Page Content -->

</div><!-- End Page Wrapper -->

<!-- Scripts -->
<script src="dashboard-assets/js/libs.js"></script>
<script src="dashboard-assets/js/main.js"></script>

<!-- Copy to Clipboard Function -->
<script>
function copyKey(elementId) {
    const keyElement = document.getElementById(elementId);
    const tempInput = document.createElement('input');
    tempInput.value = keyElement.textContent;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);
    
    // Show feedback
    const button = event.target.closest('button');
    const originalHTML = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i> Copied!';
    button.style.background = '#28a745';
    
    setTimeout(() => {
        button.innerHTML = originalHTML;
        button.style.background = '#c8ff0b';
    }, 2000);
}

// Sidebar Toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.querySelector('.menu-btn');
    const sidebar = document.getElementById('sidebar');
    
    if (menuBtn && sidebar) {
        menuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('is-show');
            menuBtn.classList.toggle('is-active');
        });
    }
});
</script>

</body>
</html>
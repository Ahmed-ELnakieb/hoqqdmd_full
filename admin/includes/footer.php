        </div>
        <!-- End Content Wrapper -->
    </div>
    <!-- End Main Content -->
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Toggle sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
        
        // Initialize DataTables
        $(document).ready(function() {
            if($('.data-table').length) {
                $('.data-table').DataTable({
                    "pageLength": 10,
                    "ordering": true,
                    "info": true,
                    "responsive": true
                });
            }
        });
        
        // Confirm delete
        function confirmDelete(url, message = 'Are you sure you want to delete this item?') {
            Swal.fire({
                title: 'Confirm Delete',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
            return false;
        }
        
        // Show success message
        function showSuccess(message) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: message,
                timer: 2000,
                showConfirmButton: false
            });
        }
        
        // Show error message
        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message
            });
        }
        
        // Check for session messages
        <?php if(isset($_SESSION['success_message'])): ?>
            showSuccess('<?php echo $_SESSION['success_message']; ?>');
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['error_message'])): ?>
            showError('<?php echo $_SESSION['error_message']; ?>');
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
    </script>
</body>
</html>

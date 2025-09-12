<?php
$page_title = 'Dashboard';
require_once 'includes/header.php';

// Get statistics (check if tables exist first)
$stats = [
    'users' => 0,
    'products' => 0,
    'orders' => 0,
    'revenue' => 0
];

// Check and get users count
$result = mysqli_query($conn, "SHOW TABLES LIKE 'users'");
if(mysqli_num_rows($result) > 0) {
    $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
    if($count) {
        $stats['users'] = mysqli_fetch_assoc($count)['total'];
    }
}

// Check and get products count
$result = mysqli_query($conn, "SHOW TABLES LIKE 'products'");
if(mysqli_num_rows($result) > 0) {
    $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
    if($count) {
        $stats['products'] = mysqli_fetch_assoc($count)['total'];
    }
}

// Check and get orders count and revenue
$result = mysqli_query($conn, "SHOW TABLES LIKE 'orders'");
if(mysqli_num_rows($result) > 0) {
    $count = mysqli_query($conn, "SELECT COUNT(*) as total, SUM(total_amount) as revenue FROM orders WHERE status != 'cancelled'");
    if($count) {
        $data = mysqli_fetch_assoc($count);
        $stats['orders'] = $data['total'];
        $stats['revenue'] = $data['revenue'] ?? 0;
    }
}
?>

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="mb-1"><?php echo number_format($stats['users']); ?></h3>
            <p class="text-muted mb-0">Total Users</p>
            <small class="text-success"><i class="fas fa-arrow-up"></i> 12% from last month</small>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon bg-success">
                <i class="fas fa-box"></i>
            </div>
            <h3 class="mb-1"><?php echo number_format($stats['products']); ?></h3>
            <p class="text-muted mb-0">Total Products</p>
            <small class="text-success"><i class="fas fa-arrow-up"></i> 8% from last month</small>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon bg-warning">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <h3 class="mb-1"><?php echo number_format($stats['orders']); ?></h3>
            <p class="text-muted mb-0">Total Orders</p>
            <small class="text-success"><i class="fas fa-arrow-up"></i> 23% from last month</small>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-icon bg-danger">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <h3 class="mb-1">$<?php echo number_format($stats['revenue'], 2); ?></h3>
            <p class="text-muted mb-0">Total Revenue</p>
            <small class="text-success"><i class="fas fa-arrow-up"></i> 18% from last month</small>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Sales Overview</h5>
            </div>
            <div class="card-body">
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Product Categories</h5>
            </div>
            <div class="card-body">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Recent Orders</h5>
                <a href="orders.php" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Check if orders table exists
                            $result = mysqli_query($conn, "SHOW TABLES LIKE 'orders'");
                            if(mysqli_num_rows($result) > 0) {
                                $orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
                                if($orders && mysqli_num_rows($orders) > 0) {
                                    while($order = mysqli_fetch_assoc($orders)) {
                                        ?>
                                        <tr>
                                            <td>#<?php echo $order['id']; ?></td>
                                            <td><?php echo $order['customer_name']; ?></td>
                                            <td><?php echo formatDate($order['created_at']); ?></td>
                                            <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo $order['status'] == 'completed' ? 'success' : ($order['status'] == 'pending' ? 'warning' : 'danger'); ?>">
                                                    <?php echo ucfirst($order['status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="order-details.php?id=<?php echo $order['id']; ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="6" class="text-center">No orders found</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6" class="text-center">Orders table not found. Please set up the database.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Sales Chart
document.addEventListener('DOMContentLoaded', function() {
    // Sales Overview Chart
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Sales',
                data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 38000, 40000, 45000],
                borderColor: 'rgb(102, 126, 234)',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
    
    // Category Chart
    var ctx2 = document.getElementById('categoryChart').getContext('2d');
    var categoryChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Gaming Chairs', 'Headsets', 'Keyboards', 'Graphics Cards', 'Others'],
            datasets: [{
                data: [30, 25, 20, 15, 10],
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(118, 75, 162, 0.8)',
                    'rgba(67, 233, 123, 0.8)',
                    'rgba(250, 112, 154, 0.8)',
                    'rgba(254, 225, 64, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>

<?php require_once 'includes/footer.php'; ?>

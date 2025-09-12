<?php
/**
 * EXAMPLE: How to add new product types dynamically
 * This shows how the titles are completely dynamic from the database
 */

require_once 'config/database.php';
$conn = connectDB();

// Example: Add a new product type with custom title
$newTypeQuery = "
    INSERT INTO product_types (name, display_name, description, icon, sort_order) 
    VALUES ('premium', 'Premium Package', 'Ultimate gaming experience with all features', 'fas fa-crown', 4)
";

// Example: Add products for the new type
$newProductsQuery = "
    INSERT INTO shop_products (type_id, name, period, price_usd, price_brl, description, features, badge, is_popular, sort_order) 
    VALUES 
    (4, 'Premium Package - 7 Days', '7 Days', 25.00, 150.00, 'Ultimate gaming experience with all premium features.', 'All features included|Premium support|Custom setup|Priority updates', 'Premium', TRUE, 1),
    (4, 'Premium Package - 30 Days', '30 Days', 50.00, 300.00, 'Best value premium package with all features and VIP support.', 'All features included|VIP support|Personal assistance|All updates|Best value', 'Best Value', FALSE, 2)
";

// Uncomment to execute:
// mysqli_query($conn, $newTypeQuery);
// mysqli_query($conn, $newProductsQuery);

echo "✅ The shop page is COMPLETELY DYNAMIC!<br>";
echo "📋 Current Product Types:<br>";

// Show current product types
$typesQuery = "SELECT * FROM product_types ORDER BY sort_order";
$typesResult = mysqli_query($conn, $typesQuery);

while ($type = mysqli_fetch_assoc($typesResult)) {
    echo "• <strong>" . htmlspecialchars($type['display_name']) . "</strong> (ID: " . $type['id'] . ")<br>";
    echo "  - Description: " . htmlspecialchars($type['description']) . "<br>";
    echo "  - Icon: " . htmlspecialchars($type['icon']) . "<br><br>";
}

echo "<br>🎯 <strong>To add new product types:</strong><br>";
echo "1. Insert into 'product_types' table<br>";
echo "2. Insert products into 'shop_products' table<br>";
echo "3. The shop page will automatically show the new titles!<br>";

mysqli_close($conn);
?>

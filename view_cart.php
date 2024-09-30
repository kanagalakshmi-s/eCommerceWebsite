
<?php
session_start();

if(!isset($_SESSION['cart'])|| empty($_SESSION['cart']))
{
    header('location: frontview.php');
    exit;
}
elseif (isset($_GET['delid'])) {
    // Loop through the cart and check for the item to delete
    foreach ($_SESSION["cart"] as $key => $item) {
        // Assuming 'delid' contains the product id (pid) to be removed
        if ($item['pid'] == $_GET['delid']) {
            // Remove the specific item from the cart
            unset($_SESSION['cart'][$key]);
            break; // Exit the loop after deleting the item
        }
    }
    
    // After removing the item, you can optionally redirect to the same page
    header('Location: view_cart.php');
    exit(); // Ensure no further code is executed after redirect
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Shopping Cart</h1>

        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $item_total = $item['price'] * $item['quantity'];
                        $total_price += $item_total;
                        echo "<tr>";
                        echo "<td><img src='{$item['image']}' alt='{$item['pname']}' style='width: 50px;'> {$item['pname']}</td>";
                        echo "<td>₹ {$item['price']}</td>";
                        echo "<td>{$item['quantity']}</td>";
                        echo "<td>₹{$item_total}</td>";
                        echo "<td><a href='view_cart.php?delid={$item['pid']}'>remove</a></td>";
                        echo "</tr>";
                       
                    }
                    ?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                        <td><strong>₹<?php echo $total_price; ?></strong></td>
                    </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();
include "db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 50px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 65%;
        }
        .product-image {
            flex: 1;
            max-width: 200px;
            margin-right: 20px;
        }
        .product-details {
            flex: 2;
        }
        .product-details h2 {
            margin-bottom: 15px;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .product-details p {
            font-size: 1.25rem;
            color: #007bff;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Product Details</h1>
        <div class="row">
            <?php  
            // Add item to cart
            if (isset($_POST['addCart'])) {
                $product_id = $_GET['id'];
                
                // Fetch product details
                $sql = "SELECT * FROM category WHERE id = $product_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    // Create a cart item array
                    $item = array(
                        'pid' => $row['id'],
                        'pname' => $row['name'],
                        'price' => $row['price'],
                        'image' => $row['image'],
                        'quantity' => 1 // Default quantity to 1
                    );

                    // If session cart exists
                    if (isset($_SESSION['cart'])) {
                        // If the product is already in the cart, update quantity
                        if (isset($_SESSION['cart'][$product_id])) {
                            $_SESSION['cart'][$product_id]['quantity']++;
                        } else {
                            // Add the new product to the cart
                            $_SESSION['cart'][$product_id] = $item;
                        }
                    } else {
                        // Initialize cart session array and add the product
                        $_SESSION['cart'] = array();
                        $_SESSION['cart'][$product_id] = $item;
                    }

                    // Redirect to the cart page (Optional)
                    header('Location: view_cart.php');
                }
            }
            ?>

            <form action="" method="POST">
                <div class="col-md-12">
                    <div class="product-container">
                        <?php
                        // Display product details
                        if (isset($_GET["id"])) {
                            $sql = "SELECT * FROM category WHERE id={$_GET['id']}";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='product-image'>";
                                    echo "<img src='{$row['image']}' alt='{$row['name']}' class='img-fluid'>";
                                    echo "</div>";
                                    echo "<div class='product-details'>";
                                    echo "<h2>{$row['name']}</h2>";
                                    echo "<p>Price: $ {$row['price']}</p>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<p>No products found.</p>";
                            }
                        }
                        ?>
                        <!-- Add item to cart button -->
                        <input type="submit" class="btn btn-success" name="addCart" value="Add Item">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

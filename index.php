<?php
include "db_connection.php";
session_start();

//Session validation and redirect logic
// if ($_SESSION['role'] !== 'user') {
//     header('Location: categoryfrontview.php'); // Redirect to user page if not an admin
//     exit;
//}

// Add item to cart
if (isset($_POST['addCart'])) {
    $product_id = intval($_POST['product_id']); // Sanitize input

    // Fetch product details using prepared statements
    $stmt = $conn->prepare("SELECT * FROM category WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

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
                // If the product does not exist, add it to the cart
                $_SESSION['cart'][$product_id] = $item;
            }
        } else {
            // Initialize cart session array and add the product
            $_SESSION['cart'] = array();
            $_SESSION['cart'][$product_id] = $item;
        }

        // Set notification for the product added
        $_SESSION['notification'] = 'Item added to the cart!';
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Check if there's a notification to display
$notification = '';
if (isset($_SESSION['notification'])) {
    $notification = $_SESSION['notification'];
    unset($_SESSION['notification']); // Clear it after displaying
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECommerce Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
      .nav{
        font-size:20px;
        padding:10px;
        color:#271042;

      }
     
      .nav i:hover{
        font-size:25px;
        color:#a86f40;

      }
        /* Sidebar styles */
        .stars i {
            font-size: 15px;
            color: #ccc; /* Default star color */
            cursor: pointer;
        }
        .stars i.active {
            color: yellow; /* Color for active (clicked) stars */
        }
        #wrapper {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            position: fixed;
            top: 0;
            height: 100%;
            left: 0;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        #wrapper.toggled #sidebar-wrapper {
            left: -250px;
        }

        #page-content-wrapper {
            flex: 1;
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            background-color: #f8f9fa;
        }

        #wrapper.toggled #page-content-wrapper {
            margin-left: 0;
        }

        /* Navbar styles */
        .bg-primary {
            background-color: #007bff !important;
        }

        .navbar-brand {
            font-size: 1.5rem;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }

        /* Cart icon notification styles */
        .cart {
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -10px;
            left: -10px;
            background-color: green;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 8px;
            display: none;
        }

        .show-notification {
            display: inline-block;
        }

        /* Sidebar heading */
        .sidebar-heading {
            padding: 1rem;
            font-size: 1.25rem;
            text-align: center;
            background-color: #343a40;
            color: #fff;
            position: relative;
        }

        .sidebar-heading .close-icon {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 1.25rem;
            cursor: pointer;
            color: #fff;
        }

        /* Card styles */
        .card {
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            
        }
        .card a
        {
            text-decoration:none;

        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-title {
            margin-bottom: 15px;
            color:black;
        }

        .btn-warning {
            margin-top: auto;
        }

        .small-btn {
            padding: 5px 2px;
            font-size: 12px;
        }
        .add-to-cart-btn{
            background-color:#5cb344;
        }

       /* -------------------- footer style-------------------------- */



       /* ---------------footer style-------------------------------------- */
       
    </style>
</head>

<body>
<ul class="nav d-flex justify-content-end" style="background-color:#131710;" >
 
  <li class="nav-item">
    <a class="nav-link" href="emailApplication/index.php"><i class="fa-solid fa-envelope"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#"><i class="fa-brands fa-facebook"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" ><i class="fa-brands fa-square-instagram"></i></a>
  </li>
</ul>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color:#26243b;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#" id="menu-toggle"><i class="fa-solid fa-bars"></i></a>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                 
                <form class="d-flex" method="GET" action="search_results.php">
                <input class="form-control me-2" type="search" name="query" placeholder="Search products" aria-label="Search" required>
                 
                <li><a href="#!" class="ser-open" style="color:white; font-size:20px;"><i class="fa fa-search" ></i></a></li>
            </form>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"><i class="fa-solid fa-user"></i><?php echo $_SESSION['username'] ?></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="cart">
                <a href="view_cart.php"><i class="fa-solid fa-cart-shopping" style="color:white; font-size:18px"></i></a>
                <span class="notification-badge" id="cart-notification"><?php echo isset($notification) ? '<i class="fa-solid fa-check"></i>' : ''; ?></span>
            </div>
        </div>
    </nav>

    <!-- Sidebar and Page Content -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <h2>ECommerce</h2>
                <span class="close-icon" id="sidebar-close"><i class="fa-solid fa-times"></i></span>
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="categoryfrontview.php" class="list-group-item list-group-item-action">Category</a>
                <a href="#" class="list-group-item list-group-item-action">Sub category</a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
    <div class="container-fluid">
        <!-- Cards Section -->
        <div class="row mt-2">
            <?php
            $sql = "SELECT * FROM category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-3 col-lg-3 col-sm-4 mb-4">
                <div class="card p-4 h-100 shadow-sm">
                <a href="product.php?pid=<?php echo $row['id']; ?>" >
                    <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>" style="height: 100px;  object-fit: contain;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center"><?php echo $row['name']; ?></h5>
                        <p class="card-text text-muted text-center"><?php echo $row['description']; ?></p>
                </a>

                        <!-- View Product Button -->
                        
                        
                        <!-- Add to Cart Form -->
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn  add-to-cart-btn" name="addCart" data-product-id="<?php echo $row['id']; ?>">
                                <i class="fas fa-shopping-cart"></i> Add To Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
             
            <h4>Rate this Product:</h4>

            <!-- Star icons -->
            <div class="stars">
                <button onclick="rating(1)"><i class="fa-regular fa-star" id="star1"></i></button>
                <button onclick="rating(2)"><i class="fa-regular fa-star" id="star2"></i></button>
                <button onclick="rating(3)"><i class="fa-regular fa-star" id="star3"></i></button>
                <button onclick="rating(4)"><i class="fa-regular fa-star" id="star4"></i></button>
                <button onclick="rating(5)"><i class="fa-regular fa-star" id="star5"></i></button>
            </div>

            <p>Your Rating: <span id="ratingValue">0</span></p>
        </div>
 
    </div>
</div>

<!-- --------------rating end---------------------------------- -->

<!-- ----------------end of page content----------------- -->
 

<!-- JavaScript to toggle the sidebar and handle the notification -->
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        });

        document.getElementById("sidebar-close").addEventListener("click", function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        });

        // Show notification when item added to cart
        const notification = "<?php echo $notification; ?>";
        if (notification !== '') {
            const cartNotification = document.getElementById("cart-notification");
            cartNotification.classList.add("show-notification");

            // Automatically hide notification after 3 seconds
           
            // Hide notification when clicked
            cartNotification.addEventListener("click", function () {
                cartNotification.classList.remove("show-notification");
            });
        }

        function rating(rating) {
            // Reset all stars to default color
            for (let i = 1; i <= 5; i++) {
                document.getElementById('star' + i).style.color = '#ccc';
            }
            
            // Set selected stars to yellow
            for (let i = 1; i <= rating; i++) {
                document.getElementById('star' + i).style.color = 'yellow';
            }

            // Update the displayed rating
            document.getElementById('ratingValue').textContent = rating;
        }
    </script>

</body>

</html>

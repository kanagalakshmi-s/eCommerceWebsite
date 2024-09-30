<?php
include "db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
        }

        .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: red;
            cursor: pointer;
        }

        .stars i {
            font-size: 30px;
            color: gray;
            cursor: pointer;
        }
        .stars i.active {
            color: yellow;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            height:400px;
            display: flex;
            align-items: center; /* Center the image and content vertically */
            border: none;
            border-radius: 10px;
            background-color: #fff;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 25%; /* Image takes 25% of the card width */
            height:80%;
            object-fit: contain;
            padding: 10px;
            background-color: #f4f4f4;
        }

        .card-body {
            width: 60%; /* Content takes 60% of the card width */
            padding: 20px;
            margin-left:50px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .card-text {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 15px;
        }

        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 0;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .card {
                flex-direction: column; /* Stack the image and content vertically on smaller screens */
                text-align: center;
            }

            .card img, .card-body {
                width: 100%; /* Image and content take full width */
            }
        }
    </style>
</head>
<body>
<div id="page-content-wrapper">
    <div class="container-fluid">
        <!-- Cards Section -->
        <div class="row mt-2">
            <?php
            if (isset($_GET['pid'])) {
                $id = $_GET['pid'];
                $sql = "SELECT * FROM category WHERE id='$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
            <div class="col-md-12 col-lg-12 col-sm-12 mb-4">
                <div class="card shadow-sm">
                    <img src="<?php echo $row['image']; ?>" class="card-img-left" alt="<?php echo $row['name']; ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text"><?php echo $row['description']; ?></p>

                        <!-- Add to Cart Form -->
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <!-- <button type="submit" class="btn btn-success add-to-cart-btn" name="addCart" data-product-id="<?php echo $row['id']; ?>">
                                <i class="fas fa-shopping-cart"></i> Add Item
                            </button> -->
                        </form>

                        <!----------------------------- Rating system ------------------------->

                        <h1 style="color: hotpink;">Give rating</h1>

                        <div class="stars" id="star">
                            <button onclick="rateProduct(1)"><i class="fa-regular fa-star" id="star1"></i></button>
                            <button onclick="rateProduct(2)"><i class="fa-regular fa-star" id="star2"></i></button>
                            <button onclick="rateProduct(3)"><i class="fa-regular fa-star" id="star3"></i></button>
                            <button onclick="rateProduct(4)"><i class="fa-regular fa-star" id="star4"></i></button>
                            <button onclick="rateProduct(5)"><i class="fa-regular fa-star" id="star5"></i></button>
                        </div>

                        <p>Your Rating: <span id="ratingValue">0</span></p>
                         <button type="button" onclick="submitRating()">Submit Rating</button>

                        <!-- Hidden product ID (to associate rating with a specific product) -->
                        <input type="hidden" id="product_id" value="<?php echo $id ?>"> <!-- Example product ID -->

                        

                        <!-- Modal Structure -->
                        <div id="ratingModal" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <h2>Edit Your Rating</h2>
                               

                                <div class="stars" data-toggle="#ratingModal">
                                    <button onclick="rateProduct(1)"><i class="fa-regular fa-star" id="modalStar1"></i></button>
                                    <button onclick="rateProduct(2)"><i class="fa-regular fa-star" id="modalStar2"></i></button>
                                    <button onclick="rateProduct(3)"><i class="fa-regular fa-star" id="modalStar3"></i></button>
                                    <button onclick="rateProduct(4)"><i class="fa-regular fa-star" id="modalStar4"></i></button>
                                    <button onclick="rateProduct(5)"><i class="fa-regular fa-star" id="modalStar5"></i></button>
                                </div>
                                

                                <p>Your Rating: <span id="ratingValueModal">0</span></p>
                              

                            </div>
                        </div>

                        <!-- Hidden product ID for modal -->
                        <input type="hidden" id="product_id_modal" value="<?php echo $id; ?>">
                    </div>
                </div>
            </div>
            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<script>
   

    function submitRating() {
    var rating = document.getElementById('ratingValueModal').textContent; // Get the rating value
    var product_id = document.getElementById('product_id_modal').value; // Get the product ID

    // Send the rating and product ID to another PHP file for updating in the database
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submit_ratings.php", true); // Send data to `update_rating.php`
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert("Rating updated successfully: " + xhr.responseText); // Confirm update
            closeModal(); // Close the modal after successful submission
        }
    };

    // Send rating and product_id as POST data
    xhr.send("rating=" + rating + "&product_id=" + product_id);
}


    function setStars(rating, isModal = true) {
        for (let i = 1; i <= 5; i++) {
            let starId = isModal ? 'star' + i : 'star' + i;
            document.getElementById(starId).style.color = 'gray';
        }
        for (let i = 1; i <= rating; i++) {
            let starId = isModal ? 'star' + i : 'star' + i;
            document.getElementById(starId).style.color = 'green';
        }
    }

    function openModal() {
        document.getElementById('ratingModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('ratingModal').style.display = 'none';
    }

    function rateProduct(rating) {
        // Reset all stars to default color (gray)
        setStars(rating);
      

        // Update the displayed rating
        document.getElementById('ratingValue').textContent = rating;

        // Send rating to PHP using AJAX
        var product_id = document.getElementById('product_id').value; // Get product ID
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "submit_ratings.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert("Rating submitted: " + xhr.responseText); // Alert response from server
            }
        };
        xhr.send("rating=" + rating + "&product_id=" + product_id);
    }
</script>

<?php
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Fetch the rating from the database
    $sql = "SELECT rating FROM ratings WHERE product_id='$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['rating']; // Output the rating for JavaScript
    } else {
        echo '0'; // Default rating if none is found
    }
}
?>


</body>
</html>

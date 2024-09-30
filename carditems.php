<?php
include "db_connection.php";

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the card details from the database
    $sql = "SELECT * FROM category WHERE id = '$id'";
    $result = $conn->query($sql);

    // Check if the card exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found.";
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-container {
            display: flex;
            align-items: flex-start; /* Align items to the top */
            gap: 20px; /* Add space between the image and content */
            margin-top: 20px;
        }

        .card-img {
            width: 200px; /* Fixed width for the image */
          
        }

        .card-content {
            flex: 1; /* Allow content to take up remaining space */
        }

        .card-content p {
            margin-bottom: 10px; /* Add space between paragraphs */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card-container">
            <div class="card-img">
                <img src="<?php echo $row['image']; ?>" class="img-fluid" alt="<?php echo $row['name']; ?>"  style="height: 200px; object-fit: contain;">
            </div>
            <div class="card-content">
                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                <p class="card-text"><?php echo $row['description']; ?></p>
                <hr>
                <p class="card-price">Price: <?php echo number_format($row['price'], 2); ?></p>
                <button type="button" class="btn btn-warning">Add to cart</button>
            </div>
        </div>
    </div>
</body>

</html>

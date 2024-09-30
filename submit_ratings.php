<?php
include "db_connection.php";
?>
<?php
// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get rating and product_id from POST data
    $rating = $_POST['rating'];
    $product_id = $_POST['product_id'];

    // SQL query to insert rating into the database
    $sql = "INSERT INTO ratings (product_id, rating) VALUES ('$product_id', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "Rating added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}


// ----------------------------edit rating-------------------


if (isset($_POST['rating']) && isset($_POST['product_id'])) {
    $rating = $_POST['rating'];
    $product_id = $_POST['product_id'];

    // Check if a rating already exists for the product
    $checkSql = "SELECT * FROM ratings WHERE product_id = '$product_id'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Update the existing rating
        $updateSql = "UPDATE ratings SET rating = '$rating' WHERE product_id = '$product_id'";
        if ($conn->query($updateSql)) {
            echo "Rating updated successfully";
        } else {
            echo "Failed to update rating: " . $conn->error;
        }
    } else {
        // Insert a new rating
        $insertSql = "INSERT INTO ratings (product_id, rating) VALUES ('$product_id', '$rating')";
        if ($conn->query($insertSql)) {
            echo "Rating submitted successfully";
        } else {
            echo "Failed to submit rating: " . $conn->error;
        }
    }
}


// Close connection
$conn->close();
?>
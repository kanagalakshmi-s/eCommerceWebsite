
<?php
include "db_connection.php";

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $sql = "SELECT rating FROM ratings WHERE product_id='$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['rating']; // Return the rating
    } else {
        echo '0'; // Default rating if not found
    }
}
?>

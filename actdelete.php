<?php
include "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empId = $_POST['did'];  // Fetch the ID from the hidden input field

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM category WHERE id='$empId'";
    $delete = $conn->query($sql);

    if ($delete === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo 'Invalid request method';
}

// Close the connection
$conn->close();
?>

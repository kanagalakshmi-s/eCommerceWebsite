<?php
include "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empId = $_POST['hdnId'];  // Fetch the ID from the hidden input field
    $username = $_POST['name'];
    $description = $_POST['description'];
    $moredes = $_POST['moredes'];
    $price=$_POST['price'];
    

    // Handle file upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $fileTmpPath = $_FILES["image"]["tmp_name"];
        $fileName = $_FILES["image"]["name"];
        $uploadFileDir = "uploads/";
        $targetFilePath = $uploadFileDir . $fileName;

        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            $imageURL = $targetFilePath;
            $sql = "UPDATE category SET image='$imageURL' WHERE id='$empId'";
            $conn->query($sql);
        }
    }

    // Check if the username and email exist for another user
    $checkDataExists = "SELECT * FROM category WHERE id != '$empId'";
    $resultCheck = $conn->query($checkDataExists);

    // Prepare and execute the UPDATE query
    $sql = "UPDATE category SET name='$username', description='$description', moredes='$moredes', price='$price' WHERE id='$empId'";
    $update = $conn->query($sql);

    if ($update === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo 'User ID not found';
}

// Close the connection
$conn->close();
?>

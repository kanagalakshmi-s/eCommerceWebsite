<?php
include "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $moredes = $_POST['moredes'];
    $price = $_POST['price'];
    
    
    // Handle file upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // Insert into the database
    $sql = "INSERT INTO category (name, description, moredes, price, image) VALUES ('$name','$description', '$moredes', '$price', '$image')";
   if($conn->query($sql)==TRUE)
   {
   echo json_encode(['status' => 'success', 'message' => 'Data added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data insertion failed']);
    }


    $conn->close();
}
?>

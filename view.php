<?php
include "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empId = $_POST['vid'];
    
    $sql="SELECT * FROM category where id='$empId'";
    $result=$conn->query($sql);

    if($result->num_rows>0)
    {
        $row=$result->fetch_assoc();
        echo json_encode([
            'status' => 'success',
            'name' => $row['name'],
            'description' => $row['description'],
            'moredes' => $row['moredes'],
            'price' => $row['price'],
            'image' => $row['image']
        ]);
    }
    else{
        echo json_encode(['status' => 'error', 'message' => 'No record found']);

    }
        
 }

?>
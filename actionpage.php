<?php
include "db_connection.php";
///view id

if (isset($_POST['vid']))  {
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
 //delete action
 
if (isset($_POST['did'])) {
    $empId = $_POST['did'];  // Fetch the ID from the hidden input field

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM category WHERE id='$empId'";
    $delete = $conn->query($sql);

    if ($delete === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

//edit action to view datas into the popup page

if (isset($_POST['eid'])) 
{

  $empId = $_POST['eid'];

  $sql = "SELECT * FROM category where id = $empId";
 // echo   $sql;
 // exit;
 $result = $conn->query($sql);
 // echo $result->num_rows;
 // exit;
 if ($result->num_rows > 0) {    
   $row = $result->fetch_assoc();

   $data =array(
     "id" => $row['id'],
     "name" => $row['name'],
     "description" => $row['description'],
     "moredes" => $row['moredes'],
     "price" => $row['price'],
     "image"=>$row['image'],
     
   );
     
   echo json_encode($data);
   
 }
}
//update action
if (isset($_POST['hdnId'])){
    $id = intval($_POST['hdnId']);  // Ensure id is an integer
      $name = ($_POST['name']);
      $description = ($_POST['description']);
     $moredes = ($_POST['moredes']);
     $price = ($_POST['price']);
     
     $imageURL = '';
     // Check if an image is uploaded
     if (isset($_FILES["editimage"]) && $_FILES["editimage"]["error"] === UPLOAD_ERR_OK) {
         $fileTmpPath = $_FILES["editimage"]["tmp_name"];
         $fileName = $_FILES["editimage"]["name"];
         $uploadFileDir = "image/";
         $targetFilePath = $uploadFileDir . $fileName;
 
         // Move the file to the specified directory
         if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
             $imageURL = $targetFilePath;
 
             // Update image URL in the user table
             $sql = "UPDATE user SET image = '$imageURL' WHERE id = $id";
             if (!$conn->query($sql)) {
                 echo json_encode(['status' => 'error', 'message' => $conn->error]);
                 exit;
             }
         }
     }
 
     // Update category table
     $sql = "UPDATE category SET 
         name = '$name', 
        description = '$description', 
         moredes = '$moredes', 
         price = '$price'";
if ($imageURL) {
    $sql .= ", image = '$imageURL'";
}

$sql .= " WHERE id = $id";
 
    if ($conn->query($sql) === TRUE) {
         echo json_encode(['status' => 'success', 'message' => 'Data Updated successfully']);
     } 
     else {        echo json_encode(['status' => 'error', 'message' => $conn->error]);
         }

} 
//add form action

if (isset($_POST['ahdnId']) && $_POST['ahdnId'] == 'addid') {
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
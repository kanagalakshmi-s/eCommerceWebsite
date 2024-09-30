  <?php
  
  include "db_connection.php";
  
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize input values
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
 
 ?>

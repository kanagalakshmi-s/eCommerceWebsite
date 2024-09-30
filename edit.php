<?php
include "db_connection.php";
   if(isset($_POST['eid']))
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
  else{
    echo "there is a problem"; exit;
   } 


?>  

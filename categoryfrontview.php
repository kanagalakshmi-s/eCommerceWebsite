<?php
// Start session
session_start();

// Check if the user is logged in and has the 'admin' role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If not admin, redirect to the frontview or another page
    header('Location: frontview.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECommerce Website</title>
   <!-- Bootstrap 5.3.3 CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">


<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

     <!-- Bootstrap 5.3.3 JS -->
  
     <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- ajax cdn -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- DataTables CSS -->

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="styles.css">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#" id="menu-toggle"><i class="fa-solid fa-bars"></i> </a>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar and Page Content -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">
                <h2>Category List</h2>
                <span class="close-icon" id="sidebar-close"><i class="fa-solid fa-times"></i></span>
            </div>
            <div class="list-group list-group-flush">
                <a href="frontview.php" class="list-group-item list-group-item-action"><i class="fa-solid fa-house"></i> Dashboard</a>
                <a href="categoryfrontview.php" class="list-group-item list-group-item-action">Category</a>
                <a href="#" class="list-group-item list-group-item-action">Subcategory</a>
            </div>
        </div>
<!--------------------------------add form----------------------------->
        <div id="page-content-wrapper">
            <div class="container mt-5">
                <h2 class="text-center mb-4">Category List</h2>
               <!-- Button trigger modal -->
<button type="button" class="mb-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" id="addbtn">
  ADD
</button>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" id="add">
          <input type="hidden" name="ahdnId" value="addid">

          <div class="mb-4 mt-4">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
          </div>
          <div class="mb-4 mt-4">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" placeholder="Enter description" name="description">
          </div>
          <div class="mb-4 mt-4">
            <label for="moredes">More Description:</label>
            <input type="text" class="form-control" id="moredes" placeholder="Enter more description" name="moredes">
          </div>
          <div class="mb-4 mt-4">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" placeholder="Enter price" name="price">
          </div>
          <div class="mb-4 mt-4">
            <label for="image">Photo:</label><br>
            <input type="file" accept="image/*" name="image" id="image">
            <img src='' alt='Image' style='width:100px; height:100px;'>
          </div>
          <div class="mb-4 mt-4 d-flex justify-content-center">
            <button class="btn btn-primary"  type="submit" onclick="add()">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <script>
        // Toggle sidebar
        $('#menu-toggle').click(function() {
            $('#wrapper').toggleClass('toggled');
        });

        // Close sidebar
        $('#sidebar-close').click(function() {
            $('#wrapper').removeClass('toggled');
        });

     
        </script>
 <script>
   function add() {
    
    var formData = new FormData(document.getElementById('add'));

    $.ajax({
        url: 'actionpage.php',  // URL to send the request
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            // Handle success response, e.g., reload table or display a success message
            $('#addModal').modal('hide');
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
}
</script>
<!------------------------------end of add form---------------------------------------------->

                <table id="categoryTable"  class="table bordered table-striped table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>More Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action Column</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Database configuration
                        include "db_connection.php";

                        // Fetch data from database
                        $sql = "SELECT * FROM category";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo($row['name']); ?></td>
                                    <td><?php echo($row['description']); ?></td>
                                    <td><?php echo($row['moredes']); ?></td>
                                    <td><?php echo("₹".$row['price']); ?></td>
                                    <td><img src="<?php echo $row['image']; ?>" alt="Image" style="width:60px;"></td>
                                    <td>
         <button type="button" 
        onclick="editfun(<?php echo $row['id']; ?>)" 
        class="btn btn-primary" 
        data-bs-toggle="modal" 
        data-bs-target="#editModal">
        <i class="fas fa-pencil-alt"></i>
</button>
 <button class="btn btn-danger" type="button"  onclick="delete1(<?php echo $row['id']; ?>)">
    <i class="fa fa-trash"></i>
 </button>
 <button class="btn btn-warning" type="button" data-bs-toggle="modal" 
 data-bs-target="#viewModal" onclick="view(<?php echo $row['id']; ?>)">
 <i class="fa fa-eye"></i>
 </button>
                                    </td>
                                </tr>
                        <?php
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- ---------------------------------------------- -->
     <!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form  method="POST" enctype="multipart/form-data" id="editform">
          <input type="hidden" name="hdnId" id="editid" >
        
          <div class="mb-4 mt-4">
            <label for="name">Name:</label>
            <input type="text"  class="form-control" id="editname" placeholder="Enter name" name="name">
          </div>
          <div class="mb-4 mt-4">
            <label for="description">Description:</label>
            <input type="text"  class="form-control" id="editdescription" placeholder="Enter description" name="description">
          </div>
          <div class="mb-4 mt-4">
            <label for="moredes">More Description:</label>
            <input type="text" class="form-control" id="editmoredes" placeholder="Enter more description" name="moredes">
          </div>
          <div class="mb-4 mt-4">
            <label for="price">Price:</label>
            <input type="number"  class="form-control" id="editprice" placeholder="Enter price" name="price">
          </div>
          <div class="mb-4 mt-4">
            <label for="image">Photo:</label><br>
            <input type="file" accept="image/*" name="image" id="editimage">
            <img src='' id="editImagePreview" alt='Image' style='width:60px; height:60px;'>
          </div>
          <div class="mb-4 mt-4 d-flex justify-content-center">
            <button class="btn btn-primary"  type="button" onclick="update()">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- //add popup form -->
 
<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">View Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Name:</strong> <span id="viewName"></span></p>
        <p><strong>Description:</strong> <span id="viewDescription"></span></p>
        <p><strong>More Description:</strong> <span id="viewMoreDes"></span></p>
        <p><strong>Price:</strong> <span id="viewPrice"></span></p>
        <p><strong>Image:</strong><br><img src="" id="viewImage" alt="Image" style="width:60px;"></p>
      </div>
    </div>
  </div>
</div>




    <script>
        
      function editfun(id) {
    $.ajax({
       url: 'actionpage.php',
        type: 'POST',
        data: { eid: id },
        dataType: 'json',
        success: function(response) {
            $('#editid').val(response.id);
            $('#editname').val(response.name);
            $('#editdescription').val(response.description);
            $('#editmoredes').val(response.moredes);
            $('#editprice').val(response.price);

            // Display the image if available
            if (response.image) {
                $('#editImagePreview').attr('src', response.image);
            } else {
                $('#editImagePreview').attr('src', '');
            }

            $('#editModal').modal('show');
        },
        error: function(xhr, status, error) {
            console.log('Error:', error);
        }
    });
}

function update() {
   
    var formData = new FormData(document.getElementById("editform"));

    $.ajax({
        url: 'actionpage.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status === 'success') {
                alert('Product updated successfully');
                $('#editModal').modal('hide');  //to hide the popup
                // location.reload();
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function() {
            alert("AJAX request failed.");
        }
    });
}

function delete1(id)
{
   
    $.ajax({
        url:'actionpage.php',
        type:'POST',
        data:{did:id},
        dataType:'json',
        
        success:function(response){
            console.log(response);
            if(response.status=='success')
        {
            alert('deleted successfully');
        }
        else{
            alert('Error' + response.message);
        }

        },

    });
}

function view(id)
{

    // alert('hiii');
    $.ajax({
        url:'actionpage.php',
        type:'POST',
        data:{vid:id},
        dataType: 'json',
    success:function (response){
            console.log(response);
            if(response.status=='success')
        {
            // alert("hii");
           
            // $('#viewModal .modal-title').text('View Details');
                $('#viewName').text(response.name);
                $('#viewDescription').text(response.description);
                $('#viewMoreDes').text(response.moredes);
                $('#viewPrice').text("₹" + response.price);
                $('#viewImage').attr('src', response.image);  // Use .attr() for setting the src attribute

                // Show the modal
                $('#viewModal').modal('show');
        }
        else{
            alert('Error:'+response.message);
        }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);  // Log any errors
        }

    });
}

$(document).ready(function() {
    $('#categoryTable').DataTable({
        
    });
});

//datatable
$(document).ready(function() {
    

        // Toggle sidebar when the menu icon is clicked
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        });

        // Close sidebar when the close icon is clicked
        document.getElementById("sidebar-close").addEventListener("click", function () {
            document.getElementById("wrapper").classList.remove("toggled");
        });
    });

    </script>

</body>

</html>

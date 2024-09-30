<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attractive Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group img {
            max-width: 100%;
            height: auto;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border: none;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: #ffffff;
        }
        .text-center h2 {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            
            <h2 class="mb-4 text-center ">Enter product Details</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <!-- Description Field -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="description">price:</label>
                    <input type="text" class="form-control" id="description" name="price" rows="4" required></textarea>
                </div>
                
                <!-- Image Upload Field -->
                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                </div>
                
                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-custom"name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
// Database configuration
include "db_connection.php";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price=$_POST['price'];
    // Handle file upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["image"]["tmp_name"];
        $fileName = $_FILES["image"]["name"];
        $uploadFileDir = "uploads/";
        $targetFilePath = $uploadFileDir. $fileName;

        // Move the file to the specified directory
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            $imageURL = $targetFilePath; // This is the URL you will save in the database

            // Prepare and execute SQL statement
            $sql = "INSERT INTO category (name, description,price, image) VALUES ('$name', '$description','$price', '$imageURL')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "No image file uploaded or file upload error.";
    }

    // Close connection
    $conn->close();
}
?>


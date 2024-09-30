<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>datatable</title>
    <!-- jQuery -->

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

</head>
<body>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable Example</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
</head>

<body>

    <table id="example" class="display">
    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>More Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Actions</th>
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
                                    <td><img src="<?php echo $row['image']; ?>" alt="Image" style="width:100px; height:100px;"></td>
                                    <td>
                                        <button class="btn btn-warning" type="button"><a href="edit.php?id=<?php echo $row['id'];?>" class="text-dark text-decoration-none">Edit</a></button>
                                        <button class="btn btn-danger" type="button"><a href="delete.php?id=<?php echo $row['id']; ?>" class="text-white text-decoration-none">Delete</a></button>
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
            <!-- More rows as needed -->
        </tbody>
    </table>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

</body>

</html>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
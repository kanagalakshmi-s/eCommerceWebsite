<?php
session_start();
include "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve input data
    $username = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Basic SQL query
    $sql = "SELECT * FROM login WHERE username='$username' AND role='$role' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password (in a real-world scenario, use password_verify for hashed passwords)
        if ($password === $row['password']) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            echo "You are logged in";
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username or role";
    }
}

$conn->close();
?>

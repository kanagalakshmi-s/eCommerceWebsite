
<?php
session_start();
include "db_connection.php";

if (isset($_POST['submit'])) {
    // Retrieve input data
    $username = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Normal MySQL query
    $query = "SELECT * FROM login WHERE username='$username' AND role='$role' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Set session variables and redirect based on role
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 'admin') {
            header('Location: categoryfrontview.php');
        } elseif ($row['role'] == 'user') {
            header('Location: frontview.php');
        } else {
            echo "Invalid role";
        }
        exit;
    } else {
        echo "Invalid username, role, or password";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        /* Background with gradient */
        body {
            background: linear-gradient(135deg, #007bff, #00d4ff);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
            font-family: 'Arial', sans-serif;
        }

        /* Styling the header */
        header {
            background-color:#e85a5a;
            color: #fff;
            padding: 2px;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
            height: 80px;
        }

        header h1 {
            margin: 0;
            font-weight: bold;
            font-size:30px;
        }

        /* Styling the login container */
        .login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            min-height: 100vh; /* Ensures it covers full height */
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url(uploads/shoppingbg.jfif);
            background-size: cover;
            background-position: center;
            filter: blur(2px); /* Blur effect */
            opacity: 8; /* Adjust the opacity to control visibility */
            z-index: -1; /* Place it behind other content */
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-color: #fff;
            position: relative; /* Ensure it stays above the blurred background */
        }

        .card-header {
            background: linear-gradient(135deg,#8c32db, #e02bad);
            border-bottom: none;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 500;
            color: white;
        }

        .input-group-text {
            background-color: #e9ecef;
        }

        .form-control {
            height: 50px;
            border-radius: 0;
        }

        /* Button customization */
        .btn-primary {
            background: linear-gradient(135deg, #8c32db, #e02bad);
            border: none;
            height: 40px;
            width:100px;
            font-size: 1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            display:flex;
            justify-content:center;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        /* Icon customization */
        .input-group-text i {
            color: #007bff;
        }

        /* Footer styles */
        footer {
            background-color: #f0f0f5;
            color: #65695d;
            text-align: center;
            padding: 5px;
            font-size: 0.9rem;
            font-weight: bold;
        }

        /* Mobile responsiveness */
        @media (max-width: 575.98px) {
            .card {
                width: 100%;
                margin-top: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="text-center">
        <h1>ECOMMERCE WEBSITE</h1>
        <p>Welcome to the Login Page</p>
    </header>

    <!-- Main content -->
    <div class="login-container">
        <div class="card col-md-6 col-lg-4">
            <div class="card-header text-center">
                <h4>Login</h4>
            </div>
            <div class="card-body p-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">User Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                            <select name="role" id="role" class="form-select" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <small>Don't have an account? <a href="#">Sign up</a></small>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Nexgen IT Academy. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap Icons CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
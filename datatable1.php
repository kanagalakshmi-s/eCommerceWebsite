<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar and Sidebar</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar styles */
        .navbar {
            background-color: #343a40;
            color: #fff;
        }

        .navbar-brand {
            font-size: 1.5rem;
            color: #fff;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107;
        }

        /* Sidebar styles */
        #wrapper {
            display: flex;
            width: 100%;
            transition: all 0.3s ease;
        }

        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            position: fixed;
            left: -250px;
            top: 0;
            height: 100vh;
            transition: left 0.3s ease;
            z-index: 1000;
            color: #fff;
        }

        #wrapper.toggled #sidebar-wrapper {
            left: 0;
        }

        #sidebar-wrapper .sidebar-heading {
            font-size: 1.5rem;
            padding: 20px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
        }

        #sidebar-wrapper .list-group {
            margin: 0;
            padding: 0;
        }

        #sidebar-wrapper .list-group-item {
            background-color: #343a40;
            color: #fff;
            border: none;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #007bff;
        }

        /* Page content styles */
        #page-content-wrapper {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            transition: margin-left 0.3s ease;
            margin-left: 0;
        }

        #wrapper.toggled #page-content-wrapper {
            margin-left: 250px;
        }

        /* Toggle button in the navbar */
        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            color: #fff;
        }

        .container {
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyApp</a>
            <button class="navbar-toggler" type="button" id="menu-toggle">
                <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar and Page Content -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-heading">Dashboard</div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-house"></i> Home</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-list"></i> Categories</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-tags"></i> Products</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-chart-line"></i> Reports</a>
                <a href="#" class="list-group-item list-group-item-action"><i class="fa-solid fa-user"></i> Users</a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container">
                <h1 class="mb-4">Welcome to the Dashboard</h1>
                <p>This is the main content area. You can customize this section as per your needs.</p>
                <p>Use this space to show data, charts, or anything else relevant to your application.</p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to toggle the sidebar -->
    <script>
        // Toggle sidebar when the menu icon is clicked
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("wrapper").classList.toggle("toggled");
        });
    </script>

</body>

</html>

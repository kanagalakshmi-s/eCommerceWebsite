<!DOCTYPE html>
<html lang="en">
<!--dfgdsfgdsfg  -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 100px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h4 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        .input-group{
            width: 250px;
      
        }

        .input-group-text {
            background-color: #bcbec2;
            color: white;
            border: none;
        }

        .input-group-text i {
            font-size: 16px;
        }
        .card
        {
            width:400px;
        }

        .card-footer a {
            color: #007bff;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Login</h4>
                        <form class=" d-flex justify-content-center flex-column" method="POST" id="form">
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label">Message</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-comment"></i></span>
                                    <textarea class="form-control" id="comment" name="comment" placeholder="Enter your message" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" onclick="sendmail()">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>Don't have an account? <a href="#">Sign up</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function sendmail() {
            var name = $('#name').val();
            var email = $('#email').val();
            var comment = $('#comment').val();

            $.ajax({
                url: 'actindex.php',
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    comment: comment
                },
                success: function(response) {
                    $('#form')[0].reset();
                    alert("Mail sent successfully");
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        }
    </script>
</body>

</html>

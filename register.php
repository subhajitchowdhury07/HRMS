<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Kanakku - Bootstrap Admin HTML Template</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <img class="img-fluid logo-dark mb-2" src="assets/img/logo2.png" alt="Logo">
                <div class="loginbox">
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Register</h1>
                            <p class="account-subtitle">Access to our dashboard</p>

                            <!-- Display error messages -->
                            <?php
                            // Display error message from PHP if set
                            if (isset($_SESSION['status'])) {
                                echo '<div style="color: red; margin-bottom: 10px;">' . $_SESSION['status'] . '</div>';
                                unset($_SESSION['status']); // Clear the session message
                            }
                            ?>

                            <form id="registrationForm" action="phpfiles/code.php" method="post">
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <input class="form-control" type="text" placeholder="Enter Username" name="name">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input class="form-control" type="email" placeholder="Enter Email" name="email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <input class="form-control" type="password" placeholder="Enter Password"
                                        name="password" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Confirm Password</label>
                                    <input class="form-control" type="password" placeholder="Confirm password"
                                        name="cpassword">
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-lg btn-block btn-primary" type="submit"
                                        name="registration">Register</button>
                                </div>
                            </form>

                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>

                            <div class="social-login">
                                <span>Register with</span>
                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#"
                                    class="google"><i class="fab fa-google"></i></a>
                            </div>

                            <div class="text-center dont-have">Already have an account? <a href="login.php">Login</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
        // JavaScript validation
        $(document).ready(function () {
            $('#registrationForm').submit(function (event) {
                var username = $('#registrationForm [name="name"]').val();
                var email = $('#registrationForm [name="email"]').val();
                var password = $('#registrationForm [name="password"]').val();
                var cpassword = $('#registrationForm [name="cpassword"]').val();

                // Check if any mandatory field is empty
                if (!username || !email || !password || !cpassword) {
                    $('#errorMessage').text('Please fill in all mandatory fields.');
                    $('#errorMessage').show(); // Show the error message
                    event.preventDefault(); // Prevent form submission if fields are not filled
                } else {
                    $('#errorMessage').hide(); // Hide the error message if all fields are filled
                }

                // Add more validation as needed

                // Example: Check if the password meets a minimum length
                if (password.length < 6) {
                    $('#errorMessage').text('Password should be at least 6 characters long.');
                    $('#errorMessage').show(); // Show the error message
                    event.preventDefault();
                }
            });
        });
    </script>
</body>

</html>

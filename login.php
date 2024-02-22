<?php
session_start();

include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from the database based on email
    $query = "SELECT * FROM employees WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // After fetching user from the database
    if ($user) {
        // Check if the password matches
        if (password_verify($password, $user['password']) || $password == $user['password']) {
            $_SESSION['emp_id'] = $user['emp_id'];
            if ($user['user_type'] == 'admin') {
                header('Location: index.php');
            } elseif ($user['user_type'] == 'user') {
                header('Location: emp/index-employee.php');
            }
            exit();
        } else {
            $_SESSION['status'] = "Invalid password";
        }
    } else {
        $_SESSION['status'] = "Invalid email";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Sedulous Login</title>
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <img class="img-fluid logo-dark mb-2" src="assets/img/logo2.png" alt="Logo">
                <div class="loginbox">
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            <?php
                            // Display error message from PHP if set
                            if (isset($_SESSION['status'])) {
                                echo '<div style="color: red; margin-bottom: 10px;">' . $_SESSION['status'] . '</div>';
                                unset($_SESSION['status']); // Clear the session message
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" name="password">
                                        <span class="fas fa-eye toggle-password" onclick="togglePasswordVisibility(this)"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-block btn-primary" type="submit" name="login">Login</button>
                                </div>
                                <!-- <div class="login-or">
    <span class="or-line"></span>
    <span class="span-or">or</span>
</div>
<div class="social-login mb-3">
    <span>Login with</span>
    <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a><a href="#" class="google"><i class="fab fa-google"></i></a>
</div>
<div class="text-center dont-have">Don't have an account yet? <a href="register.php">Register</a></div> -->

<div class="forgot-password-link">
    <a href="forgot_password.php">Forgot password?</a>
</div>

                            </form>
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
        function togglePasswordVisibility(icon) {
            const passwordInput = icon.previousElementSibling; // Get the password input element
            if (passwordInput.type === "password") {
                passwordInput.type = "text"; // Change input type to 'text' to show the password
                icon.classList.remove('fa-eye'); // Remove the 'fa-eye' class
                icon.classList.add('fa-eye-slash'); // Add the 'fa-eye-slash' class
            } else {
                passwordInput.type = "password"; // Change input type to 'password' to hide the password
                icon.classList.remove('fa-eye-slash'); // Remove the 'fa-eye-slash' class
                icon.classList.add('fa-eye'); // Add the 'fa-eye' class
            }
        }
    </script>
</body>

</html>

<?php
session_start();

// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['emp_id'])) {
    header("Location: ../login.php");
    exit;
}

// Include your database connection code here
$host = "localhost";  // Replace with your database host
$user = "root";       // Replace with your database username
$password = "";       // Replace with your database password
$database = "hrms";   // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate OTP
function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $otp;
}

// Function to send OTP via email
function sendOTP($to, $otp) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // SMTP configuration for Google Workspace
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Google Workspace SMTP server
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // OAuth 2.0 authentication (using client ID and client secret)
    $mail->OAuth = true;
    $mail->OAuthClientId = 'http://411860258759-laorpbvmaalth6srs9m53vhsp2pcpgpn.apps.googleusercontent.com';  // Replace with your client ID
    $mail->OAuthClientSecret = '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';  // Replace with your client secret
    $mail->OAuthRefreshToken = '1//06abcdeFGHIJKLMN0123-abCDefGhIjklmNO_PQrSTuVWxYzABcDEfGhiJKlmnoP-QRsTUvwxYz&git';  // Replace with your refresh token

    // Email content
    $mail->setFrom('jchakraborty@seduloustechnologies.com', 'Sedulous Tech Solutions');  // Replace with sender email and name
    $mail->addAddress($to);
    $mail->Subject = 'Password Reset OTP';
    $mail->Body = "Your OTP for password reset is: $otp";

    // Send email
    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

// Check if email for OTP is submitted
if (isset($_POST['email_for_otp'])) {
    $email = $_POST['email_for_otp'];
    // Generate OTP
    $otp = generateOTP();
    // Send OTP via email
    if (sendOTP($email, $otp)) {
        // Store OTP in session
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_email'] = $email;
        $otp_success = "OTP has been sent to your email. Please check and enter below.";
    } else {
        $otp_error = "Failed to send OTP. Please try again later.";
    }
}

// Verify OTP
if (isset($_POST['verify_otp'])) {
    if (isset($_SESSION['otp'], $_SESSION['otp_email'])) {
        $otp_entered = $_POST['otp'];
        if ($otp_entered === $_SESSION['otp']) {
            // OTP verified successfully
            // Redirect to password reset form
            header("Location: ../reset_password.php");
            exit;
        } else {
            $otp_verify_error = "OTP entered is incorrect. Please try again.";
        }
    } else {
        $otp_verify_error = "OTP verification failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .page-wrapper {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .breadcrumb {
            background-color: #eee;
            padding: 10px;
            border-radius: 5px;
        }

        .breadcrumb-item {
            display: inline-block;
            margin-right: 5px;
        }

        .breadcrumb-item.active {
            font-weight: bold;
        }

        .card {
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f4f4f4;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card-body {
            padding: 20px;
        }

        .card-titles {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        p.error {
            color: red;
        }

        p.success {
            color: green;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php') ?>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-12 ">
                    <div class="breadcrumb-path mb-4">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-employee.php"><img src="../assets/img/dash.png" class="mr-2" alt="breadcrumb">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                        <h3>Profile</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-12 mb-4">
                    <div class="head-link-set">
                        <ul>
                            <li><a href="profile.php">Detail</a></li>
                            <!-- <li><a href="profile-document.php">Document</a></li> -->
                            <li><a href="profile-payroll.php">Payroll</a></li>
                            <li><a class="active" href="#">Settings</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-12 mb-4">
                    <div class="row">
                        <div class="col-xl-6 col-sm-12 col-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h2 class="card-titles">Change Password<span>Your password needs to be at least 8 characters long.</span></h2>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
                                    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="password" placeholder="Current Password" name="old_password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" placeholder="New Password" name="new_password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" placeholder="Repeat Password" name="confirm_password" required>
                                        </div>
                                        <button type="submit">Change Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12 col-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h2 class="card-titles">Forgot Password? Reset Here</h2>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($otp_error)) echo "<p class='error'>$otp_error</p>"; ?>
                                    <?php if (isset($otp_success)) echo "<p class='success'>$otp_success</p>"; ?>
                                    <form method="post">
                                        <div class="form-group">
                                            <input type="email" placeholder="Enter your email" name="email_for_otp" required>
                                        </div>
                                        <button type="submit">Send OTP</button>
                                    </form>
                                    <?php if (isset($otp_success) || isset($otp_error)): ?>
                                        <hr>
                                        <form method="post">
                                            <div class="form-group">
                                                <input type="text" placeholder="Enter OTP" name="otp" required>
                                            </div>
                                            <button type="submit" name="verify_otp">Verify OTP</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

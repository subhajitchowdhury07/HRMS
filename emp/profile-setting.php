<?php
include('sidebar.php');
// session_start();

// Include your database connection code
include '../db_conn.php';

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if old password, new password, and confirm password are set
    if (isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Fetch the user's plaintext password from the database
        $emp_id = $_SESSION['emp_id'];
        $sql = "SELECT password FROM employees WHERE emp_id = :emp_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['emp_id' => $emp_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            $error = "User not found.";
        } else {
            $plaintext_password = $row['password'];
            // Verify the old password
            if ($old_password === $plaintext_password) {
                // Update the password with the new one
                $update_sql = "UPDATE employees SET password = :new_password WHERE emp_id = :emp_id";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->execute(['new_password' => $new_password, 'emp_id' => $emp_id]);
                $success = "Password changed successfully.";
            } else {
                $error = "Old password is incorrect.";
            }
        }
    }
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
    // Include PHPMailer library
    include ('PHPMailer/src/PHPMailer.php');
    include ('PHPMailer/src/SMTP.php');
    include ('PHPMailer/src/Exception.php');

    // Create a new PHPMailer instance
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = '411860258759-laorpbvmaalth6srs9m53vhsp2pcpgpn.apps.googleusercontent.com';  // SMTP host
    $mail->SMTPAuth = true;
    $mail->Username = 'your@example.com';  // SMTP username
    $mail->Password = 'your_password';  // SMTP password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Email content
    $mail->setFrom('jchakraborty@seduloustechnologies.com', 'Sedulous Tech Solutions');
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
            header("Location: reset_password.php");
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
        <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-12 ">
                    <div class="breadcrumb-path mb-4" style="margin-top: 30px;">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><img src="../assets/img/dash.png" class="mr-2" alt="breadcrumb">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                        <h3>Profile</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-12 mb-4">
                    <div class="head-link-set">
                        <ul>
                            <li><a href="profile.php">Detail</a></li>
                            <!-- <li><a href="profile-document.php">Document</a></li>
                            <li><a href="profile-payroll.php">Payroll</a></li> -->
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

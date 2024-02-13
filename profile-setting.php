<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Sedulous technology .pvt .ltd</title>

</head>
<body>
<?php include("sidebar.php") ?>

<div class="page-wrapper">
<div class="content container-fluid">
<div class="row">
<div class="col-xl-12 col-sm-12 col-12 ">
<div class="breadcrumb-path mb-4">
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><img src="assets/img/dash.png" class="mr-2" alt="breadcrumb">Home</a>
</li>
<li class="breadcrumb-item active"> Profile</li>
</ul>
<h3>Profile	</h3>
</div>
</div>
<div class="col-xl-12 col-sm-12 col-12 mb-4">
<div class="head-link-set">
<ul>
<!-- <li><a href="profile.php">Employement</a></li> -->
<li><a href="profile.php">Detail</a></li>
<li><a href="profile-document.php">Document</a></li>
<li><a href="profile-payroll.php">Payroll</a></li>
<!-- <li><a href="profile-timeoff.html">Timeoff</a></li> -->
<!-- <li><a href="profile-review.html">Reviews</a></li> -->
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
<div class="form-group">
<input type="text" placeholder="Current Password">
</div>
<div class="form-group">
<input type="text" placeholder="New Password">
</div>
<div class="form-group">
<input type="text" placeholder="Repeat Password">
</div>
<div class="btn-set pl-0">
<a class="btn btn-apply">Change My Password</a>
</div>
</div>
</div>
</div>
<div class="col-xl-6 col-sm-12 col-12 d-flex">
<div class="card flex-fill">
<div class="card-header">
<h2 class="card-titles">Company Notification Settings<span>You will receive information across the whole company.</span></h2>
</div>
<div class="card-body">
<div class="company-set">
<ul>
<li>
<div class="company-path checkworking">
<input type="checkbox" id="che1">
<label for="che1">
Weekly Summarize
<span>Keeping you in the loop with a weekly email summarizing</span>
</label>
</div>
</li>
<li>
<div class="company-path checkworking">
<input type="checkbox" id="che2">
<label for="che2">Weekly Payroll Summarize
<span>A weekly email containing all changes related to your payroll..</span>
</label>
</div>
</li>
<li>
<div class="company-path checkworking">
<input type="checkbox" id="che3">
<label for="che3">Visa Dates
<span>Informs and notify the day before Visa dates for each team member.</span>
</label>
</div>
</li>
</ul>
</div>
<div class="btn-set pl-0">
<a class="btn btn-apply">Update Notification Settings</a>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-12 col-sm-12 col-12 ">
<div class="row">
<div class="col-xl-12 col-sm-12 col-12 ">
<div class="card ">
<div class="card-header">
<h2 class="card-titles">Team Member Notification Settings<span>You will receive notifications only for Team Leads.</span></h2>
</div>
<div class="card-body">
<div class="company-set">
<ul>
<li>
<div class="company-path checkworking">
<input type="checkbox" id="che6">
<label for="che6">Birthdays
<span>Reasons to party with reminders a week and a day before a team member’s birthday.</span>
</label>
</div>
</li>
<li>
<div class="company-path checkworking">
<input type="checkbox" id="che7">
<label for="che7">Work Anniversaries
<span>Never miss work anniversaries with reminders the week and the day before.</span>
</label>
</div>
</li>
<li>
<div class="company-path checkworking">
<input type="checkbox" id="che8">
<label for="che8">Key Dates
<span>Informs and notify the day before key dates for each team member.</span>
</label>
</div>
</li>
<li>
<div class="company-path checkworking">
<input type="checkbox" id="che4">
<label for="che4">Off Boardings
<span>Informs you when a team member has a leaving date set and reminds you the day before.</span>
</label>
</div>
</li>
<li>
<div class="company-path checkworking">
<input type="checkbox" id="che5">
<label for="che5">Work From Home Notifications
<span>Never miss a notification that someone will be working from home.</span>
</label>
</div>
</li>
</ul>
</div>
<div class="btn-set pl-0">
<a class="btn btn-apply">Update Notification Settings</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>
=======
<?php
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if old password, new password, and confirm password are set
    if (isset($_POST['old_password'], $_POST['new_password'], $_POST['confirm_password'])) {
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Fetch the user's plaintext password from the database
        $emp_id = $_SESSION['emp_id'];
        $sql = "SELECT password FROM employees WHERE emp_id = '$emp_id'";
        $result = $conn->query($sql);
        if (!$result) {
            $error = "Query execution failed: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $plaintext_password = $row['password'];
            // Verify the old password
            if ($old_password === $plaintext_password) {
                // Update the password with the new one
                $update_sql = "UPDATE employees SET password = '$new_password' WHERE emp_id = '$emp_id'";
                if ($conn->query($update_sql) === TRUE) {
                    $success = "Password changed successfully.";
                } else {
                    $error = "Error updating password: " . $conn->error;
                }
            } else {
                $error = "Old password is incorrect.";
            }
        } else {
            $error = "User not found.";
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
    include ('PHPMailer-master/src/PHPMailer.php');
    include ('PHPMailer-master/src/SMTP.php');
    include ('PHPMailer-master/src/Exception.php');

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
    <?php include('sidebar.php') ?>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-12 ">
                    <div class="breadcrumb-path mb-4">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><img src="assets/img/dash.png" class="mr-2" alt="breadcrumb">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                        <h3>Profile</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-12 mb-4">
                    <div class="head-link-set">
                        <ul>
                            <li><a href="profile.php">Detail</a></li>
                            <li><a href="profile-document.php">Document</a></li>
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
>>>>>>> c982c37 (Second update)

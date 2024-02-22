<?php
session_start();

// Include your database connection code
include 'db_conn.php';

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- <link rel="shortcut icon" href="assets/img/favicon.png"> -->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Add your CSS styles here -->
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 90px;
            padding: 0;
        }

        .page-wrapper {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            width: 400px;
            margin: auto;
            text-align: center;
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
            background-color: #28a745; /* Green color */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #218838; /* Darker green color on hover */
        }

        p.error {
            color: red;
        }

        p.success {
            color: green;
        }

        img.logo {
            width: 40%; /* Adjust size as needed */
            margin-bottom: 20px;
            /* padding: 20px; */
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <img src="assets/img/logo2.png" alt="Logo" class="logo">
        <h2>Forgot Password</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <form method="post">
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" id="old_password" name="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit">Change Password</button>
        </form>
    </div>
</body>
</html>

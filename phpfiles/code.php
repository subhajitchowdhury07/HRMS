<?php
session_start();

if (isset($_POST['registration'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if any of the fields are empty
    if (empty($username) || empty($email) || empty($password) || empty($cpassword)) {
        $_SESSION['status'] = "Please provide valid input for all fields.";
        header('Location: /dashboard-human-resources-html-main/register.php');
        exit();
    }

    // Check if the password and confirm password match
    if ($password !== $cpassword) {
        $_SESSION['status'] = "Password and confirm password do not match";
        header('Location: register.php');
        exit();
    }

    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "hrms");

    // Check for database connection error
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query
    $query = "INSERT INTO admin_registration (name, email, password) VALUES ('$username', '$email', '$password')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['success'] = "Admin profile added";
        header('Location: /dashboard-human-resources-html-main/login.php');
        exit();
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($conn);
        header('Location: register.php');
        exit();
    }
} else {
    $_SESSION['status'] = "Registration form not submitted";
    header('Location: register.php');
    exit();
}
?>

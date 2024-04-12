<?php
// Retrieve email and password from the request
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection details
$servername = "localhost";
$username = "u431054670_root";
$password_db = "Sedulous@123"; // Your MySQL password
$databaseName = ''; // Enter the name of the database created earlier

// Create database connection
$connDB = new mysqli($servername, $username, $password_db, $databaseName);

// Check connection
if ($connDB->connect_error) {
    die("Database connection failed: " . $connDB->connect_error);
}

// Insert director into the employees table
$insertEmployeeQuery = "INSERT INTO employees (email, password, user_type) VALUES ('$email', '$password', 'director')";
if ($connDB->query($insertEmployeeQuery) === TRUE) {
    echo "Director registered successfully in employees table";
} else {
    echo "Error registering director in employees table: " . $connDB->error;
}

// Close database connection
$connDB->close();
?>

<?php
// Generate a random database name
$databaseName = 'db_' . bin2hex(random_bytes(4));

// Database connection details
$servername = "localhost";
$username = "u431054670_root";
$password_db = "Sedulous@123"; // Your MySQL password
$sqlFilePath = "database/hrms_3.sql"; // Path to preloaded SQL file

// Create main database connection
$connMain = new mysqli($servername, $username, $password_db);

// Check main connection
if ($connMain->connect_error) {
    die("Main connection failed: " . $connMain->connect_error);
}

// Create new database
$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $databaseName";
if ($connMain->query($sqlCreateDB) === TRUE) {
    echo "Database created successfully<br>";

    // Close main database connection
    $connMain->close();

    // Create connection to the new database
    $connDB = new mysqli($servername, $username, $password_db, $databaseName);

    // Check new database connection
    if ($connDB->connect_error) {
        die("New database connection failed: " . $connDB->connect_error);
    }

    // Import SQL file
    $sql = file_get_contents($sqlFilePath);
    if ($connDB->multi_query($sql) === TRUE) {
        echo "SQL file imported successfully<br>";
    } else {
        echo "Error importing SQL file: " . $connDB->error;
    }

    // Close new database connection
    $connDB->close();
} else {
    echo "Error creating database: " . $connMain->error;
    $connMain->close();
}
?>

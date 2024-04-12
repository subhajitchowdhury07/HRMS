<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

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

            // Clear remaining results
            while ($connDB->more_results()) {
                $connDB->next_result();
            }

            // Insert director into the employees table
            $insertEmployeeQuery = "INSERT INTO employees (email, password, user_type) VALUES ('$email', '$password', 'director')";
            if ($connDB->query($insertEmployeeQuery) === TRUE) {
                echo "Director registered successfully in employees table";
            } else {
                echo "Error registering director in employees table: " . $connDB->error;
            }
        } else {
            echo "Error importing SQL file: " . $connDB->error;
        }

        // Close new database connection
        $connDB->close();
    } else {
        echo "Error creating database: " . $connMain->error;
        $connMain->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        /* Paste your CSS code here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

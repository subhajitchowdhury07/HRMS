<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize and validate input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_team_member"])) {
    // Clean and validate input data
    $first_name = clean_input($_POST["first_name"]);
    $last_name = clean_input($_POST["last_name"]);
    $email = clean_input($_POST["email"]);
    $country_of_employment = clean_input($_POST["country_of_employment"]);
    $start_date = clean_input($_POST["start_date"]);
    $job_title = clean_input($_POST["job_title"]);
    $employment_type = clean_input($_POST["employment_type"]);
    $currency = clean_input($_POST["currency"]);
    $salary_frequency = clean_input($_POST["salary_frequency"]);
    $salary_start_date = clean_input($_POST["salary_start_date"]);

    // Insert data into the employees table
    $sql = "INSERT INTO employees (first_name, last_name, email, country_of_employment, start_date, job_title, employment_type, currency, salary_frequency, salary_start_date)
            VALUES ('$first_name', '$last_name', '$email', '$country_of_employment', '$start_date', '$job_title', '$employment_type', '$currency', '$salary_frequency', '$salary_start_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Team member added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

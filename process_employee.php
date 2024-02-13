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
<<<<<<< HEAD
=======
    $emp_id = clean_input($_POST["id"]);
>>>>>>> c982c37 (Second update)
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
<<<<<<< HEAD

    // Insert data into the employees table
    $sql = "INSERT INTO employees (first_name, last_name, email, country_of_employment, start_date, job_title, employment_type, currency, salary_frequency, salary_start_date)
            VALUES ('$first_name', '$last_name', '$email', '$country_of_employment', '$start_date', '$job_title', '$employment_type', '$currency', '$salary_frequency', '$salary_start_date')";
=======
    $phone_number = clean_input($_POST["phone_number"]);
    $reporting_to = clean_input($_POST["reporting_to"]);
    $source_of_hire = clean_input($_POST["source_of_hire"]);
    $seating_location = clean_input($_POST["seating_location"]);
    $title = clean_input($_POST["title"]);
    $employee_status = clean_input($_POST["employee_status"]);
    $other_email = clean_input($_POST["other_email"]);
    $birth_date = clean_input($_POST["birth_date"]);
    $marital_status = clean_input($_POST["marital_status"]);
    $address = clean_input($_POST["address"]);
    $tags = clean_input($_POST["tags"]);
    $job_description = clean_input($_POST["job_description"]);
    $date_of_exit = clean_input($_POST["date_of_exit"]);
    $gender = clean_input($_POST["gender"]);
    $gross_salary = clean_input($_POST["gross_salary"]);

    // Insert data into the employees table
    $sql = "INSERT INTO employees (id, first_name, last_name, email, country_of_employment, start_date, job_title, employment_type, currency, salary_frequency, salary_start_date, phone_number, reporting_to, source_of_hire, seating_location, title, employee_status, other_email, birth_date, marital_status, address, tags, job_description, date_of_exit, gender, gross_salary)
            VALUES ('$emp_id', '$first_name', '$last_name', '$email', '$country_of_employment', '$start_date', '$job_title', '$employment_type', '$currency', '$salary_frequency', '$salary_start_date', '$phone_number', '$reporting_to', '$source_of_hire', '$seating_location', '$title', '$employee_status', '$other_email', '$birth_date', '$marital_status', '$address', '$tags', '$job_description', '$date_of_exit', '$gender', '$gross_salary')";
>>>>>>> c982c37 (Second update)

    if ($conn->query($sql) === TRUE) {
        echo "Team member added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
<<<<<<< HEAD
?>
=======
?>
>>>>>>> c982c37 (Second update)

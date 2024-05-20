<?php
// Include the database connection file
include('db_conn.php');

// Function to sanitize and validate input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_team_member"])) {
    try {
        // Clean and validate input data
        $emp_id = clean_input($_POST["emp_id"]);
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
        $phone_number = clean_input($_POST["phone_number"]);
        $department = clean_input($_POST["department"]);
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

        // Prepare the SQL statement for insertion
        $sql = "INSERT INTO employees (emp_id, first_name, last_name, email, country_of_employment, start_date, job_title, employment_type, currency, salary_frequency, salary_start_date, phone_number, department, reporting_to, source_of_hire, seating_location, title, employee_status, other_email, birth_date, marital_status, address, tags, job_description, date_of_exit, gender, gross_salary)
                VALUES (:emp_id, :first_name, :last_name, :email, :country_of_employment, :start_date, :job_title, :employment_type, :currency, :salary_frequency, :salary_start_date, :phone_number,:department , :reporting_to, :source_of_hire, :seating_location, :title, :employee_status, :other_email, :birth_date, :marital_status, :address, :tags, :job_description, :date_of_exit, :gender, :gross_salary)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':emp_id', $emp_id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':country_of_employment', $country_of_employment);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':job_title', $job_title);
        $stmt->bindParam(':employment_type', $employment_type);
        $stmt->bindParam(':currency', $currency);
        $stmt->bindParam(':salary_frequency', $salary_frequency);
        $stmt->bindParam(':salary_start_date', $salary_start_date);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':department', $department);
        $stmt->bindParam(':reporting_to', $reporting_to);
        $stmt->bindParam(':source_of_hire', $source_of_hire);
        $stmt->bindParam(':seating_location', $seating_location);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':employee_status', $employee_status);
        $stmt->bindParam(':other_email', $other_email);
        $stmt->bindParam(':birth_date', $birth_date);
        $stmt->bindParam(':marital_status', $marital_status);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':date_of_exit', $date_of_exit);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':gross_salary', $gross_salary);
        $stmt->execute();

        echo "Team member added successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$conn = null;
?>

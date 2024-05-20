<?php
// Include your database connection file here
include("db_conn.php");

// Get the employee ID from the URL
$employeeId = $_GET['id'] ?? null;

// Check if the connection is established
if ($conn) {
    // Query to fetch employee details
    $query = "SELECT * FROM employees";

    // If employee ID is provided, fetch details for that employee only
    if ($employeeId) {
        $query .= " WHERE id = :emp_id";
    }

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind parameters if employee ID is provided
    if ($employeeId) {
        $stmt->bindParam(':emp_id', $employeeId, PDO::PARAM_INT);
    }

    // Execute the query
    if ($stmt->execute()) {
        // Create a CSV file
        $filename = 'employee_details.csv';
        $fp = fopen('php://output', 'w');

        // Add CSV headers
        $headers = array('id', 'emp_id', 'first_name', 'last_name', 'email', 'password', 'department', 'user_type', 'country_of_employment', 'start_date', 'job_title', 'employment_type', 'currency', 'salary_frequency', 'salary_start_date', 'phone_number', 'reporting_to', 'source_of_hire', 'seating_location', 'title', 'employee_status', 'other_email', 'birth_date', 'marital_status', 'address', 'tags', 'job_description', 'date_of_exit', 'gender', 'gross_salary', 'profile_pic', 'manager_id');
        fputcsv($fp, $headers);

        // Add employee details to the CSV file
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($fp, $row);
        }

        // Close the file
        fclose($fp);

        // Set headers for file download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        exit;
    } else {
        // Handle error if query fails
        echo "Error: " . $stmt->errorInfo()[2];
    }
} else {
    // Handle error if connection fails
    echo "Connection failed.";
}
?>

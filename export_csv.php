<?php
// Include your database connection code here
include("db_conn.php");

// Get filter parameters
$startDate = $_POST['startDate'] ?? null;
$endDate = $_POST['endDate'] ?? null;
$employeeID = $_POST['employeeID'] ?? null;

// Build the SQL query
$query = "SELEC* FROM attendance WHERE 1";

if ($startDate && $endDate) {
    $query .= " AND DATE(clock_in) BETWEEN '$startDate' AND '$endDate'";
}

if ($employeeID) {
    $query .= " AND employee_id = '$employeeID'";
}

// Fetch data from database
$result = $conn->query($query);

// Check if export to CSV button is clicked
if (isset($_POST['exportCSV'])) {
    // Generate CSV file
    $filename = 'attendance_records.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('Employee Name', 'Clock In', 'Clock Out', 'Total Worked Hour'));

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit; // Terminate further script execution
}
$conn->close();
?>

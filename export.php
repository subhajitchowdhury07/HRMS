<?php
// Include your database connection code here
include("db_conn.php");

// Get filter parameters
$startDate = $_POST['startDate'] ?? null;
$endDate = $_POST['endDate'] ?? null;
$employeeID = $_POST['employeeID'] ?? null;

// Build the SQL query
$query = "SELECT attendance.*, CONCAT(employees.first_name, ' ', employees.last_name) AS employee_name FROM attendance LEFT JOIN employees ON attendance.employee_id = employees.emp_id WHERE 1";

if ($startDate && $endDate) {
    $query .= " AND DATE(attendance.clock_in) BETWEEN '$startDate' AND '$endDate'";
}

if ($employeeID) {
    $query .= " AND attendance.employee_id = '$employeeID'";
}

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->execute();

// Check if export to CSV button is clicked
if (isset($_POST['exportCSV'])) {
    // Generate CSV file
    $filename = 'attendance_records.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    $output = fopen('php://output', 'w');
    fputcsv($output, array('Employee ID', 'Employee Name', 'Clock In', 'Clock Out', 'Total Worked Hour'));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Exclude the 'id' field from the row
        unset($row['id']);

        // Adjust the order of data to match the header
        $csvRow = array(
            $row['employee_id'],
            $row['employee_name'],
            $row['clock_in'],
            $row['clock_out'],
            $row['total_worked_hr']
        );

        fputcsv($output, $csvRow);
    }

    fclose($output);
    exit; // Terminate further script execution
}

// Check if export to PDF button is clicked
if (isset($_POST['exportPDF'])) {
    // Include the library
    require('fpdf.php');

    // Create a new PDF instance
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10); // Set font to bold for title headings

    // Add table headers with capitalized headings
    $pdf->Cell(28, 10, 'Employee ID', 1);
    $pdf->Cell(47, 10, 'Employee Name', 1);
    $pdf->Cell(39, 10, 'Clock In', 1);
    $pdf->Cell(39, 10, 'Clock Out', 1);
    $pdf->Cell(35, 10, 'Total Worked Hour', 1);
    $pdf->Ln();

    // Reset font to normal for table data
    $pdf->SetFont('Arial','',10);

    // Add table data
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(28, 10, $row['employee_id'], 1);
        $pdf->Cell(47, 10, $row['employee_name'], 1);
        $pdf->Cell(39, 10, $row['clock_in'], 1);
        $pdf->Cell(39, 10, $row['clock_out'], 1);
        $pdf->Cell(35, 10, $row['total_worked_hr'], 1);
        $pdf->Ln();
    }

    // Output the PDF
    $pdf->Output();
    exit; // Terminate further script execution
}

$conn = null; // Close the PDO connection
?>

<?php
// Include your database connection code here
include("db_conn.php");

// Get filter parameters
$startDate = $_POST['startDate'] ?? null;
$endDate = $_POST['endDate'] ?? null;
$employeeID = $_POST['employeeID'] ?? null;

// Build the SQL query
$query = "SELECT * FROM attendance WHERE 1";

if ($startDate && $endDate) {
    $query .= " AND DATE(clock_in) BETWEEN '$startDate' AND '$endDate'";
}

if ($employeeID) {
    $query .= " AND employee_id = '$employeeID'";
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
    fputcsv($output, array('ID','Employee ID', 'Clock In', 'Clock Out', 'Total Worked Hour'));

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit; // Terminate further script execution
}

// Check if export to PDF button is clicked
if (isset($_POST['exportPDF'])) {
    // Include the library
    require('fpdf.php');

    // Create a new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);

    // Add table headers
    $pdf->Cell(48, 10, 'Employee ID', 1);
    $pdf->Cell(48, 10, 'Clock In', 1);
    $pdf->Cell(48, 10, 'Clock Out', 1);
    $pdf->Cell(48, 10, 'Total Worked Hour', 1);
    $pdf->Ln();

    // Add table data
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(48, 10, $row['employee_id'], 1);
        $pdf->Cell(48, 10, $row['clock_in'], 1);
        $pdf->Cell(48, 10, $row['clock_out'], 1);
        $pdf->Cell(48, 10, $row['total_worked_hr'], 1);
        $pdf->Ln();
    }

    // Output the PDF
    $pdf->Output();
    exit; // Terminate further script execution
}

$conn = null; // Close the PDO connection
?>

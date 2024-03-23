<?php
// Include database connection
include('db_conn.php');
session_start();
error_reporting(0);

// Check if user is logged in as admin or director
if (!isset($_SESSION['id']) || ($_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'director')) {
    header("Location: login.php");
    exit();
}

// Function to fetch employee names and IDs
function getEmployees($conn) {
    $query = "SELECT id, first_name, emp_id FROM employees";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to fetch timesheet entries based on filters
function fetchTimesheetEntries($conn, $employeeId, $startDate, $endDate) {
    $query = "SELECT t.*, p.project_name, p.department, p.client_name, e.first_name, e.emp_id 
              FROM timesheet t
              LEFT JOIN projects p ON t.project_id = p.project_id
              JOIN employees e ON t.user_id = e.id
              WHERE (:employeeId IS NULL OR t.user_id = :employeeId)
              AND (:startDate IS NULL OR DATE(t.start_time) >= :startDate)
              AND (:endDate IS NULL OR DATE(t.end_time) <= :endDate)
              ORDER BY t.start_time DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':employeeId', $employeeId);
    $stmt->bindParam(':startDate', $startDate);
    $stmt->bindParam(':endDate', $endDate);
    $stmt->execute();
    $timesheetEntries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format hours worked in hours:minutes:seconds format
    foreach ($timesheetEntries as &$entry) {
        $hours = floor($entry['hours_worked']);
        $minutes = floor(($entry['hours_worked'] - $hours) * 60);
        $seconds = round((($entry['hours_worked'] - $hours) * 60 - $minutes) * 60);

        $entry['hours_worked'] = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    return $timesheetEntries;
}

// Fetch employee names and IDs
$employees = getEmployees($conn);

// Handle form submission for filtering
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['filter'])) {
        $employeeId = $_POST['employee_id'] !== '' ? $_POST['employee_id'] : null;
        $startDate = $_POST['start_date'] !== '' ? $_POST['start_date'] : null;
        $endDate = $_POST['end_date'] !== '' ? $_POST['end_date'] : null;

        // Fetch timesheet entries based on filters
        $timesheetEntries = fetchTimesheetEntries($conn, $employeeId, $startDate, $endDate);
    } elseif(isset($_POST['download'])) {
        $employeeId = $_POST['employee_id'] !== '' ? $_POST['employee_id'] : null;
        $startDate = $_POST['start_date'] !== '' ? $_POST['start_date'] : null;
        $endDate = $_POST['end_date'] !== '' ? $_POST['end_date'] : null;

        // Fetch timesheet entries based on filters
        $timesheetEntries = fetchTimesheetEntries($conn, $employeeId, $startDate, $endDate);
        
        // Prepare CSV data
        $csvData = "Task,Duration,Start Time,End Time,Project Name,Department,Client Name,Employee Name,Employee ID\n";
        foreach ($timesheetEntries as $entry) {
            $csvData .= "{$entry['task']},{$entry['hours_worked']},{$entry['start_time']},{$entry['end_time']},{$entry['project_name']},{$entry['department']},{$entry['client_name']},{$entry['first_name']},{$entry['emp_id']}\n";
        }

        // Set headers for CSV download
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="timesheet_entries.csv"');
        echo $csvData;
        exit();
    }
}

// Fetch all timesheet entries
$allTimesheetEntries = fetchTimesheetEntries($conn, null, null, null);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Timesheet View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select, input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            margin-right: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php'); ?>
    <div class="page-wrapper">
        <div class="container">
            <h2 style="color: #51ad26;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;">Admin Timesheet View</h2>
            <form method="post">
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id">
                    <option value="">Select Employee</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee['id']; ?>"><?= $employee['first_name']; ?> (<?= $employee['emp_id']; ?>)</option>
                    <?php endforeach; ?>
                </select>
                <label for="start_date">From Date:</label>
                <input type="date" id="start_date" name="start_date">
                <label for="end_date">To Date:</label>
                <input type="date" id="end_date" name="end_date">
                <input type="submit" name="filter" value="Filter">
                <input type="submit" name="download" value="Download CSV">
            </form>

            <?php if (isset($timesheetEntries)): ?>
                <h3 style="color: #51ad26;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;">Filtered Timesheet Entries</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Duration</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Project Name</th>
                            <th>Department</th>
                            <th>Client Name</th>
                            <th>Employee Name</th>
                            <th>Employee ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($timesheetEntries as $entry): ?>
                            <tr>
                                <td><?= $entry['task']; ?></td>
                                <td><?= $entry['hours_worked']; ?></td>
                                <td><?= $entry['start_time']; ?></td>
                                <td><?= $entry['end_time']; ?></td>
                                <td><?= isset($entry['project_name']) ? $entry['project_name'] : ''; ?></td>
                                <td><?= isset($entry['department']) ? $entry['department'] : ''; ?></td>
                                <td><?= isset($entry['client_name']) ? $entry['client_name'] : ''; ?></td>
                                <td><?= $entry['first_name']; ?></td>
                                <td><?= $entry['emp_id']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <h3 style="color: #51ad26;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;">All Timesheet Entries</h3>
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Duration</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Project Name</th>
                        <th>Department</th>
                        <th>Client Name</th>
                        <th>Employee Name</th>
                        <th>Employee ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allTimesheetEntries as $entry): ?>
                        <tr>
                            <td><?= $entry['task']; ?></td>
                            <td><?= $entry['hours_worked']; ?></td>
                            <td><?= $entry['start_time']; ?></td>
                            <td><?= $entry['end_time']; ?></td>
                            <td><?= isset($entry['project_name']) ? $entry['project_name'] : ''; ?></td>
                            <td><?= isset($entry['department']) ? $entry['department'] : ''; ?></td>
                            <td><?= isset($entry['client_name']) ? $entry['client_name'] : ''; ?></td>
                            <td><?= $entry['first_name']; ?></td>
                            <td><?= $entry['emp_id']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

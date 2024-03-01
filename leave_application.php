<?php
session_start();
include('db_conn.php'); // Include your database connection script

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch leave types from the database
$sql = "SELECT * FROM leave_type";
$stmt = $conn->query($sql);
$leaveTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process leave application
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leaveTypeId = $_POST['leave_type'];
    $employeeId = $_SESSION['user_id'];

    // Validate leave type
    if (empty($leaveTypeId)) {
        echo "Please select a leave type.";
    } else {
        // Fetch employee's leave balance from employee_meta table
        $sql = "SELECT meta_value FROM employee_meta WHERE employee_id = :employee_id AND meta_field = 'leave_balance'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employee_id', $employeeId);
        $stmt->execute();
        $leaveBalance = $stmt->fetchColumn();

        // Fetch selected leave type's increment value from leave_type table
        $sql = "SELECT increment_value FROM leave_type WHERE type_id = :leave_type_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':leave_type_id', $leaveTypeId);
        $stmt->execute();
        $incrementValue = $stmt->fetchColumn();

        // Deduct leave from leave balance
        $updatedLeaveBalance = $leaveBalance - $incrementValue;

        // Update leave balance in employee_meta table
        $sql = "UPDATE employee_meta SET meta_value = :updated_leave_balance WHERE employee_id = :employee_id AND meta_field = 'leave_balance'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':updated_leave_balance', $updatedLeaveBalance);
        $stmt->bindParam(':employee_id', $employeeId);
        if ($stmt->execute()) {
            echo "Leave application successful. Leave balance updated.";
        } else {
            echo "Error applying for leave.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>
</head>
<body>
    <h2>Leave Application</h2>
    <form method="post">
        <label for="leave_type">Leave Type:</label>
        <select name="leave_type" id="leave_type">
            <option value="">Select leave type</option>
            <!-- Populate options from database -->
            <?php foreach ($leaveTypes as $leaveType): ?>
                <option value="<?php echo $leaveType['type_id']; ?>"><?php echo $leaveType['type_name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" value="Apply for Leave">
    </form>
</body>
</html>

<?php include('sidebar.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* margin-top:20px; */
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Ensure it's on top of everything */
        }

        .message-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 220px;
        }

        p {
            color: #555;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            position: absolute;
            
            /* top:0; */
            left:0;
            /* width: 100%; */
            width: 100%;
            height: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
        }

        input[type="submit"] {
            background-color: green;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }
    </style>
</head>
<body>

<?php

// session_start();

// Check if employee ID is set in session
if (!isset($_SESSION['emp_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

include('../db_conn.php');

// Fetch user information based on emp_id
$query = "SELECT * FROM employees WHERE emp_id = :emp_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':emp_id', $_SESSION['emp_id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch leave types available for the current user from the allotted_leave table
$allottedLeaveQuery = "SELECT sl.leave_type
                        FROM allotted_leave al
                        INNER JOIN setleave sl ON al.leave_type_id = sl.id
                        WHERE al.employeeID = :emp_id";
$allottedLeaveStmt = $conn->prepare($allottedLeaveQuery);
$allottedLeaveStmt->bindParam(':emp_id', $_SESSION['emp_id']);
$allottedLeaveStmt->execute();
$leaveTypes = $allottedLeaveStmt->fetchAll(PDO::FETCH_COLUMN);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data and insert into leaves table
    $emp_id = $_SESSION['emp_id'];
    $leave_type = $_POST["leave_type"];
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $description = $_POST["description"];
    $allowed_day = $_POST["allowed_day"];
    
    // Get manager ID from the user data
    $manager_id = $user['manager_id'];

    // Fetch leave_type_id from setleave table based on the selected leave type
    $leaveType = $_POST["leave_type"];
    $leaveTypeIdQuery = "SELECT id FROM setleave WHERE leave_type = :leave_type";
    $leaveTypeIdStmt = $conn->prepare($leaveTypeIdQuery);
    $leaveTypeIdStmt->bindParam(':leave_type', $leaveType);
    $leaveTypeIdStmt->execute();
    $leaveTypeId = $leaveTypeIdStmt->fetchColumn();

    // Fetch starting balance from allotted_leave table using user ID and leave type ID
    $startingBalanceQuery = "SELECT starting_balance FROM allotted_leave WHERE employeeID = :emp_id AND leave_type_id = :leave_type_id";
    $startingBalanceStmt = $conn->prepare($startingBalanceQuery);
    $startingBalanceStmt->bindParam(':emp_id', $emp_id);
    $startingBalanceStmt->bindParam(':leave_type_id', $leaveTypeId);
    $startingBalanceStmt->execute();
    $startingBalanceRow = $startingBalanceStmt->fetch(PDO::FETCH_ASSOC);

    if ($startingBalanceRow) {
        $startingBalance = $startingBalanceRow['starting_balance'];

        // Calculate the number of days between from_date and to_date
        $start = new DateTime($from_date);
        $end = new DateTime($to_date);
        $interval = $start->diff($end);
        $numDays = $interval->days + 1; // Include both start and end dates

        // Check if the starting balance is zero
        if ($startingBalance <= 0) {
            echo "<script>alert('Error: You do not have enough balance for this leave type.');</script>";
        }
        // Check if the selected number of days exceeds the starting balance
        elseif ($numDays > $startingBalance) {
            echo "<script>alert('Error: You do not have enough balance for $numDays days of leave.');</script>";
        } else {
            // Insert leave application into leaves table
            $sql = "INSERT INTO leaves (emp_id, leave_type, from_date, to_date, description, status, allowed_day, available_balance, leave_id, manager_id) 
                    VALUES (:emp_id, :leave_type, :from_date, :to_date, :description, 'Pending', :allowed_day, :starting_balance, :leave_id, :manager_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':emp_id', $emp_id);
            $stmt->bindParam(':leave_type', $leave_type);
            $stmt->bindParam(':from_date', $from_date);
            $stmt->bindParam(':to_date', $to_date);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':allowed_day', $allowed_day);
            $stmt->bindParam(':starting_balance', $startingBalance);
            $stmt->bindParam(':leave_id', $leaveTypeId);
            $stmt->bindParam(':manager_id', $manager_id);

            if ($stmt->execute()) {
                echo "<script>alert('Leave application submitted successfully');</script>";
            } else {
                echo "<script>alert('Error: Unable to submit leave application');</script>";
            }
        }
    } else {
        echo "<script>alert('Error: Starting balance not found for the selected leave type. User ID: $emp_id, Leave Type ID: $leaveTypeId');</script>";
    }
}
?>

<div class="page-wrapper">
    <h2 class="mb-3">Leave Application Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Display the employee ID -->
        <label for="emp_id">Employee ID:</label>
        <input type="text" name="emp_id" value="<?php echo isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : ''; ?>" readonly>
        
        <!-- Fetch and display leave types in a dropdown -->
        <?php if (!empty($leaveTypes)): ?>
            <label for="leave_type">Leave Type:</label>
            <select id="leave_type" name="leave_type" required>
                <?php foreach ($leaveTypes as $leaveType): ?>
                    <option value="<?php echo $leaveType; ?>"><?php echo $leaveType; ?></option>
                <?php endforeach; ?>
            </select><br>
        <?php else: ?>
            <p>No leave types available</p>
        <?php endif; ?>
        
        <!-- Select half or full day -->
        <label for="allowed_day">Duration :</label>
        <select name="allowed_day" id="allowed_day" onclick="toggleField(this)">
            <option value="full">Full Day</option>
            <option value="half">Half Day</option>
        </select>

        <!-- Other form fields -->
        <label for="from_date">From Date:</label>
        <input type="date" name="from_date" required>

        <label for="to_date">To Date:</label>
        <input type="date" name="to_date" required>

        <label for="description">Description:</label>
        <textarea rows="8" cols="20" name="description" required></textarea>

        

        <input type="submit" value="Submit">
    </form>
</div>

<script>
    // Example JavaScript
    document.addEventListener("DOMContentLoaded", function () {
        console.log("Form loaded!");
    });
</script>
</body>
</html>
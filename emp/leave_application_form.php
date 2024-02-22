<?php include('sidebar.php'); ?>
<?php
session_start();

// Check if employee ID is set in session
if (!isset($_SESSION['emp_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

include('../db_conn.php');

// Fetch leave types from the tableleaves table
$leaveTypesQuery = "SELECT * FROM tableleaves";
$leaveTypesStmt = $conn->query($leaveTypesQuery);
$leaveTypes = $leaveTypesStmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data and insert into leaves table
    $emp_id = $_POST["emp_id"];
    $leave_type = $_POST["leave_type"];
    $from_date = $_POST["from_date"];
    $to_date = $_POST["to_date"];
    $description = $_POST["description"];

    $sql = "INSERT INTO leaves (emp_id, leave_type, from_date, to_date, description) 
            VALUES (:emp_id, :leave_type, :from_date, :to_date, :description)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':emp_id', $emp_id);
    $stmt->bindParam(':leave_type', $leave_type);
    $stmt->bindParam(':from_date', $from_date);
    $stmt->bindParam(':to_date', $to_date);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        echo "Leave application submitted successfully";
    } else {
        echo "Error: Unable to submit leave application";
    }
}
?>

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
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
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
            width: 100%;
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
    
    <h2>Leave Application Form</h2>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Display the employee ID -->
        <label for="emp_id">Employee ID:</label>
        <input type="text" name="emp_id" value="<?php echo isset($_SESSION['emp_id']) ? $_SESSION['emp_id'] : ''; ?>" readonly>
        
        <!-- Fetch and display leave types in a dropdown -->
        <?php if (!empty($leaveTypes)): ?>
            <label for="leave_type">Leave Type:</label>
            <select name="leave_type" required>
                <?php foreach ($leaveTypes as $leaveType): ?>
                    <option value="<?php echo $leaveType['LeaveType']; ?>"><?php echo $leaveType['LeaveType']; ?></option>
                <?php endforeach; ?>
            </select><br>
        <?php else: ?>
            <p>No leave types available</p>
        <?php endif; ?>

        <!-- Other form fields -->
        <label for="from_date">From Date:</label>
        <input type="date" name="from_date" required>

        <label for="to_date">To Date:</label>
        <input type="date" name="to_date" required>

        <label for="description">Description:</label>
        <textarea rows="8" cols="20" name="description" required></textarea>

        <input type="submit" value="Submit">
    </form>
    <script>
        // Example JavaScript
        document.addEventListener("DOMContentLoaded", function () {
            console.log("Form loaded!");
        });
    </script>
    <!-- Your JavaScript code -->
</body>
</html>

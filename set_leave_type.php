<?php
session_start();

$message = '';

if (!isset($_SESSION['emp_id']) || !isset($_SESSION['user_type'])) {
    header("Location: login.php");
    exit();
}

// Check if user is admin or director
if ($_SESSION['user_type'] !== 'admin') {
    header("Location: unauthorized.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "db_conn.php";

    // Validate and sanitize input
    $leave_type = $_POST["leave_type"];
    $allowed_day = $_POST["allowed_day"];
    $type = $_POST["type"];
    $leave_description = $_POST["leave_description"];

    try {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO setleave (leave_type, allowed_day, type, leave_description) VALUES (:leave_type, :allowed_day, :type, :leave_description)");

        // Bind parameters
        $stmt->bindParam(':leave_type', $leave_type);
        $stmt->bindParam(':allowed_day', $allowed_day);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':leave_description', $leave_description);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $message = "Leave type set successfully.";
        } else {
            $message = "Oops! Something went wrong. Please try again later.";
        }
    } catch (PDOException $e) {
        // Handle database error
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Leave</title>
</head>
<body>
    <h2>Set Leave</h2>
    <?php if (!empty($message)): ?>
    <div><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="leave_type">Leave Type:</label>
            <input type="text" name="leave_type" id="leave_type" required>
        </div>
        <div>
            <label for="allowed_day">Allowed Day:</label>
            <select name="allowed_day" id="allowed_day">
                <option value="full">Full Day</option>
                <option value="half">Half Day</option>
            </select>
        </div>
        <div>
            <label for="type">Type:</label>
            <select name="type" id="type">
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
            </select>
        </div>
        <div>
            <label for="leave_description">Leave Description:</label>
            <textarea name="leave_description" id="leave_description" rows="4" cols="50"></textarea>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>

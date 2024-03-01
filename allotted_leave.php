<?php
session_start();

if (!isset($_SESSION['emp_id']) || !isset($_SESSION['user_type'])) {
    header("Location: login.php");
    exit();
}

// Check if user is admin or director
if ($_SESSION['user_type'] !== 'admin') {
    header("Location: unauthorized.php");
    exit();
}

require_once "db_conn.php";

$message = '';

// Fetch permanent employees for dropdown
$stmt = $conn->prepare("SELECT id, First_name FROM employees WHERE employment_type = 'permanent'");
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["employee_id"];
    $starting_balance = $_POST["starting_balance"];
    $allowed_day = $_POST["allowed_day"];
    $leave_type_id = $_POST["leave_type_id"];

    try {
        $stmt = $conn->prepare("INSERT INTO allotted_leave (employee_id, First_name, starting_balance, allowed_day, leave_type_id) VALUES (?, (SELECT First_name FROM employees WHERE id = ?), ?, ?, ?)");
        $stmt->execute([$employee_id, $employee_id, $starting_balance, $allowed_day, $leave_type_id]);

        $message = "Leave allotted successfully.";
    } catch (PDOException $e) {
        // Show an error message
        $message = "Oops! Something went wrong. Please try again later. Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allot Leave</title>
</head>
<body>
    <h2>Allot Leave</h2>
    <?php if (!empty($message)): ?>
        <div><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="employee_id">Select Employee:</label>
            <select name="employee_id" id="employee_id" required>
                <option value="">Select Employee</option>
                <?php foreach ($employees as $employee): ?>
                    <option value="<?php echo $employee['id']; ?>"><?php echo $employee['First_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="leave_type_id">Select Leave Type:</label>
            <select name="leave_type_id" id="leave_type_id" required>
                <option value="">Select Leave Type</option>
                <?php
                $stmt = $conn->query("SELECT id, leave_type FROM setleave");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['leave_type']}</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="starting_balance">Starting Balance:</label>
            <input type="number" name="starting_balance" id="starting_balance" required>
        </div>
        <div>
            <label for="allowed_day">Allowed Day:</label>
            <select name="allowed_day" id="allowed_day" required>
                <option value="full">Full Day</option>
                <option value="half">Half Day</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>

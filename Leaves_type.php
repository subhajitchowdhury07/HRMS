<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leave_type = $_POST["leave_type"];
    $starting_balance = $_POST["starting_balance"];
    $increment_frequency = $_POST["increment_frequency"];
    $increment_value = $_POST["increment_value"];
    $max_limit = $_POST["max_limit"];
    $total_max_limit_value = $_POST["total_max_limit_value"];

    try {
        $stmt = $conn->prepare("INSERT INTO set_leaves (LeaveType, StartingBalance, IncrementFrequency, IncrementValue, MaxLimit, TotalMaxLimitValue) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$leave_type, $starting_balance, $increment_frequency, $increment_value, $max_limit, $total_max_limit_value]);
        echo "Leave type added successfully!";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Leave Type Form</title>
</head>
<body>
    <h2>Leave Type Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="leave_type">Leave Type:</label>
        <input type="text" id="leave_type" name="leave_type" required><br><br>

        <label for="starting_balance">Starting Balance:</label>
        <input type="number" id="starting_balance" name="starting_balance" required><br><br>

        <label for="increment_frequency">Increment Frequency:</label>
        <select id="increment_frequency" name="increment_frequency">
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="bi_annually">Bi-annually</option>
            <option value="annually">Annually</option>
        </select><br><br>

        <label for="increment_value">Increment Value (per day):</label>
        <input type="number" id="increment_value" name="increment_value" required><br><br>

        <label for="max_limit">Max Limit:</label>
        <select id="max_limit" name="max_limit">
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
            <option value="all_time">All Time</option>
        </select><br><br>

        <label for="total_max_limit_value">Total Max Limit Value:</label>
        <input type="number" id="total_max_limit_value" name="total_max_limit_value" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
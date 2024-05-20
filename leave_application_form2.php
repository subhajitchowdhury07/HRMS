<?php
include 'db_conn.php';

// Fetch leave types from database
$sql = "SELECT LeaveType FROM set_leaves";
$result = $conn->query($sql);

$leave_types = array(); // Initialize an array to store leave types

if ($result->rowCount() > 0) {
    // Fetching each row of result and adding leave types to the array
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $leave_types[] = $row["LeaveType"];
    }
} else {
    echo "No leave types available"; // If no leave types found
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leave_type = $_POST["leave_type"];
    $days_taken = $_POST["days_taken"];

    try {
        $stmt = $conn->prepare("SELECT TotalMaxLimitValue FROM set_leaves WHERE LeaveType = ?");
        $stmt->execute([$leave_type]);
        $total_available_leaves = $stmt->fetchColumn();

        if ($total_available_leaves >= $days_taken) {
            $updated_leaves = $total_available_leaves - $days_taken;
            $stmt = $conn->prepare("UPDATE set_leaves SET TotalMaxLimitValue = ? WHERE LeaveType = ?");
            $stmt->execute([$updated_leaves, $leave_type]);
            echo "Leave application submitted successfully!";
        } else {
            echo "Insufficient leaves available!";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Leave Application Form</title>
</head>
<body>
    <h2>Leave Application Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="leave_type">Leave Type:</label>
        <select id="leave_type" name="leave_type">
            <?php
            // Display leave types fetched from the database
            foreach ($leave_types as $leave_type) {
                echo "<option value='$leave_type'>$leave_type</option>";
            }
            ?>
        </select><br><br>

        <label for="days_taken">Days Taken:</label>
        <input type="number" id="days_taken" name="days_taken" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
// Connect to your MySQL database
$pdo = new PDO('mysql:host=localhost;dbname=hrms', 'root', '');

// Declare user_id variable
$user_id = 1; // Replace with the actual user ID

// Handle clock in
if (isset($_POST['clock_in'])) {
    $sql = "INSERT INTO timeclock (user_id, time_in) VALUES (?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
}

// Handle clock out
if (isset($_POST['clock_out'])) {
    $sql = "UPDATE timeclock SET time_out = NOW() WHERE user_id = ? AND time_out IS NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
}

// Calculate total worked time
$sql = "SELECT SUM(IFNULL(TIMESTAMPDIFF(SECOND, time_in, COALESCE(time_out, NOW())), 0)) AS total_seconds FROM timeclock WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$result = $stmt->fetch();
$total_worked_seconds = $result['total_seconds'];

// Convert seconds to hours and minutes
$total_worked_hours = floor($total_worked_seconds / 3600);
$total_worked_minutes = floor(($total_worked_seconds % 3600) / 60);

echo "Total worked time: $total_worked_hours hours and $total_worked_minutes minutes";
?>

<!-- HTML form -->
<form method="post">
    <input type="submit" name="clock_in" value="Clock In">
    <input type="submit" name="clock_out" value="Clock Out">
</form>

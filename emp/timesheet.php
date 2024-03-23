<?php
// Include database connection
include('../db_conn.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch user's department
$userId = $_SESSION['id'];
$departmentQuery = "SELECT department FROM employees WHERE id = :userId";
$departmentStmt = $conn->prepare($departmentQuery);
$departmentStmt->bindParam(':userId', $userId);
$departmentStmt->execute();
$department = $departmentStmt->fetchColumn();

// Fetch projects based on user's department
$projectsQuery = "SELECT project_id, project_name FROM projects WHERE department = :department";
$projectsStmt = $conn->prepare($projectsQuery);
$projectsStmt->bindParam(':department', $department);
$projectsStmt->execute();
$projects = $projectsStmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize task and start time from session if available
$task = isset($_SESSION['task']) ? $_SESSION['task'] : '';
$start_time = isset($_SESSION['start_time']) ? $_SESSION['start_time'] : '';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['start_timer'])) {
        // Start timer
        $_SESSION['task'] = $_POST['task'];
        $_SESSION['project_id'] = $_POST['project_id'];
        $task = $_SESSION['task'];
        $_SESSION['start_time'] = time(); // Update start time
        $start_time = $_SESSION['start_time'];
    } elseif (isset($_POST['stop_timer'])) {
        // Stop timer and calculate hours worked
        $endTime = time();
        $startTime = $_SESSION['start_time'];
        $hoursWorked = round(($endTime - $startTime) / 3600, 2);
        $task = $_SESSION['task'];
        $projectId = $_SESSION['project_id'];

        // Insert timesheet entry into database
        $insertQuery = "INSERT INTO timesheet (user_id, project_id, task, hours_worked, start_time, end_time) 
                        VALUES (:userId, :projectId, :task, :hoursWorked, FROM_UNIXTIME(:startTime), FROM_UNIXTIME(:endTime))";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(':userId', $userId);
        $insertStmt->bindParam(':projectId', $projectId);
        $insertStmt->bindParam(':task', $task);
        $insertStmt->bindParam(':hoursWorked', $hoursWorked);
        $insertStmt->bindParam(':startTime', $startTime);
        $insertStmt->bindParam(':endTime', $endTime);
        $insertStmt->execute();

        // Clear session variables
        unset($_SESSION['task']);
        unset($_SESSION['project_id']);
        unset($_SESSION['start_time']);
        
        // Clear task and start time
        $task = '';
        $start_time = '';
    }
}

// Fetch user's tasks from timesheet including project name
$tasksQuery = "SELECT t.task, t.hours_worked, t.start_time, t.end_time, p.project_name 
               FROM timesheet t
               JOIN projects p ON t.project_id = p.project_id
               WHERE t.user_id = :userId ORDER BY t.start_time DESC";
$tasksStmt = $conn->prepare($tasksQuery);
$tasksStmt->bindParam(':userId', $userId);
$tasksStmt->execute();
$tasks = $tasksStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timesheet</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    button {
        font-size: 18px;
        background-color: #008542;
        color: #fff;
        text-shadow: 0 2px 0 rgb(0 0 0 / 25%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border: 0;
        z-index: 1;
        user-select: none;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
        white-space: unset;
        padding: 0.8rem 1.5rem;
        text-decoration: none;
        font-weight: 900;
        transition: all 0.7s cubic-bezier(0, 0.8, 0.26, 0.99);
    }

    button:before {
        position: absolute;
        pointer-events: none;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        content: "";
        transition: 0.7s cubic-bezier(0, 0.8, 0.26, 0.99);
        z-index: -1;
        background-color: #008542 !important;
        box-shadow: 0 -4px rgb(21 108 0 / 50%) inset,
            0 4px rgb(100 253 31 / 99%) inset, -4px 0 rgb(100 253 31 / 50%) inset,
            4px 0 rgb(21 108 0 / 50%) inset;
    }

    button:after {
        position: absolute;
        pointer-events: none;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        content: "";
        box-shadow: 0 4px 0 0 rgb(0 0 0 / 15%);
        transition: 0.7s cubic-bezier(0, 0.8, 0.26, 0.99);
    }

    button:hover:before {
        box-shadow: 0 -4px rgb(0 0 0 / 50%) inset, 0 4px rgb(255 255 255 / 20%) inset,
            -4px 0 rgb(255 255 255 / 20%) inset, 4px 0 rgb(0 0 0 / 50%) inset;
    }

    button:hover:after {
        box-shadow: 0 4px 0 0 rgb(0 0 0 / 15%);
    }

    button:active {
        transform: translateY(4px);
    }

    button:active:after {
        box-shadow: 0 0px 0 0 rgb(0 0 0 / 15%);
    }



    .stop_btn:before {
        position: absolute;
        pointer-events: none;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        content: "";
        transition: 0.7s cubic-bezier(0, 0.8, 0.26, 0.99);
        z-index: -1;
        background-color: #dc3545 !important;
        /* Red */
        box-shadow: 0 -4px rgb(255 0 0 / 50%) inset,
            /* Red */
            0 4px rgb(255 0 0 / 50%) inset, -4px 0 rgb(255 0 0 / 50%) inset,
            /* Red */
            4px 0 rgb(255 0 0 / 50%) inset;

    }

    .stop_btn:after {
        position: absolute;
        pointer-events: none;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        height: 100%;
        content: "";
        box-shadow: 0 4px 0 0 rgb(255 0 0 / 15%);
        /* Red */
        transition: 0.7s cubic-bezier(0, 0.8, 0.26, 0.99);
    }

    .page-wrapper {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    h2 {
        margin-top: 0;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .timer {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    input[type="text"]:focus,
    select:focus {
        border-color: #007bff;
        outline: none;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .inputGroup {
        font-family: 'Segoe UI', sans-serif;
        margin: 1em 0 1em 0;
        max-width: 190px;
        position: relative;
    }

    .inputGroup input {
        font-size: 100%;
        padding: 0.8em;
        outline: none;
        border: 2px solid rgb(200, 200, 200);
        background-color: transparent;
        border-radius: 20px;
        width: 100%;
    }

    .inputGroup label {
        font-size: 100%;
        position: absolute;
        left: 0;
        padding: 0.8em;
        margin-left: 0.5em;
        pointer-events: none;
        transition: all 0.3s ease;
        color: rgb(100, 100, 100);
    }

    .inputGroup :is(input:focus, input:valid)~label {
        transform: translateY(-50%) scale(.9);
        margin: 0em;
        margin-left: 1.3em;
        padding: 0.4em;
        background-color: #e8e8e8;
    }

    .inputGroup :is(input:focus, input:valid) {
        border-color: rgb(150, 150, 200);
    }
    </style>
</head>

<body>
    <?php include('sidebar.php') ?>
    <div class="page-wrapper">
        <h2 style="color: #51ad26;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;">Timesheet</h2>
        <form method="post">
            <!-- <div class="form-group"> -->
            <div class="inputGroup">
                <input type="text" id="task" name="task" value="<?= htmlspecialchars($task) ?>" required>
                <label for="task">Task:</label>
            </div>
            <!-- </div> -->
            <div class="form-group" style="margin-right:460px">
                <label for="project">Project:</label>
                <select name="project_id" id="project">
                    <option value="">Select Project</option>
                    <?php foreach ($projects as $project): ?>
                    <option value="<?= $project['project_id']; ?>"><?= htmlspecialchars($project['project_name']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="startbtn" style="margin-bottom:20px">
                <button type="submit" name="start_timer">Start Timer</button>
                <button type="submit" name="stop_timer" class="stop_btn">Stop Timer</button>
                <input type="hidden" id="start_time" name="start_time" value="<?= $start_time ?>">
            </div>
        </form>

        <?php
        if ($start_time) {
            // Display timer using JavaScript
            echo "<div class='timer' id='timer'></div>";
        }
        ?>

        <?php if (!empty($tasks)): ?>
        <h2 style="color: #51ad26;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px; margin-top:60px">My Tasks</h2>
        <table style="color:#212121">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Project</th>
                    <th>Hours Worked</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task['task']) ?></td>
                    <td><?= htmlspecialchars($task['project_name']) ?></td>
                    <td>
                        <?php
    // Convert hours worked to hours, minutes, and seconds
    $hoursWorked = $task['hours_worked'];
    $hours = floor($hoursWorked);
    $minutes = floor(($hoursWorked - $hours) * 60);
    $seconds = round((($hoursWorked - $hours) * 60 - $minutes) * 60);

    // Format and display time
    echo sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    ?>
                    </td>

                    <td><?= htmlspecialchars($task['start_time']) ?></td>
                    <td><?= htmlspecialchars($task['end_time']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>

    <script>
    // JavaScript code for timer
    var startTime = <?= $start_time ?: 'null' ?>;
    var timerElement = document.getElementById('timer');

    function updateTimer() {
        if (startTime === null) return;

        var currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
        var elapsedTime = currentTime - startTime;
        var hours = Math.floor(elapsedTime / 3600);
        var minutes = Math.floor((elapsedTime % 3600) / 60);
        var seconds = elapsedTime % 60;

        // Format time display
        var hoursStr = (hours < 10) ? '0' + hours : hours;
        var minutesStr = (minutes < 10) ? '0' + minutes : minutes;
        var secondsStr = (seconds < 10) ? '0' + seconds : seconds;

        // Update timer display
        timerElement.textContent = 'Timer: ' + hoursStr + ':' + minutesStr + ':' + secondsStr;
    }

    // Start timer if start time is set
    if (startTime !== null) {
        setInterval(updateTimer, 1000); // Update timer every second
    }
    </script>
</body>

</html>
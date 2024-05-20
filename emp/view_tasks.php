<?php 
ob_start();
include('sidebar.php');
// session_start();

// Check if user is logged in
if (!isset($_SESSION['emp_id'])) {
    header("Location: ../login.php");
    exit();
}

// Set the default time zone to Indian Standard Time (IST)
date_default_timezone_set('Asia/Kolkata');

// Fetch the corresponding employee id based on emp_id
$queryEmployeeId = "SELECT id FROM employees WHERE emp_id = :emp_id";
$stmtEmployeeId = $conn->prepare($queryEmployeeId);
$stmtEmployeeId->bindParam(':emp_id', $_SESSION['emp_id']);
$stmtEmployeeId->execute();
$employeeId = $stmtEmployeeId->fetchColumn();

// Fetch tasks assigned to the logged-in employee
$query = "SELECT * FROM tasks WHERE employee_id = :employee_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':employee_id', $employeeId);
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_completed'])) {
    $taskId = $_POST['task_id'];
    // Fetch the current date and time in IST
$currentDateTime = date('Y-m-d h:i:s A'); // Format with 12-hour clock and AM/PM indicator

// Update the task record with the submit date and time
$queryUpdate = "UPDATE tasks SET status = 'Completed', submit_date_time = :submit_date_time WHERE task_id = :task_id";
$stmtUpdate = $conn->prepare($queryUpdate);
$stmtUpdate->bindParam(':submit_date_time', $currentDateTime);
$stmtUpdate->bindParam(':task_id', $taskId);
$stmtUpdate->execute();


    // Redirect back to the same page to refresh the tasks list
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tasks</title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .left-side {
            margin-top: 20px;
        }

        h2 {
            color: #51ad26;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #51ad26;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        button[type="submit"] {
            padding: 0.6em 2em;
            border: none;
            outline: none;
            color: rgb(255, 255, 255);
            background: #111;
            cursor: pointer;
            position: relative;
            z-index: 0;
            border-radius: 10px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        button[type="submit"] {
            background-color: initial;
            background-image: linear-gradient(-180deg, #00D775, #00BD68);
        }

        button[type="submit"]:hover {
            background: #00bd68;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            h2 {
                font-size: 24px;
            }

            table {
                font-size: 14px;
            }

            th,
            td {
                padding: 6px;
            }

            button[type="submit"] {
                padding: 6px 12px;
                font-size: 14px;
            }

            .container {
                padding: 10px; /* Adjust padding for smaller screens */
                overflow-y: auto; /* Add vertical scrollbar if needed */
            }
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="container">
            <div class="left-side">
                <h2>My Tasks</h2>
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Task Description</th>
                            <th>Status</th>
                            <th>Date Assigned</th>
                            <th>Time Deadline</th>
                            <th>Admin Remark</th>
                            <th>Mark as Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task): ?>
                        <tr>
                        <td class="task-description"><?php echo $task['task_description']; ?></td>
                            <td><?php echo $task['status']; ?></td>
                            <td><?php echo $task['date_assigned']; ?></td>
                            <td><?php echo $task['deadline_time']; ?></td>
                            <td><?php echo $task['admin_remark']; ?></td>
                            <td>
                                <?php if ($task['status'] != 'Completed'): ?>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <button type="submit" name="mark_completed" class="button1">Mark as Completed</button>
                                </form>
                                <?php else: ?>
                                    Completed
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    var taskDescriptions = document.querySelectorAll('.task-description');
    taskDescriptions.forEach(function(td) {
        var text = td.innerText;
        var maxLength = 40; // Change the number of characters as needed
        if (text.length > maxLength) {
            var firstLine = text.substring(0, maxLength);
            var remainingText = text.substring(maxLength);
            var newText = firstLine + '<br>' + remainingText;
            td.innerHTML = newText;
        }
    });
});

    </script>
</body>

</html>
<?php 
ob_start();
include('sidebar.php');
// session_start();

// Check if user is logged in
if (!isset($_SESSION['emp_id'])) {
    header("Location: ../login.php");
    exit();
}

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
    // Process mark completed action here

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
    .page-wrapper {
        padding: 20px;
    }
    .content {
        background-color: #f3f3f3;
        padding: 20px;
    }
    h2 {
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
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
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    box-sizing: border-box;
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

th, td {
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

/* Responsive Styles */
@media (max-width: 768px) {
    h2 {
        font-size: 24px;
    }

    table {
        font-size: 14px;
    }

    th, td {
        padding: 6px;
    }

    button[type="submit"] {
        padding: 6px 12px;
        font-size: 14px;
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
                            <th>Mark as Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?php echo $task['task_description']; ?></td>
                            <td><?php echo $task['status']; ?></td>
                            <td><?php echo $task['date_assigned']; ?></td>
                            <td>
                                <?php if ($task['status'] != 'Completed'): ?>
                                <form method="post" action="mark_completed.php">
                                    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
                                    <button type="submit" class="button1">Mark as Completed</button>
                                </form>
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
</body>

</html>
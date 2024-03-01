<?php
ob_start();
include('sidebar.php');
// session_start();

include('db_conn.php');

// Check if user is logged in
if (!isset($_SESSION['emp_id']) || !isset($_SESSION['user_type'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if user is director or admin
if ($_SESSION['user_type'] !== 'director' && $_SESSION['user_type'] !== 'admin') {
    // Redirect to unauthorized page
    header("Location: unauthorized.php");
    exit();
}

// Fetch all employees for dropdown
$sqlEmployees = "SELECT id, first_name FROM employees";
$stmtEmployees = $conn->query($sqlEmployees);
$employees = $stmtEmployees->fetchAll(PDO::FETCH_ASSOC);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_task'])) {
        // Add Task
        $emp_id = $_POST['emp_id'];
        $task = $_POST['task'];
        $deadline = $_POST['deadline'];
        $assigned_by = $_SESSION['emp_id']; // Assigned by the current user

        // Insert task into tasks table
        $sql = "INSERT INTO tasks (employee_id, task_description, status, date_assigned, assigned_by) VALUES (:employee_id, :task_description, :status, :date_assigned, :assigned_by)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employee_id', $emp_id);
        $stmt->bindParam(':task_description', $task);
        $stmt->bindValue(':status', 'Pending'); // Default status
        $stmt->bindValue(':date_assigned', date('Y-m-d')); // Current date
        $stmt->bindParam(':assigned_by', $assigned_by);

        if ($stmt->execute()) {
            // Redirect to this page to avoid form resubmission
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "Error inserting task: " . $stmt->errorInfo()[2];
        }
    } elseif (isset($_POST['edit_task'])) {
        // Edit Task
        $task_id = $_POST['task_id'];
        $editedTaskDescription = $_POST['editedTaskDescription'];

        // Update task description in tasks table
        $sql = "UPDATE tasks SET task_description = :task_description WHERE task_id = :task_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':task_description', $editedTaskDescription);
        $stmt->bindParam(':task_id', $task_id);

        if ($stmt->execute()) {
            // Redirect to this page to avoid form resubmission
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "Error updating task: " . $stmt->errorInfo()[2];
        }
    } elseif (isset($_POST['delete_task'])) {
        // Delete Task
        $task_id = $_POST['task_id'];

        // Delete task from tasks table
        $sql = "DELETE FROM tasks WHERE task_id = :task_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':task_id', $task_id);

        if ($stmt->execute()) {
            // Redirect to this page to avoid form resubmission
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "Error deleting task: " . $stmt->errorInfo()[2];
        }
    }
}

// Fetch all tasks assigned by the current user
$assigned_by = $_SESSION['emp_id'];
$sqlTasks = "SELECT tasks.*, employees.first_name 
             FROM tasks 
             INNER JOIN employees ON tasks.employee_id = employees.id 
             WHERE tasks.assigned_by = :assigned_by";
$stmtTasks = $conn->prepare($sqlTasks);
$stmtTasks->bindParam(':assigned_by', $assigned_by);
$stmtTasks->execute();
$tasks = $stmtTasks->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        padding: 20px;
    }

    .left-side,
    .right-side {
        width: 100%;
        max-width: 600px;
        margin-bottom: 20px;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    h1 {
        text-align: center;
        color: #706c62;
        border-radius: 15px;
        /* margin: 0 10px 30px 10px; */
        /* box-shadow: 10px 7px 10px #629e46; */
    }

    form {
        width: 100%;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 5px;
    }

    label,
    input,
    select {
        display: block;
        margin-bottom: 10px;
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        margin-top:25px;
        display: flex;
  align-items: center;
  font-family: inherit;
  font-weight: 500;
  font-size: 16px;
  padding: 0.7em 1.4em 0.7em 1.1em;
  color: white;
  background: #ad5389;
  background: linear-gradient(0deg, rgba(20,167,62,1) 0%, rgba(102,247,113,1) 100%);
  border: none;
  box-shadow: 0 0.7em 1.5em -0.5em #14a73e98;
  letter-spacing: 0.05em;
  border-radius: 20em;
  cursor: pointer;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
    }

    button[type="submit"]:hover {
        box-shadow: 0 0.5em 1.5em -0.5em #14a73e98;
    }
    button[type="submit"]:active{
        box-shadow: 0 0.3em 1em -0.5em #14a73e98;
    }
    h2 {
        text-align: center;
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

    .assign-task h1 {
        color: #706c62;
        /* border: 1px solid black; */
        margin: 0 10px 50px 10px;
        /* box-shadow: 10px 10px 5px #6d92a1; */
    }

    .assign-task table {
        width: 100%;
    }

    .edit-delete-buttons button {
        border: none;
        background: none;
        cursor: pointer;
        margin-right: 5px;
    }

    /* Edit and Delete Button Styles */
    .edit-delete-buttons button {
        border: none;
        background: none;
        cursor: pointer;
        margin-right: 5px;
    }

    /* Edit Task Modal */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 5px;
        max-width: 400px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Delete Task Modal */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 5px;
        max-width: 400px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    @media (min-width: 768px) {
        .container {
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: 80px;
        }

        .left-side,
        .right-side {
            width: 45%;
            max-width: none;
            margin-bottom: 0;
        }

        h1 {
            margin: 0 130px 30px 130px;
        }

        .assign-task h1 {
            margin: 0 370px 50px 370px;
        }
    }

    @media (max-width: 767px) {
        h1 {
            margin: 0 10px 30px 10px;
        }

        .assign-task h1 {
            margin: 0 10px 50px 10px;
        }
    }
    </style>
    <style>
    /* Modal container */
    .modal-container {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
        transition: opacity 0.3s ease;
    }

    /* Modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        animation-name: animatetop;
        animation-duration: 0.4s;
        transition: opacity 0.3s ease;
    }

    /* Modal animation */
    @keyframes animatetop {
        from {top: -300px; opacity: 0}
        to {top: 0; opacity: 1}
    }
</style>
<style>

    /* Delete button style */
    .delete-button {
        background-color: #f44336; /* Red background color */
    }
</style>

</head>

<body>
    <div class="page-wrapper">
        <div class="container">
            <div class="left-side">
                <img src="assets/img/add_task.gif" alt="GIF">
            </div>
            <div class="right-side">
                <h1>Add Task</h1>
                <form action="" method="post">
                    <label for="emp_id">Employee:</label>
                    <select name="emp_id" id="emp_id">
                        <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee['id'] ?>"><?= $employee['first_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="task">Task:</label>
                    <input type="text" name="task" id="task" required>
                    <label for="deadline">Deadline:</label>
                    <input type="date" name="deadline" id="deadline" required>
                    <button type="submit" name="add_task">Add Task</button>
                </form>
            </div>
        </div>
        <div class="assign-task">
            <h1>Assigned Tasks</h1>
            <table>
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Task Description</th>
                        <th>Status</th>
                        <th>Date Assigned</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['first_name'] ?></td>
                        <td><?= $task['task_description'] ?></td>
                        <td>
                            <?php if ($task['status'] === 'Completed'): ?>
                            <span style="color: green; font-weight: bold;">
                                <?= $task['status'] ?>
                                <img src="assets/img/check.gif" alt="Completed GIF" width="20">
                            </span>
                            <?php elseif ($task['status'] === 'Pending'): ?>
                            <span style="color: blue; font-weight: bold;">
                                <?= $task['status'] ?>
                                <img src="assets/img/pending-4.gif" alt="Pending GIF" width="25">
                            </span>
                            <?php endif; ?>

                            <!-- Edit and Delete Buttons -->
                            <div class="edit-delete-buttons">
                            <button type="button" onclick="openEditModal(<?= $task['task_id'] ?>, '<?= $task['task_description'] ?>')">
    <img src="assets/img/edit-1.png" alt="Edit" width="15">
</button>

                                <!-- Delete button -->
<button type="button" class="delete-button" onclick="openDeleteModal(<?= $task['task_id'] ?>)">
    <img src="assets/img/delete.png" alt="Delete" width="20">
</button>

                            </div>
                        </td>

                        <!-- Edit Task Modal -->
<div id="editTaskModal<?= $task['task_id'] ?>" class="modal-container">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal(<?= $task['task_id'] ?>)">&times;</span>
        <form id="editTaskForm" action="" method="post">
            <input type="hidden" id="editTaskId<?= $task['task_id'] ?>" name="task_id">
            <textarea id="editedTaskDescription<?= $task['task_id'] ?>" name="editedTaskDescription" placeholder="New Task Description" required></textarea>
            <button type="submit" name="edit_task">Save Changes</button>
        </form>
    </div>
</div>
                        <!-- Delete Task Modal -->
                        <div id="deleteTaskModal<?= $task['task_id'] ?>" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeDeleteModal(<?= $task['task_id'] ?>)">&times;</span>
                                <form id="deleteTaskForm" action="" method="post">
                                    <p>Are you sure you want to delete this task?</p>
                                    <input type="hidden" id="deleteTaskId<?= $task['task_id'] ?>" name="task_id">
                                    <button type="submit" name="delete_task">Delete</button>
                                </form>
                            </div>
                        </div>
                        <td><?= $task['date_assigned'] ?></td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <script>
    // Get the edit task modal
    var editTaskModal<?= $task['task_id'] ?> = document.getElementById("editTaskModal<?= $task['task_id'] ?>");

    // Get the delete task modal
    var deleteTaskModal<?= $task['task_id'] ?> = document.getElementById("deleteTaskModal<?= $task['task_id'] ?>");

        // Function to open edit task modal
        function openEditModal(taskId, taskDescription) {
        document.getElementById("editTaskId" + taskId).value = taskId;
        document.getElementById("editedTaskDescription" + taskId).value = taskDescription;
        document.getElementById("editTaskModal" + taskId).style.display = "block";
    }

    // Function to close edit task modal
    function closeEditModal(taskId) {
        document.getElementById("editTaskModal" + taskId).style.display = "none";
    }

    // Function to open delete task modal
    function openDeleteModal(taskId) {
        document.getElementById("deleteTaskId" + taskId).value = taskId;
        deleteTaskModal<?= $task['task_id'] ?>.style.display = "block";
    }

    // Function to close delete task modal
    function closeDeleteModal(taskId) {
        deleteTaskModal<?= $task['task_id'] ?>.style.display = "none";
    }

    </script>
</body>

</html>
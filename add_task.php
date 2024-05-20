<?php
ob_start();
include('sidebar.php');
include('db_conn.php');

// session_start(); // Initialize session management

// Check if user is logged in
if (!isset($_SESSION['emp_id']) || !isset($_SESSION['user_type'])) {
    // Set default values or handle the absence of session variables
    $_SESSION['emp_id'] = null; // or any default value
    $_SESSION['user_type'] = null; // or any default value
    
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if user is director, admin, or manager
$allowedUserTypes = ['director', 'admin', 'manager'];
if (!in_array($_SESSION['user_type'], $allowedUserTypes)) {
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
    // Add Task
    if (isset($_POST['add_task'])) {
        $emp_id = $_POST['emp_id'];
        $task = $_POST['task'];
        $date_assigned = $_POST['date_assigned']; // Date assigned
        $deadline_time = date('h:i:s A', strtotime($_POST['deadline_time'])); // Convert to 24-hour format
        $assigned_by = $_SESSION['emp_id']; // Assigned by the current user

        // Insert task into tasks table
        $sql = "INSERT INTO tasks (employee_id, task_description, status, date_assigned, assigned_by, deadline_time) VALUES (:employee_id, :task_description, :status, :date_assigned, :assigned_by, :deadline_time)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':employee_id', $emp_id);
        $stmt->bindParam(':task_description', $task);
        $stmt->bindValue(':status', 'Pending'); // Default status
        $stmt->bindParam(':date_assigned', $date_assigned);
        $stmt->bindParam(':assigned_by', $assigned_by);
        $stmt->bindParam(':deadline_time', $deadline_time);

        if ($stmt->execute()) {
            // Redirect to this page to avoid form resubmission
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "Error inserting task: " . $stmt->errorInfo()[2];
        }
    } 
    // Edit Task
    elseif (isset($_POST['edit_task'])) {
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
    } 
    // Delete Task
    elseif (isset($_POST['delete_task'])) {
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
    /// Submit Admin Remark
elseif (isset($_POST['admin_remark'])) {
    $taskId = $_POST['task_id'];
    $adminRemark = $_POST['admin_remark'];
    
    // Update admin remark in the tasks table
    $sqlUpdateRemark = "UPDATE tasks SET admin_remark = :admin_remark WHERE task_id = :task_id";
    $stmtUpdateRemark = $conn->prepare($sqlUpdateRemark);
    $stmtUpdateRemark->bindParam(':admin_remark', $adminRemark);
    $stmtUpdateRemark->bindParam(':task_id', $taskId);
    
    if ($stmtUpdateRemark->execute()) {
        // Redirect to this page to avoid form resubmission
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error updating admin remark: " . $stmtUpdateRemark->errorInfo()[2];
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
    /* Styles for the page layout */
    .page-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 50px;
    }

    .left-side,
    .right-side {
        width: 100%;
        max-width: 600px;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    label,
    input,
    select {
        margin-bottom: 10px;
        width: 100%;
        max-width: 400px;
    }

    /* CSS for submit button */
input[type="submit"],
button[type="submit"] {
    font-size: 16px;
    padding: 10px 20px; /* Adjust padding as needed */
    color: white;
    background-color: green; /* Button background color */
    border: none;
    border-radius: 5px; /* Adjust border radius as needed */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

/* Hover effect */
button[type="submit"]:hover {
    background-color: #14a73e; /* Change background color on hover */
}

/* Active effect */
button[type="submit"]:active {
    transform: translateY(2px); /* Push button down slightly when active */
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
        margin: 0 10px 50px 10px;
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
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        transition: opacity 0.3s ease;
    }

    /* Modal content */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        animation-name: animatetop;
        animation-duration: 0.4s;
        transition: opacity 0.3s ease;
    }

    /* Modal animation */
    @keyframes animatetop {
        from {
            top: -300px;
            opacity: 0
        }

        to {
            top: 0;
            opacity: 1
        }
    }
    </style>
    <style>
    /* Delete button style */
    .delete-button {
        background-color: #f44336;
        /* Red background color */
    }
    /* CSS for Admin Remark Dropdown */
select[name="admin_remark"] {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%; /* Ensure dropdown takes full width */
    max-width: 400px; /* Limit maximum width */
    background-color: #14a73e98; /* Set background color */
}

select[name="admin_remark"] option {
    padding: 5px;
    font-size: 14px;
}

/* Style the options when the dropdown is open */
select[name="admin_remark"]:focus option {
    background-color: #f2f2f2; /* Change background color of options when dropdown is open */
}

/* Add scrollbar for Assigned Tasks table on mobile
@media (max-width: 767px) {
    .assign-task table {
        overflow-x: auto;
        display: block;
        max-width: 100%;
    }
} */


.assigned-tasks-container {
    max-width: 100%;
    overflow-x: auto;
    margin-top: 20px;
}

.assigned-tasks table {
    width: 100%;
    border-collapse: collapse;
}

.assigned-tasks th,
.assigned-tasks td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.assigned-tasks th {
    background-color: #f2f2f2;
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
                    <label for="date_assigned">Assign Date:</label>
                    <input type="date" name="date_assigned" id="date_assigned" required>
                    <label for="deadline_time">Deadline Time:</label>
                    <input type="time" name="deadline_time" id="deadline_time" required>
                    <? echo $_POST['deadline_time']; ?>

                    <button type="submit" name="add_task">Add Task</button>
                </form>
            </div>
        </div>
        <!-- <div class="assigned-task"> -->
        <div class="assigned-tasks-container">
            <h1 style="margin-left: 20px;">Assigned Tasks</h1>
            <div class="assigned-tasks">
            <table>
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Task Description</th>
                        <th>Status</th>
                        <th>Date Assigned</th>
                        <th>Deadline Time</th>
                        <th>Submit Date</th>
                        <th>Admin Remark</th>
                        <th>Action</th>
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
                        </td>
                        <td><?= $task['date_assigned'] ?></td>
                        <td><?= $task['deadline_time'] ?></td>
                        <td><?= $task['submit_date_time'] ?></td>
                        <!-- Inside the Assigned Tasks table -->
<!-- Inside the Assigned Tasks table -->
<td>
    <?php if ($task['status'] === 'Completed' || $task['status'] === 'Submitted'): ?>
        <?php if ($task['admin_remark'] === null): ?>
            <!-- Dropdown for admin remarks -->
            <form action="" method="post">
                <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">
                <select name="admin_remark" onchange="this.form.submit()">
                    <option value="" selected disabled>Select Remark</option>
                    <option value="Below expectations">Below expectations</option>
                    <option value="Meeting expectations">Meeting expectations</option>
                    <option value="Exceeding expectations">Exceeding expectations</option>
                    <!-- Add more options as needed -->
                </select>
            </form>
        <?php else: ?>
            <!-- Display admin remark -->
            <?= $task['admin_remark'] ?>
        <?php endif; ?>
    <?php endif; ?>
</td>
        



                        <td>
                            <div class="edit-delete-buttons">
                                <button type="button"
                                    onclick="openEditModal(<?= $task['task_id'] ?>, '<?= $task['task_description'] ?>')">
                                    <img src="assets/img/edit-1.png" alt="Edit" width="15">
                                </button>


                                <button type="button" class="delete-button"
                                    onclick="openDeleteModal(<?= $task['task_id'] ?>)">
                                    <img src="assets/img/delete.png" alt="Delete" width="20">
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div id="editTaskModal" class="modal-container">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">×</span>
            <h2>Edit Task</h2>
            <form action="" method="post">
                <input type="hidden" name="task_id" id="editTaskId">
                <label for="editedTaskDescription">Task Description:</label>
                <input type="text" name="editedTaskDescription" id="editedTaskDescription" required>
                <button type="submit" name="edit_task">Save Changes</button>
            </form>
        </div>
    </div>
    <div id="deleteTaskModal" class="modal-container">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteModal()">×</span>
            <h2>Delete Task</h2>
            <p>Are you sure you want to delete this task?</p>
            <form action="" method="post">
                <input type="hidden" name="task_id" id="deleteTaskId">
                <button type="submit" name="delete_task">Yes, Delete</button>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Select2 JS -->
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        // Initialize select2
        $("#emp_id").select2();
    });

    // Function to open edit task modal
    function openEditModal(taskId, taskDescription) {
        document.getElementById("editTaskId").value = taskId;
        document.getElementById("editedTaskDescription").value = taskDescription;
        document.getElementById("editTaskModal").style.display = "block";
    }

    // Function to close edit task modal
    function closeEditModal() {
        document.getElementById("editTaskModal").style.display = "none";
    }

    // Function to open delete task modal
    function openDeleteModal(taskId) {
        document.getElementById("deleteTaskId").value = taskId;
        document.getElementById("deleteTaskModal").style.display = "block";
    }

    // Function to close delete task modal
    function closeDeleteModal() {
        document.getElementById("deleteTaskModal").style.display = "none";
    }

    </script>
</body>

</html>

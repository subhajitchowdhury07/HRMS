
<?php
include('db_conn.php');
error_reporting(0);
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin' && $_SESSION['user_type'] !== 'director') {
    // Redirect to login page if not logged in or not an admin
    header("Location: login.php");
    exit();
}

// Function to escape HTML for output
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Handle adding a new project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_project'])) {
    $projectName = $_POST['project_name'];
    $department = $_POST['department'];
    $clientName = $_POST['client_name'];
    $addedBy = $_SESSION['id']; // Use the admin's ID

    // Insert new project into database
    $insertSql = "INSERT INTO projects (project_name, department, client_name, added_by) VALUES (:projectName, :department, :clientName, :addedBy)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bindParam(':projectName', $projectName);
    $insertStmt->bindParam(':department', $department);
    $insertStmt->bindParam(':clientName', $clientName);
    $insertStmt->bindParam(':addedBy', $addedBy);

    if ($insertStmt->execute()) {
        // Reload the page to reflect the new project
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error adding project: " . $insertStmt->errorInfo()[2];
    }
}

// Handle editing a project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_project'])) {
    // Fetch project details based on project ID
    $projectId = $_POST['project_id'];
    $selectSql = "SELECT * FROM projects WHERE project_id = :projectId";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bindParam(':projectId', $projectId);
    $selectStmt->execute();
    $project = $selectStmt->fetch(PDO::FETCH_ASSOC);
}

// Handle saving changes to a project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_changes'])) {
    $projectId = $_POST['project_id'];
    $projectName = $_POST['project_name'];
    $department = $_POST['department'];
    $clientName = $_POST['client_name'];

    // Update project in the database
    $updateSql = "UPDATE projects SET project_name = :projectName, department = :department, client_name = :clientName WHERE project_id = :projectId";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bindParam(':projectName', $projectName);
    $updateStmt->bindParam(':department', $department);
    $updateStmt->bindParam(':clientName', $clientName);
    $updateStmt->bindParam(':projectId', $projectId);

    if ($updateStmt->execute()) {
        // Reload the page to reflect the updated project
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error updating project: " . $updateStmt->errorInfo()[2];
    }
}

// Handle deleting a project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_project'])) {
    $projectId = $_POST['project_id'];

    // Delete project from the database
    $deleteSql = "DELETE FROM projects WHERE project_id = :projectId";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bindParam(':projectId', $projectId);

    if ($deleteStmt->execute()) {
        // Reload the page to reflect the deleted project
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error deleting project: " . $deleteStmt->errorInfo()[2];
    }
}

// Fetch all projects added by the admin
$adminId = $_SESSION['id']; // Use the admin's ID
$projectsSql = "SELECT * FROM projects WHERE added_by = :adminId";
$projectsStmt = $conn->prepare($projectsSql);
$projectsStmt->bindParam(':adminId', $adminId);
$projectsStmt->execute();
$projects = $projectsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project - Admin Panel</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <style>
        body{
            margin-top:-30px;
        }   
        .form-group {
            margin-bottom: 20px;
        }

        /* Adjust button styles for better mobile experience */
        button[type="submit"] {
            /* width: 100%; */
            margin-top: 10px;
        }

        /* Responsive table styles */
        .table-responsive {
            overflow-x: auto;
        }

        /* Adjust table styles for smaller screens */
        @media (max-width: 767px) {
    .table {
        width: 100%;
        margin-bottom: 0;
        background-color: transparent;
    }

    .table-bordered {
        border: 0;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border: none;
    }

    .table-responsive > .table {
        margin-bottom: 0;
    }

    /* Adjust button styles for mobile */
    .btn {
        width: 100%;
        margin-bottom: 5px;
    }

    /* Center the buttons */
    .action-buttons {
        text-align: center;
    }

    /* Ensure buttons are displayed inline */
    .action-buttons button {
        display: inline-block;
        margin-right: 5px;
    }
}

    </style>
    <!-- <style>
        /* Page Wrapper */
        .page-wrapper {
            min-height: 100vh;
            background-color: #f8f9fc;
            transition: margin-left 0.5s;
            padding: 20px;
        }
        
        .edit-btn{
        background-color: #4CAF50;
        /* Green */
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin-right: 5px;
        border-radius: 4px;
        cursor: pointer;
    }

    .edit-btn:hover {
        background-color: #45a049;
        /* Darker green */
    }
	.delete-btn {
    background-color: #f44336; /* Red */
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin-right: 5px;
    border-radius: 4px;
    cursor: pointer;
}

.delete-btn:hover {
    background-color: #d32f2f; /* Darker red */
}


        @media (min-width: 768px) {
            .page-wrapper {
                margin-left: 250px;
            }
        }
    </style> -->
</head>

<body>
    <div id="wrapper">
    <?php include('sidebar.php')?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div class="page-wrapper">
                <div class="container">
                    <h2 style="color: #51ad26;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;">Add Project</h2>
                    <?php if (isset($project)) : ?>
                        <form method="post">
                            <input type="hidden" name="project_id" value="<?= escape($project['project_id']) ?>">
                            <div class="form-group">
                                <label for="project_name">Project Name:</label>
                                <input type="text" name="project_name" id="project_name" class="form-control" value="<?= escape($project['project_name']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department:</label>
                                <select name="department" id="department" class="form-control" required>
                                    <?php
                                    // Fetch departments from employees table
                                    $departmentsSql = "SELECT DISTINCT department FROM employees";
                                    $departmentsStmt = $conn->query($departmentsSql);
                                    $departments = $departmentsStmt->fetchAll(PDO::FETCH_COLUMN);
                                    foreach ($departments as $dept) {
                                        $selected = ($dept == $project['department']) ? 'selected' : '';
                                        echo "<option value=\"$dept\" $selected>$dept</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="client_name">Client Name:</label>
                                <input type="text" name="client_name" id="client_name" class="form-control" value="<?= escape($project['client_name']) ?>" required>
                            </div>
                            <button type="submit" name="save_changes" class="btn btn-primary" style="margin-top:25px;
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
  touch-action: manipulation;">Save Changes</button>
                        </form>
                    <?php else : ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="project_name">Project Name:</label>
                                <input type="text" name="project_name" id="project_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department:</label>
                                <select name="department" id="department" class="form-control" required>
                                    <?php
                                    // Fetch departments from employees table
                                    $departmentsSql = "SELECT DISTINCT department FROM employees";
                                    $departmentsStmt = $conn->query($departmentsSql);
                                    $departments = $departmentsStmt->fetchAll(PDO::FETCH_COLUMN);
                                    foreach ($departments as $dept) {
                                        echo "<option value=\"$dept\">$dept</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="client_name">Client Name:</label>
                                <input type="text" name="client_name" id="client_name" class="form-control" required>
                            </div>
                            <button type="submit" name="add_project" style="margin-top:25px;
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
  touch-action: manipulation;">Add Project</button>
                        </form>
                    <?php endif; ?>

                    <hr>

                    <h2 style="color: #51ad26; font-size: 28px; font-weight: bold; margin-bottom: 20px;">My Projects</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Department</th>
                <th>Client Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $project) : ?>
                <tr>
                    <td><?= escape($project['project_name']) ?></td>
                    <td><?= escape($project['department']) ?></td>
                    <td><?= escape($project['client_name']) ?></td>
                    <td class="action-buttons">
                        <form method="post">
                            <input type="hidden" name="project_id" value="<?= escape($project['project_id']) ?>">
                            <button type="submit" name="edit_project" style="padding: 6px 22px;" class="btn btn-success">Edit</button>
                        </form>
                        <form method="post" onsubmit="return confirm('Are you sure you want to delete this project?');">
                            <input type="hidden" name="project_id" value="<?= escape($project['project_id']) ?>">
                            <button type="submit" name="delete_project" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

            </div>
        </div>

</body>

</html>

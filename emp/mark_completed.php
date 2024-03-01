<?php
include('../db_conn.php');
session_start();

// Check if user is logged in
if (!isset($_SESSION['emp_id'])) {
    header("Location: ../login.php");
    exit();
}

// Mark task as completed
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];
    
    // Update task status in the database
    $update_query = "UPDATE tasks SET status = 'Completed' WHERE task_id = :task_id";
    $stmt = $conn->prepare($update_query);
    $stmt->bindParam(':task_id', $task_id);
    $stmt->execute();
    // Redirect back to task view page
    header("Location: view_tasks.php");
    exit();
}
?>

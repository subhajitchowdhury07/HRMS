<?php
// Include database connection and configuration
include('db_conn.php');

// Check if the employee ID is set and not empty
if(isset($_GET['id']) && !empty($_GET['id'])){
    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->execute(array($_GET['id']));

    // Check if row was deleted successfully
    if($stmt->rowCount() > 0){
        // If successful, redirect back to the same page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // If deletion failed, display error message or handle accordingly
        echo "Error deleting employee.";
    }
}
?>

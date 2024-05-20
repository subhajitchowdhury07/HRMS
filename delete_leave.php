<?php
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leave_type'])) {
    $leave_type = $_POST['leave_type'];
    // Perform the delete query based on the leave_type
    try {
        $stmt = $conn->prepare("DELETE FROM setleave WHERE leave_type = :leave_type");
        $stmt->bindParam(':leave_type', $leave_type);
        
        if ($stmt->execute()) {
            echo "Leave type deleted successfully.";
        } else {
            echo "Failed to delete leave type.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>

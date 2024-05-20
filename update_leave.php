<?php
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leave_type'])) {
    $leave_type = $_POST['leave_type'];
    // Perform the update query based on the leave_type
    try {
        $new_leave_type = $_POST['new_leave_type']; // Assuming you want to update the leave_type itself
        $new_allowed_day = $_POST['new_allowed_day'];
        $new_type = $_POST['new_type'];
        $new_leave_description = $_POST['new_leave_description'];

        $stmt = $conn->prepare("UPDATE setleave SET leave_type = :new_leave_type, allowed_day = :new_allowed_day, type = :new_type, leave_description = :new_leave_description WHERE leave_type = :leave_type");
        $stmt->bindParam(':new_leave_type', $new_leave_type);
        $stmt->bindParam(':new_allowed_day', $new_allowed_day);
        $stmt->bindParam(':new_type', $new_type);
        $stmt->bindParam(':new_leave_description'<?php
        include('db_conn.php');
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leave_type'], $_POST['new_leave_type'], $_POST['new_allowed_day'], $_POST['new_type'], $_POST['new_leave_description'])) {
            $leave_type = $_POST['leave_type'];
            $new_leave_type = $_POST['new_leave_type'];
            $new_allowed_day = $_POST['new_allowed_day'];
            $new_type = $_POST['new_type'];
            $new_leave_description = $_POST['new_leave_description'];
        
            try {
                $stmt = $conn->prepare("UPDATE setleave SET leave_type = :new_leave_type, allowed_day = :new_allowed_day, type = :new_type, leave_description = :new_leave_description WHERE leave_type = :leave_type");
                $stmt->bindParam(':new_leave_type', $new_leave_type);
                $stmt->bindParam(':new_allowed_day', $new_allowed_day);
                $stmt->bindParam(':new_type', $new_type);
                $stmt->bindParam(':new_leave_description', $new_leave_description);
                $stmt->bindParam(':leave_type', $leave_type);
                
                if ($stmt->execute()) {
                    echo "Leave type updated successfully.";
                } else {
                    echo "Failed to update leave type.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Invalid request.";
        }
        ?>
        , $new_leave_description);
        $stmt->bindParam(':leave_type', $leave_type);
        
        if ($stmt->execute()) {
            echo "Leave type updated successfully.";
        } else {
            echo "Failed to update leave type.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>

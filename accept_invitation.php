<?php
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'database_connection.php';

// Check if the employee ID is stored in the session
if (isset($_SESSION['id'])) {
    $current_emp_id = $_SESSION['id'];
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error! Employee ID not found in session.'
    );
    echo json_encode($data);
    exit();
}

// Retrieve POST data and validate
$invitation_id = isset($_POST['invitation_id']) ? intval($_POST['invitation_id']) : null;

if ($invitation_id) {
    // Update the invitation status to 'accepted' for the given invitation ID and current employee
    $update_query = "UPDATE `event_invitations` SET `status` = 'accepted' WHERE `invitee_id` = ? AND `event_id` = ?";
    $stmt = mysqli_prepare($con, $update_query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $current_emp_id, $invitation_id);
        if (mysqli_stmt_execute($stmt)) {
            $data = array(
                'status' => true,
                'msg' => 'Invitation accepted successfully!'
            );
        } else {
            $data = array(
                'status' => false,
                'msg' => 'Failed to accept the invitation.',
                'error' => mysqli_stmt_error($stmt)
            );
        }
        mysqli_stmt_close($stmt);
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Failed to prepare the statement.',
            'error' => mysqli_error($con)
        );
    }
} else {
    $data = array(
        'status' => false,
        'msg' => 'Invalid invitation ID.'
    );
}

echo json_encode($data);
?>


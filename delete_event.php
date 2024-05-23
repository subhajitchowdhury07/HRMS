<?php
// Include database connection
require 'database_connection.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    $data = array(
        'status' => false,
        'msg' => 'You are not logged in.'
    );
    echo json_encode($data);
    exit;
}

// Check if event ID is provided via POST
if (isset($_POST['event_id'])) {
    // Sanitize the event ID to prevent SQL injection
    $event_id = mysqli_real_escape_string($con, $_POST['event_id']);

    // Check if the event belongs to the current user
    $check_query = "SELECT user_id FROM `calendar_event_master` WHERE `event_id` = '$event_id'";
    $check_result = mysqli_query($con, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        $event_creator_id = $row['user_id'];

        // Check if the event is created by the current user
        if ($event_creator_id == $_SESSION['id']) {
            // Start a transaction
            mysqli_begin_transaction($con);

            // Delete from `event_invitations` first
            $delete_invitations_query = "DELETE FROM `event_invitations` WHERE `event_id` = '$event_id'";
            $delete_invitations_result = mysqli_query($con, $delete_invitations_query);

            // If deletion from `event_invitations` is successful, proceed to delete from `calendar_event_master`
            if ($delete_invitations_result) {
                $delete_event_query = "DELETE FROM `calendar_event_master` WHERE `event_id` = '$event_id'";
                $delete_event_result = mysqli_query($con, $delete_event_query);

                if ($delete_event_result) {
                    // Commit the transaction
                    mysqli_commit($con);
                    $data = array(
                        'status' => true,
                        'msg' => 'Event deleted successfully!'
                    );
                } else {
                    // Rollback the transaction
                    mysqli_rollback($con);
                    $data = array(
                        'status' => false,
                        'msg' => 'Sorry, unable to delete event from calendar_event_master.',
                        'error' => mysqli_error($con) // Add error information
                    );
                }
            } else {
                // Rollback the transaction
                mysqli_rollback($con);
                $data = array(
                    'status' => false,
                    'msg' => 'Sorry, unable to delete event from event_invitations.',
                    'error' => mysqli_error($con) // Add error information
                );
            }
        } else {
            $data = array(
                'status' => false,
                'msg' => 'You do not have permission to delete this event.'
            );
        }
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Event not found or you do not have permission to delete this event.'
        );
    }
} else {
    $data = array(
        'status' => false,
        'msg' => 'Event ID not provided.'
    );
}

// Return JSON response
echo json_encode($data);
?>

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

// Check if all required fields are provided via POST
if (isset($_POST['event_name'], $_POST['event_start_date'], $_POST['event_end_date'], $_POST['event_time'], $_POST['event_color'], $_POST['event_description'])) {
    // Sanitize input fields
    $event_name = mysqli_real_escape_string($con, $_POST['event_name']);
    $event_start_date = mysqli_real_escape_string($con, $_POST['event_start_date']);
    $event_end_date = mysqli_real_escape_string($con, $_POST['event_end_date']);
    $event_time = mysqli_real_escape_string($con, $_POST['event_time']);
    $event_color = mysqli_real_escape_string($con, $_POST['event_color']);
    $event_description = mysqli_real_escape_string($con, $_POST['event_description']);
    $event_invitees = isset($_POST['event_invitees']) ? $_POST['event_invitees'] : []; // Array of invitee IDs

    // Insert event into the calendar_event_master table
    $insert_event_query = "INSERT INTO `calendar_event_master` (`event_name`, `event_start_date`, `event_end_date`, `event_time`, `event_color`, `event_description`, `user_id`) 
                           VALUES ('$event_name', '$event_start_date', '$event_end_date', '$event_time', '$event_color', '$event_description', '{$_SESSION['id']}')";
    $insert_event_result = mysqli_query($con, $insert_event_query);

    if ($insert_event_result) {
        $event_id = mysqli_insert_id($con); // Get the auto-generated event ID

        if (!empty($event_invitees)) {
            // Start a transaction for inserting invitations
            mysqli_begin_transaction($con);

            // Insert invitations into event_invitations table for all selected invitees
            $all_inserts_successful = true;
            foreach ($event_invitees as $invitee_id) {
                $invitee_id = mysqli_real_escape_string($con, $invitee_id); // Sanitize invitee ID
                $insert_invitation_query = "INSERT INTO `event_invitations` (`event_id`, `invitee_id`) 
                                            VALUES ('$event_id', '$invitee_id')";
                $insert_invitation_result = mysqli_query($con, $insert_invitation_query);

                if (!$insert_invitation_result) {
                    $all_inserts_successful = false;
                    break;
                }
            }

            if ($all_inserts_successful) {
                // Commit the transaction
                mysqli_commit($con);
                $data = array(
                    'status' => true,
                    'msg' => 'Event saved successfully!'
                );
            } else {
                // Rollback the transaction
                mysqli_rollback($con);
                $data = array(
                    'status' => false,
                    'msg' => 'Sorry, unable to save event and invitees.',
                    'error' => mysqli_error($con) // Add error information
                );
            }
        } else {
            // No invitees to insert, event saved successfully
            $data = array(
                'status' => true,
                'msg' => 'Event saved successfully !'
            );
        }
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Sorry, unable to save event.',
            'error' => mysqli_error($con) // Add error information
        );
    }
} else {
    $data = array(
        'status' => false,
        'msg' => 'Required fields not provided.'
    );
}

// Return JSON response
echo json_encode($data);
?>

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
$event_name = isset($_POST['event_name']) ? mysqli_real_escape_string($con, $_POST['event_name']) : null;
$event_start_date = isset($_POST['event_start_date']) ? date("Y-m-d", strtotime($_POST['event_start_date'])) : null;
$event_end_date = isset($_POST['event_end_date']) ? date("Y-m-d", strtotime($_POST['event_end_date'])) : null;
$event_time = isset($_POST['event_time']) ? mysqli_real_escape_string($con, $_POST['event_time']) : null;
$event_description = isset($_POST['event_description']) ? mysqli_real_escape_string($con, $_POST['event_description']) : '';
$event_color = isset($_POST['event_color']) ? mysqli_real_escape_string($con, $_POST['event_color']) : '';
$event_invitees = isset($_POST['event_invitees']) ? $_POST['event_invitees'] : array();

if ($event_name && $event_start_date && $event_end_date && $event_time) {
    $insert_query = "INSERT INTO `calendar_event_master` (`user_id`, `event_name`, `event_start_date`, `event_end_date`, `event_time`, `event_description`, `event_color`) 
                     VALUES ('$current_emp_id', '$event_name', '$event_start_date', '$event_end_date', '$event_time', '$event_description', '$event_color')";

    if (mysqli_query($con, $insert_query)) {
        $event_id = mysqli_insert_id($con);

        if (!empty($event_invitees)) {
            foreach ($event_invitees as $invitee_id) {
                $invite_query = "INSERT INTO `event_invitations` (`event_id`, `invitee_id`, `status`) 
                                 VALUES ('$event_id', '$invitee_id', 'pending')";
                mysqli_query($con, $invite_query);
            }
        }

        $data = array(
            'status' => true,
            'msg' => 'Event added successfully!'
        );
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Sorry, event not added.',
            'error' => mysqli_error($con)
        );
    }
} else {
    $data = array(
        'status' => false,
        'msg' => 'Invalid input data.'
    );
}

echo json_encode($data);
?>

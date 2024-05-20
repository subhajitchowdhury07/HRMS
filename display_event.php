<?php
// Start the session
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure this file sets up the $con variable correctly
require 'database_connection.php';

// Check if the employee ID is stored in the session
if (isset($_SESSION['id'])) {
    $current_emp_id = $_SESSION['id']; // Get the current employee ID from the session
} else {
    // If the employee ID is not set in the session, handle the error or redirect the user
    $data = array(
        'status' => false,
        'msg' => 'Error! Employee ID not found in session.'
    );
    echo json_encode($data);
    exit(); // Terminate the script
}

// Function to fetch events from the database for the current user
function get_user_events($con, $current_emp_id)
{
    $events = array();

    $display_query = "SELECT cem.event_id, cem.event_name, cem.event_description, 
                             cem.event_start_date, cem.event_end_date, cem.event_time, cem.event_color
                      FROM calendar_event_master cem
                      LEFT JOIN event_invitations ei ON cem.event_id = ei.event_id
                      WHERE cem.user_id = ?
                      OR (ei.invitee_id = ? AND ei.status = 'accepted')
                      OR (ei.invitee_id = ? AND ei.event_id = cem.event_id)";

    $stmt = mysqli_prepare($con, $display_query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iii", $current_emp_id, $current_emp_id, $current_emp_id);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);

        while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $event = array(
                'event_id' => $data_row['event_id'],
                'title' => $data_row['event_name'],
                'description' => $data_row['event_description'],
                'start' => date("Y-m-d", strtotime($data_row['event_start_date'])) . 'T' . date("H:i:s", strtotime($data_row['event_time'])),
                'end' => date("Y-m-d", strtotime($data_row['event_end_date'])) . 'T' . date("H:i:s", strtotime($data_row['event_time'])),
                'color' => $data_row['event_color']
            );
            $events[] = $event;
        }
        return $events;
    } else {
        // Handle the error if the statement couldn't be prepared
        return null;
    }
}


// Retrieve events for the current user
$events = get_user_events($con, $current_emp_id);

if ($events !== null) {
    if (!empty($events)) {
        $data = array(
            'status' => true,
            'msg' => 'Successfully retrieved user events!',
            'data' => $events
        );
    } else {
        $data = array(
            'status' => false,
            'msg' => 'Error! No events found for the current user.'
        );
    }
} else {
    $data = array(
        'status' => false,
        'msg' => 'Error retrieving events from the database.'
    );
}

echo json_encode($data);
?>

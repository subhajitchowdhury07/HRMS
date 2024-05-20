<?php
// Assuming you have a database connection established
// Include your database connection code here if not already included

// Fetch employee names from the database
$employees_query = "SELECT id, first_name FROM employees";
$employees_result = mysqli_query($con, $employees_query);

// Check if there are any results
if ($employees_result && mysqli_num_rows($employees_result) > 0) {
    $employees = array();

    // Fetch each employee and add to the array
    while ($employee = mysqli_fetch_assoc($employees_result)) {
        $employees[] = array(
            'id' => $employee['id'],
            'first_name' => $employee['first_name']
        );
    }

    // Return the employees as JSON data
    echo json_encode(array('status' => true, 'data' => $employees));
} else {
    // No employees found
    echo json_encode(array('status' => false, 'msg' => 'No employees found.'));
}

// Close the database connection if needed
mysqli_close($con);
?>

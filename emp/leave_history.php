<?php
// Include necessary files (e.g., database connection)
include("sidebar.php");
include("../db_conn.php");

// Start or resume session
// session_start();

// Check if the user is logged in
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user-specific leave records from the database
$employee_id = $_SESSION['emp_id'];
$query = "SELECT * FROM leaves WHERE emp_id = :employee_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':employee_id', $employee_id);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check for errors in the query result
if ($result === false) {
    die("Query failed: " . $stmt->errorInfo()[2]); // Print error message if query fails
}

// Display leave history
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave History</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Add other necessary stylesheets -->
</head>

<body>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2>Leave History</h2>
                    <?php
                    if ($result) {
                        echo '<table class="table">
                                <thead>
                                    <tr>
                                        <th>Leave Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['leave_type'] . "</td>";
                            echo "<td>" . $row['from_date'] . "</td>";
                            echo "<td>" . $row['to_date'] . "</td>";
                            echo "<td>" . $row['allowed_day'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                        }

                        echo '</tbody>
                            </table>';
                    } else {
                        echo '<p>No leave history available.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Add other necessary scripts -->

</body>

</html>

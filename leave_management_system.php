<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hrms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<?php

// Fetch leave requests from the leaves table
$sql = "SELECT * FROM leaves";
$result = $conn->query($sql);

// Handle admin actions on leave requests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && isset($_POST['id'])) {
    $action = $_POST['action'];
    $leaveId = $_POST['id'];

    // Check if the leave request is not already locked
    $checkStatusSql = "SELECT status FROM leaves WHERE id=$leaveId";
    $statusResult = $conn->query($checkStatusSql);

    if ($statusResult->num_rows > 0) {
        $row = $statusResult->fetch_assoc();
        $currentStatus = $row["status"];

        // If the status is not 'Approved' or 'Rejected', update the status and admin_remark
        if ($currentStatus != 'Approved' && $currentStatus != 'Rejected') {
            $status = ($action == 'approve') ? 'Approved' : 'Rejected';

            // Get admin_remark from the form
            $adminRemark = isset($_POST['admin_remark']) ? $_POST['admin_remark'] : '';

            // Update the leave request with status and admin_remark
            $updateSql = "UPDATE leaves SET status='$status', admin_remark='$adminRemark' WHERE id=$leaveId";

            if ($conn->query($updateSql) === TRUE) {
                // Reload the page to reflect the updated status
                echo "<script>window.location.reload();</script>";
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } 
    }
}

?>
<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management System</title>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Include your custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 20px;
        }

        .status-approved {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        .status-rejected {
            background-color: #f44336; /* Red */
            color: white;
        }

        /* Add responsiveness */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>

    <!-- Include jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Your custom scripts or additional scripts can be added here -->
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Leave Management System</a>
</nav>
        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Leave Requests</h2>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Admin Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["emp_id"] . "</td>";
                                echo "<td>" . $row["leave_type"] . "</td>";
                                echo "<td>" . $row["from_date"] . "</td>";
                                echo "<td>" . $row["to_date"] . "</td>";
                                echo "<td>" . $row["description"] . "</td>";

                                $statusClass = '';
                                if ($row["status"] == 'Approved') {
                                    $statusClass = 'status-approved';
                                } elseif ($row["status"] == 'Rejected') {
                                    $statusClass = 'status-rejected';
                                }

                                echo "<td class='$statusClass'>" . $row["status"] . "</td>";
                                echo "<td>" . $row["admin_remark"] . "</td>";
                                echo "<td>";

                                // Check if the leave request is not already locked
                                if ($row["status"] != 'Approved' && $row["status"] != 'Rejected') {
                                    echo "<form method='post'>";
                                    echo "<input type='hidden' name='id' value='{$row["id"]}'>";
                                    echo "<input type='hidden' name='action' value='approve'>";
                                    echo "<div class='form-group'>";
                                    echo "<label for='admin_remark'>Admin Remark:</label>";
                                    echo "<input type='text' name='admin_remark' id='admin_remark' class='form-control'>";
                                    echo "</div>";
                                    echo "<button type='submit' class='btn btn-success'>Approve</button>";
                                    echo "</form>";

                                    echo "<form method='post'>";
                                    echo "<input type='hidden' name='id' value='{$row["id"]}'>";
                                    echo "<input type='hidden' name='action' value='reject'>";
                                    echo "<div class='form-group'>";
                                    echo "<label for='admin_remark'>Admin Remark:</label>";
                                    echo "<input type='text' name='admin_remark' id='admin_remark' class='form-control'>";
                                    echo "</div>";
                                    echo "<button type='submit' class='btn btn-danger'>Reject</button>";
                                    echo "</form>";
                                } else {
                                    echo "Leave request is already locked.";
                                }

                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No leave requests</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

</body>
</html>

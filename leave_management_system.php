<?php
include('db_conn.php');

session_start();

// Check if user is logged in
if (!isset($_SESSION['emp_id']) || !isset($_SESSION['user_type'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Fetch the manager ID from the session
$manager_id = $_SESSION['manager_id'];

// Fetch leave requests where manager_id matches the specific value (e.g., 20)
$sql = "SELECT * FROM leaves WHERE manager_id = :manager_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':manager_id', $manager_id);
$stmt->execute();
$leaveRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Handle admin actions on leave requests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && isset($_POST['id'])) {
    $action = $_POST['action'];
    $leaveId = $_POST['id'];

    // Check if the leave request is not already locked
    $checkStatusSql = "SELECT status FROM leaves WHERE id=:leaveId";
    $checkStatusStmt = $conn->prepare($checkStatusSql);
    $checkStatusStmt->bindParam(':leaveId', $leaveId);
    $checkStatusStmt->execute();
    $row = $checkStatusStmt->fetch(PDO::FETCH_ASSOC);
    $currentStatus = $row["status"];

    if ($currentStatus != 'Approved' && $currentStatus != 'Rejected') {
        $status = ($action == 'approve') ? 'Approved' : 'Rejected';

        // Get admin_remark from the form
        $adminRemark = isset($_POST['admin_remark']) ? $_POST['admin_remark'] : '';

        // Begin transaction
        $conn->beginTransaction();

        // Update the leave request with status and admin_remark
        $updateSql = "UPDATE leaves SET status=:status, admin_remark=:adminRemark WHERE id=:leaveId";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':status', $status);
        $updateStmt->bindParam(':adminRemark', $adminRemark);
        $updateStmt->bindParam(':leaveId', $leaveId);

        if ($updateStmt->execute()) {
            // If the leave is approved, deduct the appropriate amount from available_balance in leaves
            if ($status === 'Approved') {
                // Fetch leave information
                $leaveInfoSql = "SELECT leave_type, from_date, to_date, allowed_day FROM leaves WHERE id=:leaveId";
                $leaveInfoStmt = $conn->prepare($leaveInfoSql);
                $leaveInfoStmt->bindParam(':leaveId', $leaveId);
                $leaveInfoStmt->execute();
                $leaveInfo = $leaveInfoStmt->fetch(PDO::FETCH_ASSOC);

                $leave_type = $leaveInfo['leave_type'];
                $from_date = $leaveInfo['from_date'];
                $to_date = $leaveInfo['to_date'];
                $allowed_day = $leaveInfo['allowed_day'];

                // Calculate leave duration
                $start = new DateTime($from_date);
                $end = new DateTime($to_date);
                $days = $end->diff($start)->days + 1;
                if ($allowed_day === 'half') {
                    $days *= 0.5;
                }

                // Deduct leave duration from available_balance
                $deductBalanceSql = "UPDATE leaves SET available_balance = available_balance - :days WHERE id = :leaveId";
                $deductBalanceStmt = $conn->prepare($deductBalanceSql);
                $deductBalanceStmt->bindParam(':days', $days);
                $deductBalanceStmt->bindParam(':leaveId', $leaveId);
                $deductBalanceStmt->execute();

                // Update starting_balance in allotted_leave table
                $updateStartingBalanceSql = "UPDATE allotted_leave 
                                            SET starting_balance = starting_balance - :days 
                                            WHERE leave_type_id = (SELECT leave_id FROM leaves WHERE id = :leaveId)
                                            AND employeeID = (SELECT emp_id FROM leaves WHERE id = :leaveId)";
                $updateStartingBalanceStmt = $conn->prepare($updateStartingBalanceSql);
                $updateStartingBalanceStmt->bindParam(':days', $days);
                $updateStartingBalanceStmt->bindParam(':leaveId', $leaveId);
                $updateStartingBalanceStmt->execute();
            }

            // Commit transaction
            $conn->commit();

            // Reload the page to reflect the updated status
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            // Rollback transaction on failure
            $conn->rollBack();
            echo "Error updating record: " . $updateStmt->errorInfo()[2];
        }
    } else {
        echo "Leave request is already locked.";
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
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
            background-color: #4CAF50;
            color: white;
        }

        .status-rejected {
            background-color: #f44336;
            color: white;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#allowed_day').change(function () {
                var allowedDay = $(this).val();
                if (allowedDay === 'half') {
                    $('.date-fields').hide();
                    $('.single-date-field').show();
                } else {
                    $('.date-fields').show();
                    $('.single-date-field').hide();
                }
            });
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Leave Management System</a> -->
    </nav>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2>Leave Requests</h2>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Employee ID</th>
                        <th>Leave Type</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Description</th>
                        <th>Allowed Day</th>
                        <th>Status</th>
                        <th>Admin Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leaveRequests as $request): ?>
                    <tr>
                        <!-- <td><?= $request['id'] ?></td> -->
                        <td><?= $request['emp_id'] ?></td>
                        <td><?= $request['leave_type'] ?></td>
                        <td><?= $request['from_date'] ?></td>
                        <td><?= $request['to_date'] ?></td>
                        <td><?= $request['description'] ?></td>
                        <td><?= $request['allowed_day'] ?></td>
                        <?php
                            $statusClass = '';
                            if ($request['status'] == 'Approved') {
                                $statusClass = 'status-approved';
                            } elseif ($request['status'] == 'Rejected') {
                                $statusClass = 'status-rejected';
                            }
                            ?>
                        <td class="<?= $statusClass ?>"><?= $request['status'] ?></td>
                        <td><?= $request['admin_remark'] ?></td>
                        <td>
                            <?php if ($request['status'] != 'Approved' && $request['status'] != 'Rejected'): ?>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $request['id'] ?>">
                                <input type="hidden" name="action" value="approve">
                                <div class="form-group">
                                    <label for="admin_remark">Admin Remark:</label>
                                    <input type="text" name="admin_remark" id="admin_remark" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form method="post">
                                <input type="hidden" name="id" value="<?= $request['id'] ?>">
                                <input type="hidden" name="action" value="reject">
                                <div class="form-group">
                                    <label for="admin_remark">Admin Remark:</label>
                                    <input type="text" name="admin_remark" id="admin_remark" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                            <?php else: ?>
                            Leave request is already locked.
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($leaveRequests)): ?>
                    <tr>
                        <td colspan="10">No leave requests</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>

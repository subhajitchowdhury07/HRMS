<?php
include('sidebar.php');
include('db_conn.php');

$message = '';

if (!isset($_SESSION['emp_id']) || !isset($_SESSION['user_type'])) {
    header("Location: login.php");
    exit();
}

// Check if the form is submitted for updating a leave type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_leave'])) {
    $leave_id = $_POST["leave_id"];
    // Redirect to update_leave.php with the leave_id as a parameter
    header("Location: update_leave.php?leave_id=$leave_id");
    exit();
}

// Check if the form is submitted for deleting a leave type
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_leave'])) {
    $leave_id = $_POST["leave_id"];
    try {
        // Prepare and execute the SQL query to delete the leave type
        $stmt = $conn->prepare("DELETE FROM setleave WHERE id = :leave_id");
        $stmt->bindParam(':leave_id', $leave_id);
        if ($stmt->execute()) {
            $message = "Leave type deleted successfully.";
        } else {
            $message = "Failed to delete leave type.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leave_type'])) {
    $leave_type = $_POST["leave_type"];
    $allowed_day = $_POST["allowed_day"];
    $type = $_POST["type"];
    $leave_description = $_POST["leave_description"];

    if (!empty($leave_type)) { // Check if leave_type is not empty
        try {
            $stmt = $conn->prepare("INSERT INTO setleave (leave_type, allowed_day, type, leave_description) VALUES (:leave_type, :allowed_day, :type, :leave_description)");
            $stmt->bindParam(':leave_type', $leave_type);
            $stmt->bindParam(':allowed_day', $allowed_day);
            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':leave_description', $leave_description);

            if ($stmt->execute()) {
                $message = "Leave type set successfully.";
            } else {
                $message = "Oops! Something went wrong. Please try again later.";
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    } else {
        $message = "Leave type cannot be empty.";
    }
}

// Fetch all leave types from the database
$sql = "SELECT id, leave_type, type, leave_description FROM setleave";
$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Leave</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <style>body {
    font-family: Arial, sans-serif;
    background-image: url('assets/img/back.png'); /* Add your background image path here */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    margin: 0;
    padding: 0;
}

.page-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    /* max-width: 1000px;
    margin: 50px auto;
    padding: 20px; */
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-wrapper,
.list-wrapper {
    width: calc(50% - 20px);
    padding: 20px;
    box-sizing: border-box;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

form div {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input[type="text"],
select,
textarea {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: none;
}

input[type="submit"] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.message {
    text-align: center;
    margin-bottom: 20px;
}

.list-wrapper ul {
    list-style-type: none;
    padding: 0;
}

.list-wrapper ul li {
    margin-bottom: 10px;
    padding: 10px;
    background-color: #fff;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Media query for smaller screens */
@media screen and (max-width: 768px) {
    .form-wrapper,
    .list-wrapper {
        width: 100%;
    }
}
</style>
</head>

<body>
    <div class="page-wrapper">
        <div class="form-wrapper">
            <h2>Set Leave</h2>
            <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label for="leave_type">Leave Type:</label>
                    <input type="text" name="leave_type" id="leave_type" required>
                </div>
                <div>
                    <label for="allowed_day">Allowed Day:</label>
                    <select name="allowed_day" id="allowed_day">
                        <option value="full">Full Day</option>
                        <option value="half">Half Day</option>
                    </select>
                </div>
                <div>
                    <label for="type">Type:</label>
                    <select name="type" id="type">
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                </div>
                <div>
                    <label for="leave_description">Leave Description:</label>
                    <textarea name="leave_description" id="leave_description" rows="4" cols="50"></textarea>
                </div>
                <div>
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
        <!-- List of Leave Types -->
        <div class="list-wrapper">
            <h2>List of Leave Types</h2>
            <ul>
                <?php if ($stmt->rowCount() > 0): ?>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <li>
                    <b><?php echo $row['leave_type']; ?></b> - <?php echo $row['type']; ?> - <?php echo $row['leave_description']; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" style="display: inline;">
                        <input type="hidden" name="leave_id" value="<?php echo $row['id']; ?>">
                        <!-- <button type="submit" name="update_leave" class="btn btn-primary btn-sm">Update</button> -->
                    </form>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: inline;">
                        <input type="hidden" name="leave_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_leave" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
                <?php endwhile; ?>
                <?php else: ?>
                <li>No leave types found</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>

</html>

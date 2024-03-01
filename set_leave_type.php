<?php
include('sidebar.php');
// session_start();

$message = '';

if (!isset($_SESSION['emp_id']) || !isset($_SESSION['user_type'])) {
    header("Location: login.php");
    exit();
}

// Check if user is admin or director
// if ($_SESSION['user_type'] !== 'admin') {
//     header("Location: unauthorized.php");
//     exit();
// }

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "db_conn.php";

    // Validate and sanitize input
    $leave_type = $_POST["leave_type"];
    $allowed_day = $_POST["allowed_day"];
    $type = $_POST["type"];
    $leave_description = $_POST["leave_description"];

    try {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO setleave (leave_type, allowed_day, type, leave_description) VALUES (:leave_type, :allowed_day, :type, :leave_description)");

        // Bind parameters
        $stmt->bindParam(':leave_type', $leave_type);
        $stmt->bindParam(':allowed_day', $allowed_day);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':leave_description', $leave_description);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            $message = "Leave type set successfully.";
        } else {
            $message = "Oops! Something went wrong. Please try again later.";
        }
    } catch (PDOException $e) {
        // Handle database error
        $message = "Error: " . $e->getMessage();
    }
}

// Fetch leave types
$sql = "SELECT leave_type, type, leave_description FROM setleave";
$stmt = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Leave</title>
    <style>
        /* Add your styles here */
        body {
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
            justify-content: space-between;
            max-width: 1000px;
            /* margin: 20px auto; */
            margin-top:50px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.5); /* Add opacity to the background color */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-wrapper,
        .list-wrapper {
            width: 45%;
            padding: 20px;
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
            padding: 12px 20px;
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
            padding: 14px 20px;
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

        /* Media queries for responsiveness */
        @media screen and (max-width: 768px) {
            .page-wrapper {
                flex-direction: column;
                align-items: center;
            }

            .form-wrapper,
            .list-wrapper {
                width: 100%;
                margin-bottom: 20px;
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
        <div class="list-wrapper">
            <h2>List of Leave Types</h2>
            <ul>
                <?php if ($stmt->rowCount() > 0): ?>
                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <li><?php echo '<b>' . $row['leave_type'] . '</b>' . ' - ' . $row['type'] . ' - ' . $row['leave_description']; ?></li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li>No leave types found</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>

</html>
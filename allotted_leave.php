<?php
include('sidebar.php');

// session_start();

if (!isset($_SESSION['emp_id']) || !isset($_SESSION['user_type'])) {
    header("Location: login.php");
    exit();
}

$id=$_SESSION['emp_id'];
require_once "db_conn.php";

$message = '';

$stmt = $conn->prepare("SELECT id, First_name FROM employees WHERE employment_type = 'permanent'");
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["employee_id"];
    $allowed_day = $_POST["allowed_day"];
    
    $selected_leave_types = $_POST["leave_type_id"];
    $starting_balances = $_POST["starting_balance"];

    try {
        foreach ($selected_leave_types as $index => $leave_type_id) {
            // Fetch the emp_id for the selected employee
            $emp_id_stmt = $conn->prepare("SELECT emp_id FROM employees WHERE id = ?");
            $emp_id_stmt->execute([$employee_id]);
            $emp_id_row = $emp_id_stmt->fetch(PDO::FETCH_ASSOC);
            $emp_id = $emp_id_row['emp_id'];

            // Insert into allotted_leave table with emp_id
            $stmt = $conn->prepare("INSERT INTO allotted_leave (employee_id, First_name, starting_balance, allowed_day, leave_type_id, employeeID) VALUES (?, (SELECT First_name FROM employees WHERE id = ?), ?, ?, ?, ?)");
            $stmt->execute([$employee_id, $employee_id, $starting_balances[$index], $allowed_day, $leave_type_id, $emp_id]);
        }

        $message = "Leave allotted successfully.";
    } catch (PDOException $e) {
        $message = "Oops! Something went wrong. Please try again later. Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allot Leave</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('assets/img/back.png');
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .page-wrapper {
            max-width: 500px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select,
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <h2>Allot Leave</h2>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label for="employee_id">Select Employee:</label>
                <select name="employee_id" id="employee_id" required>
                    <option value="">Select Employee</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?php echo $employee['id']; ?>"><?php echo $employee['First_name']; ?> (<?php echo $employee['id']; ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="leave_type_id">Select Leave Types:</label><br>
                <?php
                    $stmt = $conn->query("SELECT id, leave_type FROM setleave");
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<input type='checkbox' name='leave_type_id[]' value='{$row['id']}'> {$row['leave_type']}<br>";
                        echo "<label for='starting_balance_{$row['id']}'>Starting Balance:</label>";
                        echo "<input type='number' name='starting_balance[]' id='starting_balance_{$row['id']}' step='0.01'><br>";
                    }
                ?>
            </div>
            <div>
                <label for="allowed_day">Allowed Day:</label>
                <select name="allowed_day" id="allowed_day" required>
                    <option value="full">Full Day</option>
                    <option value="half">Half Day</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>

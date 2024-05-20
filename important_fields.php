<?php include('sidebar.php'); ?>
<?php
// Include database connection and configuration
include('db_conn.php');

// Verify user type and redirect if not a director
// Sample logic to check user type
$user_type = "director"; // Assuming user type is stored in a variable
if ($user_type !== "director") {
    // Redirect to another page or show an error message
    header("Location: error.php");
    exit;
}

// Fetch manager information
$sql = "SELECT id, first_name, last_name FROM employees WHERE user_type = 'manager'";
$stmt = $conn->query($sql);
$managers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all employees except director
$sql = "SELECT id, first_name, last_name, user_type FROM employees WHERE user_type != 'director'";
$stmt = $conn->query($sql);
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch employee information for editing
$employee_id = isset($_GET['employee_id']) ? $_GET['employee_id'] : null;
if ($employee_id) {
    $sql = "SELECT * FROM employees WHERE id = :employee_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->execute();
    $employeeData = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Update employee data if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $password = $_POST['password'];
    $manager_id = $_POST['manager_id'];
    $user_type = $_POST['user_type'];

    // Update employee record in the database
    $sql = "UPDATE employees SET password = :password, manager_id = :manager_id, user_type = :user_type WHERE id = :employee_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':manager_id', $manager_id);
    $stmt->bindParam(':user_type', $user_type);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->execute();

    // Redirect to the same page after update
    header("Location: important_fields.php?employee_id=$employee_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Important Fields</title>
    <style>
        /* Add your custom CSS styles here */
        /* Ensure to include necessary CSS and JS files */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }
        

        hr {
            border: none;
            border-top: 2px solid #ddd;
            margin: 20px 0;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        select, input[type="password"], button {
            width: calc(100% - 13px);
            padding: 12px;
            border: 2px solid #4CAF50;
            /* Green border */
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 5px;
            margin-bottom: 10px;
            background-color: #fff;
            /* Set your desired background color */
            color: #333;
            /* Set your desired text color */
        }

        select:focus, input[type="password"]:focus {
            outline: none;
            /* Remove focus outline */
            border-color: #51ad26;
            /* Change border color on focus */
            box-shadow: 0 0 5px #51ad26;
            /* Add shadow on focus */
        }

        button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        button:hover {
            background-color: #45a049;
            /* Darker green */
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        ul li a {
            text-decoration: none;
            color: #333;
        }

        ul li a:hover {
            color: #4CAF50;
        }

        .select-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .select-wrapper select {
            width: 100%;
            padding: 10px;
            border: 2px solid #4CAF50;
            border-radius: 4px;
            background-color: #fff;
            color: #333;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            box-sizing: border-box;
        }

        .select-wrapper select:focus {
            outline: none;
            border-color: #51ad26;
            box-shadow: 0 0 5px #51ad26;
        }

        .select-wrapper::after {
            content: '\25BC';
            font-size: 14px;
            position: absolute;
            top: calc(50% - 7px);
            right: 10px;
            pointer-events: none;
            color: #333;
        }
    </style>
</head>
<body>
    
    <h1 style="color: #51ad26;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;">Important Fields</h1>
    <form method="POST">
        <div class="select-wrapper">
            <label for="employee_select">Select Employee:</label>
            <select id="employee_select" name="employee_id" onchange="location = 'important_fields.php?employee_id=' + this.value;">
                <option value="">Select Employee</option>
                <?php foreach ($employees as $employee): ?>
                    <option value="<?php echo $employee['id']; ?>" <?php echo ($employee_id == $employee['id']) ? 'selected' : ''; ?>>
                        <?php echo $employee['first_name'] . ' ' . $employee['last_name'] . ' (' . $employee['user_type'] . ')'; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <hr>
        <div class="form-group">
        <label class="form-control-label">Password</label>
        <div clas="pass-group ">
        <!-- <label for="password">Password:</label> -->
        <input type="password" id="password" name="password" value="<?php echo isset($employeeData['password']) ? $employeeData['password'] : ''; ?>"><br><br>
        <span class="fas fa-eye toggle-password ml-3" onclick="togglePasswordVisibility(this)"></span>
                </div>
        </div>
        <label for="manager_id">Manager:</label>
        <select id="manager_id" name="manager_id">
            <option value="">Select Manager</option>
            <?php foreach ($managers as $manager): ?>
                <option value="<?php echo $manager['id']; ?>" <?php echo (isset($employeeData['manager_id']) && $employeeData['manager_id'] == $manager['id']) ? 'selected' : ''; ?>>
                    <?php echo $manager['first_name'] . ' ' . $manager['last_name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type">
            <option value="admin" <?php echo (isset($employeeData['user_type']) && $employeeData['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            <option value="manager" <?php echo (isset($employeeData['user_type']) && $employeeData['user_type'] == 'manager') ? 'selected' : ''; ?>>Manager</option>
            <option value="user" <?php echo (isset($employeeData['user_type']) && $employeeData['user_type'] == 'user') ? 'selected' : ''; ?>>User</option>
        </select><br><br>

        <button type="submit">Save Changes</button>
    </form>
</body>
<script>
    function togglePasswordVisibility(icon) {
        const passwordInput = icon.previousElementSibling; // Get the password input element
        var passwordField = document.getElementById('password');
            if (passwordField.type === "password") {
                passwordField.type = "text"; // Change input type to 'text' to show the password
            icon.classList.remove('fa-eye'); // Remove the 'fa-eye' class
            icon.classList.add('fa-eye-slash'); // Add the 'fa-eye-slash' class
        } else {
            passwordField.type = "password"; // Change input type to 'password' to hide the password
            icon.classList.remove('fa-eye-slash'); // Remove the 'fa-eye-slash' class
            icon.classList.add('fa-eye'); // Add the 'fa-eye' class
        }
    }
    
</script>

</html>

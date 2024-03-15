<?php
// Include database connection
include('db_conn.php');

// Check if employee ID is provided in the URL
if(isset($_GET['id'])) {
    $employeeId = $_GET['id'];

    // Fetch employee details based on the provided ID
    $query = "SELECT * FROM employees WHERE id = :employee_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':employee_id', $employeeId);
    $stmt->execute();

    // Check if employee exists
    if($stmt->rowCount() > 0) {
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        // Handle form submission for updating employee details
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $updateFields = array();
            if (isset($_POST['first_name'])) {
                $updateFields[] = "first_name = :first_name";
                $firstName = $_POST['first_name'];
            }
            if (isset($_POST['last_name'])) {
                $updateFields[] = "last_name = :last_name";
                $lastName = $_POST['last_name'];
            }
            if (isset($_POST['email'])) {
                $updateFields[] = "email = :email";
                $email = $_POST['email'];
            }
            if (isset($_POST['department'])) {
                $updateFields[] = "department = :department";
                $department = $_POST['department'];
            }
            if (isset($_POST['country_of_employment'])) {
                $updateFields[] = "country_of_employment = :country_of_employment";
                $countryOfEmployment = $_POST['country_of_employment'];
            }
            if (isset($_POST['start_date'])) {
                $updateFields[] = "start_date = :start_date";
                $startDate = $_POST['start_date'];
            }
            if (isset($_POST['employment_type'])) {
                $updateFields[] = "employment_type = :employment_type";
                $employmentType = $_POST['employment_type'];
            }

            // Update employee details in the database
            if (!empty($updateFields)) {
                $updateQuery = "UPDATE employees SET " . implode(", ", $updateFields) . " WHERE id = :employee_id";
                $updateStmt = $conn->prepare($updateQuery);
                if (isset($firstName)) $updateStmt->bindParam(':first_name', $firstName);
                if (isset($lastName)) $updateStmt->bindParam(':last_name', $lastName);
                if (isset($email)) $updateStmt->bindParam(':email', $email);
                if (isset($department)) $updateStmt->bindParam(':department', $department);
                if (isset($countryOfEmployment)) $updateStmt->bindParam(':country_of_employment', $countryOfEmployment);
                if (isset($startDate)) $updateStmt->bindParam(':start_date', $startDate);
                if (isset($employmentType)) $updateStmt->bindParam(':employment_type', $employmentType);
                $updateStmt->bindParam(':employee_id', $employeeId);

                if ($updateStmt->execute()) {
                    // Redirect to the same page with success message or perform any other action
                    header("Location: edit_employee.php?id=$employeeId&success=1");
                    exit();
                } else {
                    echo "Error updating employee details.";
                }
            } else {
                echo "No fields to update.";
            }
        }
    } else {
        echo "Employee not found.";
    }
} else {
    echo "Employee ID not provided.";
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <style>
        /* Style for form container */
        /* CSS styles for the form container */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            float: left; /* Float the form to the left */
        }
        /* CSS styles for the GIF container */
        .gif-container {
            float: right; /* Float the GIF container to the right */
            width: 400px; /* Adjust width as needed */
        }
        /* h1{
            color: #51ad26; font-size: 28px; font-weight: bold; margin-bottom: 20px;
        } */
        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Style for form labels */
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* Style for form input fields */
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Style for submit button */
        button[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Style for radio buttons */
        input[type="radio"] {
            margin-right: 5px;
        }

        /* Style for success message */
        .success-message {
            color: green;
            margin-top: 10px;
        }

        /* Style for error message */
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include('sidebar.php'); ?>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-12">
                    <h1 style="color: #51ad26; font-size: 28px; font-weight: bold; margin-bottom: 20px;">Edit Employee</h1>
                    <!-- Display parameters of the current login user within a box -->
                    <div class="current-user-box">
                        <!-- Display parameters here, e.g., user ID, name, etc. -->
                    </div>
                    <div class="form-container">
                        <?php
                            // Include database connection
                            include('db_conn.php');

                            // Check if employee ID is provided in the URL
                            if(isset($_GET['id'])) {
                                $employeeId = $_GET['id'];
                                
                                // Fetch employee details based on the provided ID
                                $query = "SELECT * FROM employees WHERE id = :employee_id";
                                $stmt = $conn->prepare($query);
                                $stmt->bindParam(':employee_id', $employeeId);
                                $stmt->execute();
                                
                                // Check if employee exists
                                if($stmt->rowCount() > 0) {
                                    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
                                    
                                    // Display input fields to edit employee details
                                    ?>
                                    <form action="edit_employee.php?id=<?php echo $employeeId; ?>" method="POST">
                                        <?php if(isset($employee)): ?>
                                            <input type="hidden" name="employee_id" value="<?php echo $employee['id']; ?>">
                                            <label for="first_name">First Name:</label>
                                            <input type="text" id="first_name" name="first_name" value="<?php echo $employee['first_name']; ?>"><br>

                                            <label for="last_name">Last Name:</label>
                                            <input type="text" id="last_name" name="last_name" value="<?php echo $employee['last_name']; ?>"><br>

                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" value="<?php echo $employee['email']; ?>"><br>

                                            <label for="department">Department:</label>
                                            <select id="department" name="department">
                                                <option value="HR" <?php if($employee['department'] == 'HR') echo 'selected'; ?>>HR</option>
                                                <option value="IT" <?php if($employee['department'] == 'IT') echo 'selected'; ?>>IT</option>
                                                <option value="Accounts & Admin" <?php if($employee['department'] == 'Accounts & Admin') echo 'selected'; ?>>Accounts & Admin</option>
                                                <option value="Recruiter" <?php if($employee['department'] == 'Recruiter') echo 'selected'; ?>>Recruiter</option>
                                                <option value="Management" <?php if($employee['department'] == 'Management') echo 'selected'; ?>>Management</option>
                                            </select><br>

                                            <label for="country_of_employment">Country of Employment:</label>
                                            <input type="text" id="country_of_employment" name="country_of_employment" value="<?php echo $employee['country_of_employment']; ?>"><br>

                                            <label for="start_date">Start Date:</label>
                                            <input type="date" id="start_date" name="start_date" value="<?php echo $employee['start_date']; ?>"><br>

                                            <label for="employment_type">Employment Type:</label><br>
                                            <input type="radio" id="permanent" name="employment_type" value="Permanent" <?php if($employee['employment_type'] == 'Permanent') echo 'checked'; ?>>
                                            <label for="permanent">Permanent</label><br>
                                            <input type="radio" id="freelancer" name="employment_type" value="Freelancer" <?php if($employee['employment_type'] == 'Freelancer') echo 'checked'; ?>>
                                            <label for="freelancer">Freelancer</label><br>

                                            <button type="submit">Save Changes</button>
                                        <?php endif; ?>
                                    </form>
                                
                            </div>
                            <!-- <div class="gif-container">
                <img src="assets/img/icoon.gif" alt="Your GIF" width="200">
            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
// Close the database connection
$conn = null;
?>
<?php
    } else {
        echo "Employee not found.";
    }
} else {
    echo "Employee ID not provided.";
}

// Close the database connection
$conn = null;
?>

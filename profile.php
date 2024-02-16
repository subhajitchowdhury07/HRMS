<?php
// Start the session
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit;
}

// Include your database connection code here
$host = "localhost";  // Replace with your database host
$user = "root";       // Replace with your database username
$password = "";       // Replace with your database password
$database = "hrms";   // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data from the database
$emp_id = $_SESSION['emp_id'];
$sql = "SELECT * FROM employees WHERE emp_id = '$emp_id'";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Fetch user data and store it in $user variable
    $user = $result->fetch_assoc();
} else {
    echo "User not found";
    exit;
}

// Initialize update message
$updateMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which update form is submitted and update the database accordingly
    if (isset($_POST['new_first_name'])) {
        $newFirstName = $_POST['new_first_name'];
        // Update the first name in the database
        $sql = "UPDATE employees SET first_name = '$newFirstName' WHERE emp_id = '$emp_id'";
        if ($conn->query($sql) === TRUE) {
            $updateMessage = "First Name updated successfully";
            // Update the $user variable to reflect the change
            $user['first_name'] = $newFirstName;
        } else {
            $updateMessage = "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['new_last_name'])) {
        $newLastName = $_POST['new_last_name'];
        // Update the last name in the database
        $sql = "UPDATE employees SET last_name = '$newLastName' WHERE emp_id = '$emp_id'";
        if ($conn->query($sql) === TRUE) {
            $updateMessage = "Last Name updated successfully";
            // Update the $user variable to reflect the change
            $user['last_name'] = $newLastName;
        } else {
            $updateMessage = "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['new_email'])) {
        $newEmail = $_POST['new_email'];
        // Update the email in the database
        $sql = "UPDATE employees SET email = '$newEmail' WHERE emp_id = '$emp_id'";
        if ($conn->query($sql) === TRUE) {
            $updateMessage = "Email updated successfully";
            // Update the $user variable to reflect the change
            $user['email'] = $newEmail;
        } else {
            $updateMessage = "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['new_phone_number'])) {
        $newPhoneNumber = $_POST['new_phone_number'];
        // Update the phone number in the database
        $sql = "UPDATE employees SET phone_number = '$newPhoneNumber' WHERE emp_id = '$emp_id'";
        if ($conn->query($sql) === TRUE) {
            $updateMessage = "Phone Number updated successfully";
            // Update the $user variable to reflect the change
            $user['phone_number'] = $newPhoneNumber;
        } else {
            $updateMessage = "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['new_address'])) {
        $newAddress = $_POST['new_address'];
        // Update the address in the database
        $sql = "UPDATE employees SET address = '$newAddress' WHERE emp_id = '$emp_id'";
        if ($conn->query($sql) === TRUE) {
            $updateMessage = "Address updated successfully";
            // Update the $user variable to reflect the change
            $user['address'] = $newAddress;
        } else {
            $updateMessage = "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>User Profile</title>
    <!-- Add your CSS links and other meta tags here -->
    <style>
        .update-btn {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-group {
            display: inline-block;
            /* width: 45%; */
            margin-right: 10px;
            margin-bottom: 20px;
        }

        .update-btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
        <?php include('sidebar.php'); ?>
    <!-- Display user profile information and update buttons -->
    <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xl-12 col-sm-12 col-12 ">
                <div class="breadcrumb-path mb-4">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><img src="assets/img/dash.png" class="mr-2" alt="breadcrumb">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                    <h3>Profile</h3>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 col-12 mb-4">
                <div class="head-link-set">
                    <ul>
                        <!-- <li><a href="profile.php">Employment</a></li> -->
                        <li><a class="active" href="#">Detail</a></li>
                        <li><a href="profile-document.php">Document</a></li>
                        <li><a href="profile-payroll.php">Payroll</a></li>
                        <!-- <li><a href="profile-timeoff.html">Timeoff</a></li> -->
                        <!-- <li><a href="profile-review.html">Reviews</a></li> -->
                        <li><a href="profile-setting.php">Settings</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-12 col-sm-12 col-12 ">
                <div class="row">
                    <div class="col-xl-4 col-sm-12 col-12 d-flex">
                        <div class="card card-lists flex-fill">
                            <div class="card-header">
                                <h2 class="card-titles">Basic Information</h2>
                                <!-- <ul>
                                    <li><a class="add-link" data-toggle="modal" data-target="#editinformation"><i data-feather="plus"></i></a></li>
                                    <li><a class="delete-link" data-toggle="modal" data-target="#delete"><i data-feather="trash-2"></i></a></li>
                                </ul> -->
                            </div>
                            <div class="card-body">
                                <!-- Display user profile information and update buttons -->
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>">
                                    <button class="update-btn" onclick="updateField('first_name')">Update</button>
                                </div>
                                <!-- Add similar code for other profile fields -->
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>">
                                    <button class="update-btn" onclick="updateField('last_name')">Update</button>
                                </div>
                                <!-- Add similar code for other profile fields -->
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>">
                                    <button class="update-btn" onclick="updateField('email')">Update</button>
                                </div>
                                <!-- Add similar code for other profile fields -->
                                <div class="form-group">
                                    <label for="phone_number">Phone Number:</label>
                                    <input type="text" id="phone_number" name="phone_number" value="<?php echo $user['phone_number']; ?>">
                                    <button class="update-btn" onclick="updateField('phone_number')">Update</button>
                                </div>
                                <!-- Add similar code for other profile fields -->
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>">
                                    <button class="update-btn" onclick="updateField('address')">Update</button>
                                </div>
                                <!-- Add similar code for other profile fields -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- JavaScript code to update field -->
    <script>
        function updateField(fieldName) {
            var newValue = document.getElementById(fieldName).value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // Update successful, display success message
                    alert('Field updated successfully');
                    // You may also update the UI to reflect the change if needed
                }
            };
            xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("new_" + fieldName + "=" + newValue);
        }
    </script>

</body>
</html>

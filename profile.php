<?php
// Start the session
include('sidebar.php');
// session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit;
}

// Include your database connection code
include 'db_conn.php';

// Fetch user data from the database
$emp_id = $_SESSION['emp_id'];
$sql = "SELECT * FROM employees WHERE emp_id = :emp_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['emp_id' => $emp_id]);

if ($stmt->rowCount() > 0) {
    // Fetch user data and store it in $user variable
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "User not found";
    exit;
}

// Initialize update message
$updateMessage = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which update form is submitted and update the database accordingly
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'new_') !== false) {
            $field = str_replace('new_', '', $key);
            $newValue = $_POST[$key];
            $sql = "UPDATE employees SET $field = :value WHERE emp_id = :emp_id";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute(['value' => $newValue, 'emp_id' => $emp_id])) {
                // Update successful
                $updateMessage = ucfirst($field) . " updated successfully";
                // Update the $user variable to reflect the change
                $user[$field] = $newValue;
            } else {
                $updateMessage = "Error updating " . $field;
            }
        }
    }

    // Profile picture upload handling
    if (isset($_POST['submit'])) {
        if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == 0) {
            // Define target directory based on user type
            $target_dir = "uploads/";

            // Construct the target file path
            $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check file size and file type
            if ($_FILES["profile_pic"]["size"] > 500000) {
                $updateMessage = "Sorry, your file is too large.";
            } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $updateMessage = "Sorry, only JPG, JPEG, PNG files are allowed.";
            } else {
                // Upload file
                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                    // Store the file path in the database (without '../')
                    $stored_file_path = 'uploads/' . basename($_FILES["profile_pic"]["name"]);
                    // Update profile pic in database
                    $update_query = "UPDATE employees SET profile_pic = :profile_pic WHERE emp_id = :emp_id";
                    $stmt = $conn->prepare($update_query);
                    $stmt->bindParam(':profile_pic', $stored_file_path);
                    $stmt->bindParam(':emp_id', $emp_id);
                    if ($stmt->execute()) {
                        // Reload the page
                        header("Location: {$_SERVER['PHP_SELF']}");
                        exit;
                    } else {
                        $updateMessage = "Error uploading profile picture.";
                    }
                } else {
                    $updateMessage = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $updateMessage = "No file uploaded.";
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
        /* Common styles for buttons */
        
        .update-btn {
            background-color: #4CAF50;
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

        /* Style for form groups */
        .form-group {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 20px;
        }

        /* Style for update button */
        .update-btn {
            margin-top: 10px;
        }

        /* Profile picture section */
        .profile-pic-section {
            width: 300px;
            margin-left: 20px;
            text-align: center;
        }

        .profile-pic {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        /* Alert message styles */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        /* Success alert */
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        /* Error alert */
        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        #profile_pic {
            display: none;
        }

        #upload-label {
            display: block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            width: 200px;
            margin: 0 auto;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .profile-pic-section {
                width: 100%;
                margin: 20px auto;
            }
        }

        @media (max-width: 576px) {
            .form-group {
                display: block;
                margin-right: 0;
            }

            .update-btn {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Display user profile information and update buttons -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-12 ">
                    <div class="breadcrumb-path mb-4">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><img src="assets/img/dash.png" class="mr-2"
                                        alt="breadcrumb">Home</a></li>
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
                        <div class="col-xl-4 col-sm-12 col-12">
                            <div class="profile-pic-section">
                                <h2>Profile Picture</h2>
                                <?php if(!empty($user['profile_pic'])): ?>
                                <img src="<?php echo $user['profile_pic']; ?>" alt="Profile Picture"
                                    class="profile-pic">
                                <?php else: ?>
                                <img src="default_profile_pic.jpg" alt="Default Profile Picture"
                                    class="profile-pic">
                                <?php endif; ?>
                                <label for="profile_pic" id="upload-label">Upload Picture</label>
                                <input type="file" id="profile_pic" name="profile_pic" onchange="displaySelectedImage()">
                                <button class="update-btn" onclick="uploadProfilePic()">Upload</button>
                                <!-- Display update message -->
                                <?php if(!empty($updateMessage)): ?>
                                <div class="alert alert-success"><?php echo $updateMessage; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-12 col-12 d-flex">
                            <div class="card card-lists flex-fill">
                                <div class="card-header">
                                    <h2 class="card-titles">Basic Information</h2>
                                </div>
                                <div class="card-body">
                                    <!-- Display user profile information and update buttons -->
                                    <div class="form-group">
                                        <label for="first_name">First Name:</label>
                                        <input type="text" id="first_name" name="first_name"
                                            value="<?php echo $user['first_name']; ?>">
                                        <button class="update-btn" onclick="updateField('first_name')">Update</button>
                                    </div>
                                    <!-- Add similar code for other profile fields -->
                                    <div class="form-group">
                                        <label for="last_name">Last Name:</label>
                                        <input type="text" id="last_name" name="last_name"
                                            value="<?php echo $user['last_name']; ?>">
                                        <button class="update-btn" onclick="updateField('last_name')">Update</button>
                                    </div>
                                    <!-- Add similar code for other profile fields -->
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" id="email" name="email"
                                            value="<?php echo $user['email']; ?>">
                                        <button class="update-btn" onclick="updateField('email')">Update</button>
                                    </div>
                                    <!-- Add similar code for other profile fields -->
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number:</label>
                                        <input type="text" id="phone_number" name="phone_number"
                                            value="<?php echo $user['phone_number']; ?>">
                                        <button class="update-btn"
                                            onclick="updateField('phone_number')">Update</button>
                                    </div>
                                    <!-- Add similar code for other profile fields -->
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" id="address" name="address"
                                            value="<?php echo $user['address']; ?>">
                                        <button class="update-btn" onclick="updateField('address')">Update</button>
                                    </div>
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
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    // Update successful, display success message
                    alert('Field updated successfully');
                    // Reload the profile picture section
                    reloadProfilePicSection();
                }
            };
            xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("new_" + fieldName + "=" + newValue);
        }

        function uploadProfilePic() {
            var fileInput = document.getElementById('profile_pic');
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append('profile_pic', file);
            formData.append('submit', 'Upload');
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    // Update successful, display success message
                    alert('Profile picture uploaded successfully');
                    // Reload the profile picture section
                    reloadProfilePicSection();
                }
            };
            xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
            xhr.send(formData);
        }

        function reloadProfilePicSection() {
            // Reload the profile picture section by reloading the entire page
            location.reload();
        }

        function displaySelectedImage() {
            var fileInput = document.getElementById('profile_pic');
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector('.profile-pic').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
</body>

</html>

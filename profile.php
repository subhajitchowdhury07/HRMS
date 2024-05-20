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
            // Define target directories
            $target_dir_1 = "uploads/";
            $target_dir_2 = "emp/uploads/";

            // Construct the target file paths
            $file_name = basename($_FILES["profile_pic"]["name"]);
            $target_file_1 = $target_dir_1 . $file_name;
            $target_file_2 = $target_dir_2 . $file_name;

            // Upload file without checking size and type
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file_1)) {
                // Duplicate the uploaded file to the second directory
                copy($target_file_1, $target_file_2);

                // Store the file path in the database (without 'emp/')
                $stored_file_path = 'uploads/' . $file_name;

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
                    echo "Error uploading profile picture.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "No file uploaded.";
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
    h2 {
        color: #51ad26;
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .update-btn {
        background-color: #13aa52;
  border: 1px solid #13aa52;
  border-radius: 4px;
  box-shadow: rgba(0, 0, 0, .1) 0 2px 4px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  font-family: "Akzidenz Grotesk BQ Medium", -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 16px;
  font-weight: 400;
  outline: none;
  outline: 0;
  padding: 10px 25px;
  text-align: center;
  transform: translateY(0);
  transition: transform 150ms, box-shadow 150ms;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
    }
    .update-btn:hover {
        box-shadow: rgba(0, 0, 0, .15) 0 3px 9px 0;
  transform: translateY(-2px);
    }
    @media (min-width: 768px) {
        .update-btn{
            padding: 10px 30px;
        }
    }

    /* Style for form groups */
    .form-group {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 20px;
    }

    /* Style for update button */
    /* .update-btn {
        margin-top: 10px;
    } */

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

    .button-33 {
        background-color: #c2fbd7;
        border-radius: 100px;
        box-shadow: rgba(44, 187, 99, .2) 0 -25px 18px -14px inset, rgba(44, 187, 99, .15) 0 1px 2px, rgba(44, 187, 99, .15) 0 2px 4px, rgba(44, 187, 99, .15) 0 4px 8px, rgba(44, 187, 99, .15) 0 8px 16px, rgba(44, 187, 99, .15) 0 16px 32px;
        color: green;
        cursor: pointer;
        display: inline-block;
        font-family: CerebriSans-Regular, -apple-system, system-ui, Roboto, sans-serif;
        padding: 7px 20px;
        text-align: center;
        text-decoration: none;
        transition: all 250ms;
        border: 0;
        font-size: 16px;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
    }

    .button-33:hover {
        box-shadow: rgba(44, 187, 99, .35) 0 -25px 18px -14px inset, rgba(44, 187, 99, .25) 0 1px 2px, rgba(44, 187, 99, .25) 0 2px 4px, rgba(44, 187, 99, .25) 0 4px 8px, rgba(44, 187, 99, .25) 0 8px 16px, rgba(44, 187, 99, .25) 0 16px 32px;
        transform: scale(1.05);
    }

    #profile_pic {
        display: none;
    }

    /* #upload-label {
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
        } */

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
                            <!-- <li><a href="profile-document.php">Document</a></li>
                            <li><a href="profile-payroll.php">Payroll</a></li> -->
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
                                <img src="assets/img/dashboard-profile.jpg" alt="Default Profile Picture"
                                    class="profile-pic">
                                <?php endif; ?>

                                <label for="profile_pic" id="upload-label" class="button-33">Choose From gallery <i
                                        class='fas fa-edit'></i></label><br>
                                <span><?php echo "Maximum size 500 KB" ?><br></span>
                                <input type="file" id="profile_pic" name="profile_pic" accept="image/jpeg, image/png"
                                    onchange="validateFile()">
                                <button class="update-btn" onclick="uploadProfilePic()">Upload</button>
                                <br>
                                <span id="file-error-msg" style="color: red;"></span> <!-- Add this line -->

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
                                        <button class="update-btn" onclick="updateField('phone_number')">Update</button>
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
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script> -->
    <script>
    function validateFile() {
        var fileInput = document.getElementById('profile_pic');
        var file = fileInput.files[0];
        var errorMessageSpan = document.getElementById('file-error-msg'); // Get the span element
        if (file) {
            // Check file size (500 KB limit)
            if (file.size > 500000) {
                errorMessageSpan.textContent = 'Sorry, your file is too large.'; // Update error message
                fileInput.value = ''; // Clear the file input
                return;
            }
            // Check file type
            var validTypes = ['image/jpeg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                errorMessageSpan.textContent = 'Sorry, only JPG and PNG files are allowed.'; // Update error message
                fileInput.value = ''; // Clear the file input
                return;
            }
            // Clear error message if file is valid
            errorMessageSpan.textContent = ''; // Clear error message
            // Display the selected image preview
            displaySelectedImage(file);
        }
    }


    function displaySelectedImage(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('.profile-pic').setAttribute('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }

    function uploadProfilePic() {
        var fileInput = document.getElementById('profile_pic');
        var file = fileInput.files[0];
        var formData = new FormData();
        formData.append('profile_pic', file);
        formData.append('submit', 'Upload');

        // Perform AJAX request to upload the profile picture
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    alert('Profile picture uploaded successfully');
                    location.reload(); // Reload the page after successful upload
                } else {
                    alert('Error uploading profile picture');
                }
            }
        };
        xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
        xhr.send(formData);
    }

    function updateField(fieldName) {
        var newValue = document.getElementById(fieldName).value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
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

    function reloadProfilePicSection() {
        // Reload the profile picture section by reloading the entire page
        location.reload();
    }
    </script>

</body>

</html>
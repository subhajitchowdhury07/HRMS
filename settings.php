<?php
// Start the session
session_start();

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
    // Check if the first name and last name update form is submitted
    if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
        $newFirstName = $_POST['first_name'];
        $newLastName = $_POST['last_name'];
        // Update the first name and last name in the database
        $sql = "UPDATE employees SET first_name = :first_name, last_name = :last_name WHERE emp_id = :emp_id";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute(['first_name' => $newFirstName, 'last_name' => $newLastName, 'emp_id' => $emp_id])) {
            $updateMessage = "Name updated successfully";
            // Update the $user variable to reflect the change
            $user['first_name'] = $newFirstName;
            $user['last_name'] = $newLastName;
        } else {
            $updateMessage = "Error updating record";
        }
    }

    // Check if the profile picture upload form is submitted
    elseif (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == 0) {
        // Define target directory based on user type
        $target_dir = "uploads/";

        // Construct the target file path
        $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size and file type
        if ($_FILES["profile_pic"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
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
                    $updateMessage = "Profile picture uploaded successfully";
                    // Update the $user variable to reflect the change
                    $user['profile_pic'] = $stored_file_path;
                } else {
                    $updateMessage = "Error uploading profile picture";
                }
            } else {
                $updateMessage = "Sorry, there was an error uploading your file";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Settings</title>
    <!-- Include CSS and other meta tags here -->
</head>
<body>
    <?php include("sidebar.php") ?>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-12">
                    <div class="breadcrumb-path mb-4">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><img src="assets/img/dash.png" class="mr-2" alt="breadcrumb" />Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ul>
                        <h3>Settings</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-12 mb-4">
                    <div class="head-link-set">
                        <!-- Add your links here if needed -->
                    </div>
                </div>
                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-titles">Company Logo</h2>
                        </div>
                        <div class="card-body">
                            <div class="company-logo">
                            <label class="logo-upload" for="edit_img">
        <input type="file" id="edit_img" />
        <a><i data-feather="edit"></i></a>
    </label>
                                
                                <?php if(!empty($user['profile_pic'])): ?>
                                    <img src="<?php echo $user['profile_pic']; ?>" alt="Profile Picture" class="profile-pic">
                                <?php else: ?>
                                    <img src="default_profile_pic.jpg" alt="Default Profile Picture" class="profile-pic">
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-titles">Your Company</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include JavaScript files here -->
    <script>
        function updateName() {
            var firstName = document.getElementById('first_name').value;
            var lastName = document.getElementById('last_name').value;
            // You can use AJAX to send the updated first name and last name to the server and update the database
            // Example AJAX code:
            /*
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update successful, display success message
                    alert('Name updated successfully');
                }
            };
            xhr.open("POST", "update_name.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("first_name=" + firstName + "&last_name=" + lastName);
            */
        }

        function uploadProfilePic() {
            var fileInput = document.getElementById('profile_pic');
            var file = fileInput.files[0];
            // You can use FormData to send the file to the server using AJAX
            var formData = new FormData();
            formData.append('profile_pic', file);
            // Example AJAX code to upload profile picture:
            /*
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update successful, display success message
                    alert('Profile picture uploaded successfully');
                }
            };
            xhr.open("POST", "upload_profile_pic.php", true);
            xhr.send(formData);
            */
        }
    </script>
</body>
</html>

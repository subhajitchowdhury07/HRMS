<?php
// Start the session at the beginning of the file
session_start();

// Include database connection
include('db_conn.php');

// Check if user is logged in
if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch emp_id and user_type from session
$emp_id = $_SESSION['emp_id'];
$user_type = $_SESSION['user_type'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Define target directory based on user_type
    if ($user_type === "admin") {
        $target_dir = "uploads/";
    } elseif ($user_type === "user") {
        $target_dir = realpath('emp/uploads/') . '/';
    } else {
        // Handle other user types or errors
        exit("Invalid user type.");
    }

    // Check if file was uploaded without errors
    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == 0) {
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
                $update_query = "UPDATE employees SET profile_pic = :profile_pic WHERE emp_id = :emp_id AND user_type = :user_type";
                $stmt = $conn->prepare($update_query);
                $stmt->bindParam(':profile_pic', $stored_file_path);
                $stmt->bindParam(':emp_id', $emp_id);
                $stmt->bindParam(':user_type', $user_type);
                if ($stmt->execute()) {
                    echo "Profile picture uploaded successfully.";
                } else {
                    echo "Error uploading profile picture.";
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile Picture</title>
</head>
<body>
    <h2>Upload Profile Picture</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="profile_pic" id="profile_pic" required><br><br>
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>

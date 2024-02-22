<?php 
include('sidebar.php'); 
include('db_conn.php');

// Fetch list of employees
$sql = "SELECT id, first_name FROM employees";
$result = $conn->query($sql);

$employees = [];
if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $employees[] = $row;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employeeID = $_POST['employeeID'];

    // Upload document files
    $documentPaths = [];
    foreach ($_FILES as $fileInput => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($file["name"]);
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $documentPaths[$fileInput] = $targetFile;
            } else {
                echo "Error uploading file: " . $file["name"];
            }
        } else {
            echo "File upload error: " . $file['error'];
        }
    }

    // Check if the employee ID exists
    $stmt = $conn->prepare("SELECT id FROM employees WHERE id = :employeeID");
    $stmt->bindParam(':employeeID', $employeeID);
    $stmt->execute();
    $employeeExists = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employeeExists) {
        // Insert document file paths into database
        $stmt = $conn->prepare("INSERT INTO emp_docs (employee_ID, AdharDoc, PANCardDoc, EduDoc, RelievingDoc, PaySlipDoc) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->execute([$employeeID, $documentPaths['adharDoc'], $documentPaths['panCardDoc'], $documentPaths['eduDoc'], $documentPaths['relievingDoc'], $documentPaths['paySlipDoc']]);
            echo "Documents uploaded successfully!";
        } else {
            echo "Error preparing SQL statement: " . $conn->errorInfo()[2];
        }
    } else {
        echo "Employee with ID $employeeID does not exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Document Upload</title>
    <style>/* General styles */
    
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    
    .h2_class {
        text-align: center;
        color: #333;
        margin-top: 80px;
    }
    
    form {
        max-width: 500px;
        margin: 20px auto;
        /* margin-top: 120px */
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top:50px;
}

label {
    display: block;
    margin-bottom: 10px;
    color: #333;
}

input[type="file"] {
    margin-bottom: 15px;
}

input[type="submit"] {
    display: block;
    margin: 20px auto;
    padding: 12px 24px;
    background-color: #72c92e;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #63a82d;
}

/* Custom box styling */
.box {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.box h3 {
    margin-top: 0;
    color: #333;
}

.box p {
    color: #666;
}

/* Responsive styles */
@media (max-width: 600px) {
    form {
        padding: 10px;
    }
}

/* Table-like layout */
.form-row {
    display: flex;
    justify-content: space-between;
    align-items: center; /* Align items vertically */
    margin-bottom: 10px;
}

.form-row label {
    flex: 0 0 45%;
}

.form-row input[type="file"] {
    flex: 0 0 45%;
}
</style>
</head>
<body>
    
    <h2 class="h2_class">Admin Document Upload</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="employeeID">Select Employee:</label>
        <select name="employeeID" id="employeeID">
            <?php foreach ($employees as $employee): ?>
                <option value="<?php echo $employee['id']; ?>"><?php echo $employee['first_name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label for="adharDoc">Adhar Card:</label>
        <input type="file" name="adharDoc" id="adharDoc" accept="application/pdf,image/png,image/jpeg"><br><br>
        <label for="panCardDoc">PAN Card:</label>
        <input type="file" name="panCardDoc" id="panCardDoc" accept="application/pdf,image/png,image/jpeg"><br><br>
        <label for="eduDoc">Education Document:</label>
        <input type="file" name="eduDoc" id="eduDoc" accept="application/pdf,image/png,image/jpeg"><br><br>
        <label for="relievingDoc">Relieving Letter:</label>
        <input type="file" name="relievingDoc" id="relievingDoc" accept="application/pdf,image/png,image/jpeg"><br><br>
        <label for="paySlipDoc">Pay Slip (Month 1):</label>
        <input type="file" name="paySlipDoc" id="paySlip1Doc" accept="application/pdf,image/png,image/jpeg"><br><br>
        <!-- <label for="paySlip2Doc">Pay Slip (Month 2):</label>
        <input type="file" name="paySlip2Doc" id="paySlip2Doc" accept="application/pdf,image/png,image/jpeg"><br><br>
        <label for="paySlip3Doc">Pay Slip (Month 3):</label>
        <input type="file" name="paySlip3Doc" id="paySlip3Doc" accept="application/pdf,image/png,image/jpeg"><br><br> -->
        <input type="submit" value="Upload Documents" name="submit">
    </form>
</body>
</html>

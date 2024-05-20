<?php
// Include database connection
include('db_conn.php');

// Initialize variables
$filter_condition = "";
$employee_id = "";

// Check if employee is selected
if(isset($_POST['employee_id']) && !empty($_POST['employee_id'])) {
    $employee_id = $_POST['employee_id'];
    $filter_condition = "WHERE ed.employee_ID = ?";
}

// Fetch employee details
$sql_employees = "SELECT * FROM employees";
$stmt_employees = $conn->query($sql_employees);

// Fetch document details based on filter condition
$sql_documents = "SELECT ed.*, e.first_name 
                  FROM emp_docs ed
                  INNER JOIN employees e ON ed.employee_ID = e.id ";

if (!empty($filter_condition)) {
    $sql_documents .= $filter_condition;
}

$stmt_documents = $conn->prepare($sql_documents);

// Bind parameters if they exist
if ($employee_id) {
    $stmt_documents->bindParam(1, $employee_id, PDO::PARAM_INT);
}

$stmt_documents->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Documents</title>
    <style>
        /* Additional Styles */
        .h2_class {
            margin: 80px 0 0 250px;
            /* width:100%; */
        }

        .container_viewdocs {
            margin: 20px auto;
            /* Center the container and add top/bottom margin */
            margin-left: 260px;
            /* Smaller left margin */
            margin-right: 20px;
            /* Add margin on the right */
            margin-top: 20px;
            max-width: 800px;
            /* Limit the maximum width of the container */
        }

        .container_viewdocs form {
            margin-bottom: 20px;
        }

        .container_viewdocs label {
            margin-right: 10px;
        }

        .container_viewdocs select {
            width: 200px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .container_viewdocs input[type="submit"] {
            padding: 5px 10px;
            background-color: #87c22f;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
        }

        .container_viewdocs input[type="submit"]:hover {
            background-color: #74b330;
        }

        .container_viewdocs table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            /* Add margin to the top of the table */
        }

        .container_viewdocs th,
        .container_viewdocs td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .container_viewdocs th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        .container_viewdocs a {
            text-decoration: none;
            color: #20509e;
        }

        @media (max-width: 768px) {
            .h2_class {
                margin: 20px auto;
                text-align: center;
            }

            .container_viewdocs {
                margin-left: 10px;
                /* Adjust left margin for better spacing on small screens */
                margin-right: 10px;
                /* Adjust right margin for better spacing on small screens */
            }

            .container_viewdocs select {
                width: calc(100% - 20px);
                /* Adjust width to fit the container */
                margin-left: 10px;
                /* Add margin for better spacing */
                margin-bottom: 10px;
                /* Add margin for better spacing */
            }

            .container_viewdocs input[type="submit"] {
                width: calc(100% - 20px);
                /* Adjust width to fit the container */
                margin-left: 10px;
                /* Add margin for better spacing */
            }
        }
    </style>
</head>

<body>
<?php include('sidebar.php'); ?>
<h2 class="h2_class">Admin View Documents</h2>
<div class="container_viewdocs">
    <form method="POST">
        <label for="employee_id">Select Employee:</label>
        <select name="employee_id" id="employee_id">
            <option value="">Select Employee</option>
            <?php
            if ($stmt_employees->rowCount() > 0) {
                while ($row = $stmt_employees->fetch(PDO::FETCH_ASSOC)) {
                    $selected = ($row['id'] == $employee_id) ? 'selected' : '';
                    echo "<option value='" . $row['id'] . "' $selected>" . $row['first_name'] . "</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="View Documents">
    </form>

    <table id="documentTable">
        <thead>
        <tr>
            <th>Employee Name</th>
            <th>Adhar Card</th>
            <th>PAN Card</th>
            <th>Education Document</th>
            <th>Relieving Letter</th>
            <th>Pay Slip</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($stmt_documents->rowCount() > 0) {
            while ($row = $stmt_documents->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td><a href='" . $row['AdharDoc'] . "' target='_blank'>View</a></td>";
                echo "<td><a href='" . $row['PANCardDoc'] . "' target='_blank'>View</a></td>";
                echo "<td><a href='" . $row['EduDoc'] . "' target='_blank'>View</a></td>";
                echo "<td><a href='" . $row['RelievingDoc'] . "' target='_blank'>View</a></td>";
                echo "<td><a href='" . $row['PaySlipDoc'] . "' target='_blank'>View</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No documents found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

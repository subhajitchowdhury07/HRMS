<?php
include('sidebar.php');
// Include your database connection code here
$host = "localhost";  // Replace with your database host
$user = "u431054670_root";  // Replace with your database username
$password = "Sedulous@123";  // Replace with your database password
$database = "u431054670_hrms";  // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #51ad26;
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 20px;
    }

    form label {
        width: 120px;
        font-weight: bold;
        text-align: right;
        /* Align labels to the right */
    }

    form input[type="date"],
    form input[type="text"],
    form select {
        width: 200px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    form button[type="button"] {
        padding: 8px 50px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
        /* Add margin to separate buttons */
    }

    form button[type="submit"] {
        padding: 8px 20px;
        background-color: #51ad26;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
        /* Add margin to separate buttons */
    }

    form button[type="submit"]:hover {
        background-color: #3c8d1e;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ccc;
    }

    th {
        background-color: #51ad26;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    @media (max-width: 768px) {
        form label {
            width: 100%;
            text-align: center;
        }

        form input[type="date"],
        form input[type="text"],
        form select {
            width: calc(100% - 20px);
        }

        form button[type="submit"],
        #filterButton {
            width: calc(50% - 5px);
        }

        .filter-form {
            display: none;
        }

        .show-filter-form {
            display: flex;
        }

    }

    @media (min-width: 769px) {
        #filterButton {
            display: none;
        }
    }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <h2>Attendance Records</h2>
            <!-- Filter Button -->
            <button type="button" id="filterButton">Filter</button>
            <!-- Filter Form -->
            <form id="filterForm" class="filter-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                method="POST">
                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate">

                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate">

                <!-- Dropdown for selecting employee ID -->
                <label for="employeeID">Employee ID:</label>
                <select id="employeeID" name="employeeID">
                    <option value=""></option>
                    <?php
            // Fetch and display all employee IDs
            $query = "SELECT DISTINCT employees.emp_id, CONCAT(employees.first_name, ' ', employees.last_name) AS full_name FROM attendance LEFT JOIN employees ON attendance.employee_id = employees.emp_id";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $selected = ($_POST['employeeID'] ?? '') == $row['emp_id'] ? 'selected' : '';
                echo "<option value='" . $row['emp_id'] . "' $selected>" . $row['full_name'] .' '.'('.$row['emp_id'].')'. "</option>";
            }
            ?>
                </select>

                <button type="submit">Filter</button>

                <!-- <button type="button" id="printButton">Print</button> -->
                <button type="submit" name="exportCSV" formaction="export.php">Export to CSV</button>
                <button type="submit" name="exportPDF" formaction="export.php">Export to PDF</button>
            </form>
        </div>
    </div>
    <?php
    // Initialize the filter query
    $filter_query = "SELECT attendance.*, CONCAT(employees.first_name, ' ', employees.last_name) AS full_name FROM attendance LEFT JOIN employees ON attendance.employee_id = employees.emp_id WHERE 1";

    // Check if start and end dates are set
    if (isset($_POST['startDate'], $_POST['endDate']) && !empty($_POST['startDate']) && !empty($_POST['endDate'])) {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $filter_query .= " AND DATE(attendance.clock_in) BETWEEN '$startDate' AND '$endDate'";
    }

    // Check if employee ID is set (from dropdown)
    if (isset($_POST['employeeID']) && !empty($_POST['employeeID'])) {
        $employeeID = $_POST['employeeID'];
        $filter_query .= " AND attendance.employee_id = '$employeeID'";
    }

    // Add ORDER BY clause to sort by clock_in date in ascending order
    $filter_query .= " ORDER BY attendance.clock_in ASC";

    // Execute the filter query
    $result = mysqli_query($conn, $filter_query);

    // Check for errors
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Check if filtering has occurred
    if (isset($_POST['startDate']) || isset($_POST['endDate']) || isset($_POST['employeeID'])) {
        echo "<div class='page-wrapper'><div class='content container-fluid'>";
        echo "<table style='margin-top:-90px'>";
        echo "<thead><tr><th>Employee ID</th><th>Employee Name</th><th>Clock In</th><th>Clock Out</th><th>Total Worked Hour</th></tr></thead>";
        echo "<tbody>";
        // Fetch and display filtered records
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['employee_id'] . "</td>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['clock_in'] . "</td>";
            echo "<td>" . $row['clock_out'] . "</td>";
            echo "<td>" . $row['total_worked_hr'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</div></div></div>";
    } else {
        // Display today's attendance records
        $today_query = "SELECT attendance.*, CONCAT(employees.first_name, ' ', employees.last_name) AS full_name 
                        FROM attendance 
                        LEFT JOIN employees ON attendance.employee_id = employees.emp_id 
                        WHERE DATE(attendance.clock_in) = CURDATE()";
        // echo "";
        echo "<div class='page-wrapper'><div class='content container-fluid'><div class='container'>";
        echo "<h2 style='margin-top:-120px'>Today's Attendance Records</h2>";
        displayAttendanceRecords($conn, $today_query);

        // Display yesterday's attendance records
        $yesterday_query = "SELECT attendance.*, CONCAT(employees.first_name, ' ', employees.last_name) AS full_name 
                            FROM attendance 
                            LEFT JOIN employees ON attendance.employee_id = employees.emp_id 
                            WHERE DATE(attendance.clock_in) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
        echo "<h2>Yesterday's Attendance Records</h2>";
        displayAttendanceRecords($conn, $yesterday_query);

        // Display last 30 days attendance records
        $last_30_days_query = "SELECT attendance.*, CONCAT(employees.first_name, ' ', employees.last_name) AS full_name 
                                FROM attendance 
                                LEFT JOIN employees ON attendance.employee_id = employees.emp_id 
                                WHERE DATE(attendance.clock_in) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
        echo "<h2>Last 30 Days Attendance Records</h2>";
        displayAttendanceRecords($conn, $last_30_days_query);

        echo "</div></div></div>";
    }

    // Function to execute query and display attendance records
    function displayAttendanceRecords($conn, $query) {
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Error executing query: " . mysqli_error($conn));
        }
        echo "<table>";
        echo "<thead><tr><th>Employee ID</th><th>Employee Name</th><th>Clock In</th><th>Clock Out</th><th>Total Worked Hour</th></tr></thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['employee_id'] . "</td>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['clock_in'] . "</td>";
            echo "<td>" . $row['clock_out'] . "</td>";
            echo "<td>" . $row['total_worked_hr'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }
    ?>

    <script>
    // JavaScript for filtering employee ID dropdown
    const employeeIDSelect = document.POSTElementById('employeeID');
    const employeeIDOptions = Array.from(employeeIDSelect.options);

    document.POSTElementById('employeeID').addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        const filteredOptions = employeeIDOptions.filter(option => option.textContent.toLowerCase().includes(
            searchText));
        employeeIDSelect.innerHTML = '';
        filteredOptions.forEach(option => {
            employeeIDSelect.appendChild(option.cloneNode(true));
        });
    });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvas-toBlob/0.5.0/canvas-toBlob.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-toBlob"></script>
    <script src="https://cdn.jsdelivr.net/gh/yahoo/csv-download@0.2.0/build/csv-download.js"></script>
    <script>
    // JavaScript for showing/hiding filter form on button click in responsive mode
    const filterForm = document.getElementById('filterForm');
    const filterButton = document.getElementById('filterButton');

    filterButton.addEventListener('click', function() {
        filterForm.classList.toggle('show-filter-form');
    });
    </script>
</body>

</html>
<?php
// Include your database connection code here
// Include your database connection code here
$host = "localhost";  // Replace with your database host
$user = "root";  // Replace with your database username
$password = "";  // Replace with your database password
$database = "hrms";  // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Assuming the user is logged in as an admin

$query = "SELECT * FROM attendance";
$result = mysqli_query($conn, $query);
// $conn->close();
?>

<!-- Html form -->
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
            text-align: right; /* Align labels to the right */
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

        form button[type="button"]{
            padding: 8px 50px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px; /* Add margin to separate buttons */
        }

        form button[type="submit"] {
            padding: 8px 20px;
            background-color: #51ad26;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px; /* Add margin to separate buttons */
        }

        form button[type="submit"]:hover {
            background-color: #3c8d1e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
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
    <h2>Attendance Records</h2>
    <!-- Filter Button -->
    <button type="button" id="filterButton">Filter</button>
    <!-- Filter Form -->
    <form id="filterForm" class="filter-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
            $query = "SELECT DISTINCT employee_id FROM attendance";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['employee_id'] . "'>" . $row['employee_id'] . "</option>";
            }
            ?>
        </select>

        <button type="submit">Filter</button>
        
        <button type="button" id="printButton">Print</button>
        <!-- <button type="submit" name="exportCSV" formaction="export_csv.php">Export to CSV</button>
            <button type="submit" name="exportPDF" formaction="export_pdf.php">Export to PDF</button> -->
            <button type="submit" name="exportCSV" formaction="export.php" >Export to CSV</button>
            <button type="submit" name="exportPDF" formaction="export.php">Export to PDF</button>
    </form>
    

    <div class="table-container">
        <table border="1">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Total Worked Hour</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Initialize the filter query
                $filter_query = "SELECT * FROM attendance WHERE 1";

                // Check if start and end dates are set
                if (isset($_POST['startDate'], $_POST['endDate']) && !empty($_POST['startDate']) && !empty($_POST['endDate'])) {
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];
                    $filter_query .= " AND DATE(clock_in) BETWEEN '$startDate' AND '$endDate'";
                }

                // Check if employee ID is set (from dropdown)
                if (isset($_POST['employeeID']) && !empty($_POST['employeeID'])) {
                    $employeeID = $_POST['employeeID'];
                    $filter_query .= " AND employee_id = '$employeeID'";
                }

                // Execute the filter query
                $result = mysqli_query($conn, $filter_query);

                // Fetch and display filtered records
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['employee_id'] . "</td>";
                    echo "<td>" . $row['clock_in'] . "</td>";
                    echo "<td>" . $row['clock_out'] . "</td>";
                    echo "<td>" . $row['total_worked_hr'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- <script src="assets/js/script.js"></script> -->
    <script>
        // JavaScript for filtering employee ID dropdown
        const employeeIDSelect = document.POSTElementById('employeeID');
        const employeeIDOptions = Array.from(employeeIDSelect.options);

        document.POSTElementById('employeeID').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const filteredOptions = employeeIDOptions.filter(option => option.textContent.toLowerCase().includes(searchText));
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
    <!-- <script src="script.js"></script> -->
    <!-- <script>
     document.addEventListener('DOMContentLoaded', function() {
    const printButton = document.getElementById('printButton');
    const exportCSV = document.getElementById('exportCSV');
    const exportPDF = document.getElementById('exportPDF');

    printButton.addEventListener('click', function() {
        window.print();
    });

    

    exportPDF.addEventListener('click', function() {
        const table = document.getElementById('attendanceTable');
        const pdfContent = tableToPDF(table);
        downloadPDF(pdfContent, 'attendance_records.pdf');
    });


    // Function to convert table to PDF
    function tableToPDF(table) {
        const doc = new jsPDF();
        doc.autoTable({ html: table });
        return doc.output('blob');
    }

    // Function to download PDF
    function downloadPDF(content, filename) {
        if (navigator.msSaveBlob) { // IE 10+
            navigator.msSaveBlob(content, filename);
        } else {
            const link = document.createElement('a');
            link.href = URL.createObjectURL(content);
            link.download = filename;
            link.click();
        }
    }
});

    </script> -->
      <script>
        // JavaScript for showing/hiding filter form on button click in responsive mode
        const filterForm = document.getElementById('filterForm');
        const filterButton = document.getElementById('filterButton');

        filterButton.addEventListener('click', function() {
            filterForm.classList.toggle('show-filter-form');
        });
    </script>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const printButton = document.getElementById('printButton');

            printButton.addEventListener('click', function() {
                window.print();
            });
        });
    </script> -->
</body>
</html

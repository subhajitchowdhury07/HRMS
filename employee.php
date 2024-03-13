<!DOCTYPE html>
<html>
<head>
    <title>All Employees</title>
    <link rel="shortcut icon" href="assets/img/sedulous-small-icon.png">
    <style>
    /* Add your custom CSS styles here */
    /* Ensure to include necessary CSS and JS files */
    li ul {
        display: none;
        position: absolute;
        background-color: #fff; /* Set your desired background color */
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        z-index: 1;
    }

    li:hover ul {
        display: block;
    }

    li ul li {
        display: block;
        padding: 10px;
    }

    li ul li a {
        text-decoration: none;
        color: #333; /* Set your desired text color */
        display: block;
    }

    li ul li a:hover {
        background-color: #f4f4f4; /* Set your desired hover background color */
    }

    /* Add rounded profile picture */
    .table-img img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }

    /* Style for select employee dropdown */
    .form-group select {
        width: 100%;
        padding: 8px;
        border: 2px solid #4CAF50; /* Green border */
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 5px;
        margin-bottom: 10px;
        background-color: #fff; /* Set your desired background color */
        color: #333; /* Set your desired text color */
        
    }
	.form-control{
			margin-left:140px;
			border:1px solid black;
			/* margin-top:230px; */
		}

    .form-group select:focus {
        outline: none; /* Remove focus outline */
        border-color: #51ad26; /* Change border color on focus */
        box-shadow: 0 0 5px #51ad26; /* Add shadow on focus */
    }

    /* Style for download button */
    .btn-download {
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
        border-radius: 4px;
    }

    .btn-download:hover {
        background-color: #45a049; /* Darker green */
    }

    .head-link-set {
        display: flex;
        align-items: center;
        flex-wrap: wrap; /* Allow items to wrap */
    }

    .head-link-set > * {
        margin-right: 10px;
        margin-bottom: 10px; /* Add margin-bottom for spacing between elements */
    }

    @media only screen and (max-width: 768px) {
        .head-link-set > * {
            margin-right: 0; /* Remove right margin on smaller screens */
            margin-bottom: 5px; /* Adjust margin bottom for smaller spacing */
        }
        .form-control {
            margin-left: 0; /* Reset margin left for smaller screens */
        }
    }
</style>

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
                            <li class="breadcrumb-item active"> Employees</li>
                        </ul>
                        <h3>Employees</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-12 mb-4">
                    <div class="head-link-set">
                        <a class="btn-add" href="add-employee.php"><i data-feather="plus"></i> Add Person</a>
                        <div class="form-group">
                            <!-- <label for="employee_select">Select Employee:</label> -->
                            <select class="form-control" id="employee_select">
                                <option value="">Select employee</option>
                                <?php
                                // Fetch employee details for dropdown
                                $sql = "SELECT id,emp_id, first_name, last_name FROM employees";
                                $stmt = $conn->query($sql);
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row['id'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . " ( " . $row['emp_id'] . " )" . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn btn-outline-success p-3" onclick="downloadEmployeeDetails()">Download Details</button>
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-12 mb-4">
                    <?php
                    // Fetch employee count
                    $sql = "SELECT COUNT(id) as empcount FROM employees";
                    $stmt = $conn->query($sql);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $empcount = $row['empcount'];
                    ?>
                    <div class="row">
                        <div class="col-xl-10 col-sm-8 col-12">
                            <label class="employee_count"><span style="color: #51ad26; font-size: 28px; font-weight: bold; margin-bottom: 20px;"><?php echo $empcount; ?></span> People</label>
                        </div>
                        <!-- Add any additional buttons or filters here -->
                    </div>
                </div>
                <div class="col-xl-12 col-sm-12 col-12 mb-4">
                    <div class="card">
                        <div class="table-heading">
                            <h2 style="color: #51ad26; font-size: 28px; font-weight: bold; margin-bottom: 20px;">Employee Summary</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom-table no-footer">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Emp ID</th>
                                        <th>Title</th>
                                        <th>Reporting To</th>
                                        <th>Department</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch employee details for table
                                    $sql = "SELECT profile_pic, emp_id, first_name, last_name, title, reporting_to, department, email, phone_number FROM employees";
                                    $stmt = $conn->query($sql);
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<div class='table-img'>";
                                        echo "<a href='profile.php'>";
                                        if (!empty($row['profile_pic'])) {
                                            echo "<img src='".$row['profile_pic']."' alt='profile' class='img-table' />";
                                        } else {
                                            echo "<img src='assets/img/dashboard-profile.jpg' alt='profile' class='img-table' />";
                                        }
                                        echo "<label>".$row['first_name']." ".$row['last_name']."</label>";
                                        echo "</a>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "<td>".$row['emp_id']."</td>";
                                        echo "<td>".$row['title']."</td>";
                                        echo "<td class='reporting-to'>".$row['reporting_to']."</td>";
                                        echo "<td>".$row['department']."</td>";
                                        echo "<td>".$row['email']."</td>";
                                        echo "<td>".$row['phone_number']."</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- JavaScript function to handle the download -->
<script>
    function downloadEmployeeDetails() {
        // Get the selected employee's ID
        var employeeId = document.getElementById("employee_select").value;

        // If no employee is selected, redirect to download all employee details
        if (!employeeId) {
            window.location.href = 'download_employee_details.php';
        } else {
            // Redirect to the PHP file that will generate the CSV with emp_id parameter
            window.location.href = 'download_employee_details.php?id=' + employeeId;
        }
    }
</script>


</html>

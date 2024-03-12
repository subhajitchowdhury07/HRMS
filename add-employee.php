<?php include("sidebar.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>HRMS from sedulous</title>

    <link rel="shortcut icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    <style>
        /* Add this style section to your existing head or style section */
        .btn-secondary {
            background-color: #6c757d; /* Gray color for the "Cancel" button */
            color: #fff; /* White text color */
            padding: 15px 30px; /* Adjust padding as needed */
            font-size: 16px;
            border-radius: 5px;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268; /* Darker gray color on hover */
            text-decoration: none;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color:#51ad26;
        }
    </style>
</head>

<body>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-12 ">
                    <div class="breadcrumb-path mb-4">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active"> Employees</li>
                        </ul>
                        <h3>Create Employees</h3>
                    </div>
                </div>

                <!-- common part of every pages -->

                <div class="col-xl-12 col-sm-12 col-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-titles">Basic Details <span>Organized and secure.</span><span style="color:red;">(*)mandatory fields</span></h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="process_employee.php">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="emp_id">Employee ID:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="emp_id" name="emp_id" placeholder="Employee ID">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                    <div class="form-group">
                                            <label for="first_name">First Name:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="first_name" name="first_name" placeholder="First Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                    <div class="form-group">
                                            <label for="last_name">Last Name:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="last_name" name="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="email">Email:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="department">Department:<span style="color:red; font-size:20px">*</span></label>
                                            <select class="select" name="department" id="department">
                                                <option value="#">Department</option>
                                                <option value="HR">HR</option>
                                                <option value="IT">IT</option>
                                                <option value="Accounts & Admin">Accounts & Admin</option>
                                                <option value="Recruiter and Management">Recruiter and Management</option>
                                                <!-- Add other options as needed -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="reporting_to">Reporting To:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="reporting_to" name="reporting_to" placeholder="Reporting To">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="source_of_hire">Source of Hire:</label>
                                            <input type="text" id="source_of_hire" name="source_of_hire" placeholder="Source of hire">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="seating_location">Seating Location:</label>
                                            <input type="text" id="seating_location" name="seating_location" placeholder="Seating Location">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="title">Title:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="title" name="title" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="employee_status">Employee Status</label>
                                            <input type="text" id="employee_status" name="employee_status" placeholder="Employee Status">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="other_email">Other Email:</label>
                                            <input type="text" id="other_email" name="other_email" placeholder="Other Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="birth_date">Birth Date:<span style="color:red; font-size:20px">*</span></label>
                                            <div class="input-group">
                                                <input type="text" id="birth_date" class="form-control datepicker" placeholder="Birth Date" name="birth_date">
                                                <div class="input-group-append">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="marital_status">Marital Status:</label>
                                            <input type="text" id="marital_status" name="marital_status" placeholder="Marital Status">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="address">Address:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="address" name="address" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="tags">Tags:</label>
                                            <input type="text" id="tags" name="tags" placeholder="Tags">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="job_description">Job Description:<span style="color:red; font-size:20px">*</span></label>
                                            <input type="text" id="job_description" name="job_description" placeholder="Job Description">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="date_of_exit">Date of Exit:</label>
                                            <div class="input-group">
                                                <input type="text" id="date_of_exit" class="form-control datepicker" placeholder="Date of exit" name="date_of_exit">
                                                <div class="input-group-append">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <label for="gender">Gender:<span style="color:red; font-size:20px">*</span></label>
                                            <select class="select" name="gender" id="gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add other fields as needed -->
                                <div class="col-xl-12 col-sm-12 col-12 ">
                                    <div class="card ">
                                        <div class="card-header">
                                            <h2 class="card-titles">Employment Details<span>Let everyone know the essentials
                                                    so they're fully prepared.</span></h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="country_of_employment">Country of Employment:</label>
                                                        <select class="select" name="country_of_employment" id="country_of_employment">
                                                            <option value="#">Country of Employment</option>
                                                            <option value="Kolkata">Kolkata</option>
                                                            <option value="Bengalore">Bengalore</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label for="start_date">Joining Date:<span style="color:red; font-size:20px">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" id="start_date" class="form-control datepicker" placeholder="Start Date" name="start_date">
                                                            <div class="input-group-append">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <label for="job_title">Job Title:</label>
                                                        <input type="text" id="job_title" name="job_title" placeholder="Job Title">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <label for="employment_type">Employment Type:<span style="color:red; font-size:20px">*</span></label>
                                                        <select class="select" name="employment_type" id="employment_type">
                                                            <option value="Permanent">Permanent</option>
                                                            <option value="Freelancer">Freelancer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-sm-12 col-12 ">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2 class="card-titles">Salary Details<span>Stored securely, only visible to
                                                    Super Admins, Payroll Admins, and themselves.</span></h2>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <label for="currency">Currency:<span style="color:red; font-size:20px">*</span></label>
                                                        <select class="select" name="currency" id="currency">
                                                            <option>Currency </option>
                                                            <option value="$">$(Dollar)</option>
                                                            <option value="₹">₹(Rupees)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <label for="salary_frequency">Salary Frequency:<span style="color:red; font-size:20px">*</span></label>
                                                        <select class="select" name="salary_frequency" id="salary_frequency">
                                                            <option value="Frequency">Frequency </option>
                                                            <option value="Annualy">Annually</option>
                                                            <option value="Monthly">Monthly</option>
                                                            <option value="Weekly">Weekly</option>
                                                            <option value="Daily">Daily</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <label for="salary_start_date">Salary Start Date:</label>
                                                        <input type="text" id="salary_start_date" class="form-control datepicker" placeholder="Salary Start Date" name="salary_start_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <label for="gross_salary">Gross salary:<span style="color:red; font-size:20px">*</span></label>
                                                        <input type="text" id="gross_salary" name="gross_salary" placeholder="Gross salary">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Add other fields as needed -->
                                            <div class="row">
                                                <div class="col-xl-12 col-sm-12 col-12">
                                                    <div class="form-btn">
                                                        <button type="submit" name="add_team_member" class="btn-apply">Add Team Member</button>
                                                        <a href="add-employee.php" class="btn-secondary" style="background-color: red">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add the Bootstrap Datepicker script -->
    <script src="assets/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" href="assets/bootstrap-datepicker.min.css">
<script>
                function calculateSalary() {
                    // Get the gross salary input value
                    var grossSalary = parseFloat(document.getElementById("grossSalary").value);

                    // Perform calculations
                    var basicSalary = 0.4 * grossSalary;
                    var hra = 0.5 * basicSalary;
                    var totalSalary = basicSalary + hra + 1200 + 800 + 2543 + 505;

                    // Display the calculated values
                    document.getElementById("basicSalary").innerText = basicSalary;
                    document.getElementById("hra").innerText = hra;
                    document.getElementById("totalSalary").innerText = totalSalary;

                    // Show the results section
                    document.getElementById("results").style.display = "block";;
                }
            </script>
    <script>
        // Initialize the datepicker
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Adjust the format as needed
                autoclose: true
            });
        });
    </script>
</body>

</html>

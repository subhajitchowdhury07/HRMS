<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< HEAD
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>HRMS from sedulous</title>

	<link rel="shortcut icon" href="assets/img/favicon.png">

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css"> -->

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
</style>
=======
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
    </style>
>>>>>>> c982c37 (Second update)
</head>

<body>

<<<<<<< HEAD
	<?php include("sidebar.php") ?>

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
								<h2 class="card-titles">Basic Details <span>Organized and secure.</span></h2>
							</div>
							<div class="card-body">
								<form method="post" action="process_employee.php">
									<div class="row">
										<div class="col-xl-6 col-sm-12 col-12">
											<div class="form-group">
												<input type="text" name="first_name" placeholder="First Name">
											</div>
										</div>
										<div class="col-xl-6 col-sm-12 col-12">
											<div class="form-group">
												<input type="text" name="last_name" placeholder="Last Name">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xl-6 col-sm-12 col-12">
											<div class="form-group">
												<input type="text" name="email" placeholder="Email">
											</div>
										</div>
									</div>
									<div class="col-xl-12 col-sm-12 col-12 ">
										<div class="card ">
											<div class="card-header">
												<h2 class="card-titles">Employment Details<span>Let everyone know the essentials so they're
														fully
														prepared.</span></h2>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-xl-6 col-sm-12 col-12">
															<div class="form-group">
																	<select class="select" name="country_of_employment">
																			<option value="#">Country of Employment</option>
																			<option value="Kolkata">Kolkata</option>
																			<option value="Bengalore">Bengalore</option>
																	</select>
															</div>
													</div>
													<div class="col-xl-6 col-sm-12 col-12">
															<div class="form-group">
																	<div class="input-group">
																			<input type="text" class="form-control datepicker"  placeholder="Start Date" name="start_date">
																			<div class="input-group-append">
																					<span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
																			</div>
																	</div>
															</div>
													</div>
											</div>
												<div class="row">
													<div class="col-xl-6 col-sm-12 col-12 ">
														<div class="form-group">
															<input type="text" name="job_title" placeholder="Job Title">
														</div>
													</div>
													<div class="col-xl-6 col-sm-12 col-12 ">
														<div class="form-group">
															<select class="select" name="employment_type">
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
												<h2 class="card-titles">Salary Details<span>Stored securely, only visible to Super Admins,
														Payroll
														Admins, and themselves.</span></h2>
											</div>
											<div class="card-body">
												<div class="row">
													<div class="col-xl-6 col-sm-12 col-12 ">
														<div class="form-group">
															<select class="select" name="currency">
																<option >Currency </option>
																<option value="$">$(Doller)</option>
																<option value="₹">₹(Rupees)</option>
															</select>
														</div>
													</div>
													<div class="col-xl-6 col-sm-12 col-12 ">
														<div class="form-group">
															<select class="select" name="salary_frequency">
																<option value="Frequency">Frequency </option>
																<option value="Annualy">Annualy</option>
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
															<input type="text" class="form-control datepicker"  placeholder="Start Date" name="salary_start_date">
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-6 col-sm-12 col-12 ">
														<div class="form-group">
															<input type="text" name="job_title" placeholder="Gross salary">
														</div>
													</div>



										<div class="row">
											<div class="col-xl-12 col-sm-12 col-12">
												<div class="form-btn">
													<button type="submit" name="add_team_member" class="btn-apply">Add Team
														Member</button>
													<a href="add-employee.php" class="btn-secondary">Cancel</a>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>

				</div>

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


				<script src="assets/js/jquery-3.6.0.min.js"></script>

				<script src="assets/js/popper.min.js"></script>
				<script src="assets/js/bootstrap.min.js"></script>

				<script src="assets/js/feather.min.js"></script>

				<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

				<script src="assets/plugins/select2/js/select2.min.js"></script>

				<script src="assets/js/script.js"></script>
				<!-- Add the Bootstrap Datepicker script -->
					<script src="assets/bootstrap-datepicker.js"></script>
					<link rel="stylesheet" href="assets/bootstrap-datepicker.min.css">


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
=======
    <?php include("sidebar.php") ?>

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
                            <h2 class="card-titles">Basic Details <span>Organized and secure.</span></h2>
                        </div>
                        <div class="card-body">
                            <form method="post" action="process_employee.php">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="id" placeholder="EmployeeID">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="last_name" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="first_name" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="phone_number" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <select class="select" name="department">
                                                <option value="#">Department</option>
                                                <option value="HR">HR</option>
                                                <option value="IT">IT</option>
                                                <!-- Add other options as needed -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="reporting_to" placeholder="Reporting To">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="source_of_hire" placeholder="Source of hire">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="seating_location" placeholder="Seating Location">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="title" placeholder="Title">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="employee_status" placeholder="Employee Status">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="other_email" placeholder="Other Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker"
                                                    placeholder="Birth Date" name="birth_date">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="marital_status" placeholder="Marital Status">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="address" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="tags" placeholder="Tags">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <input type="text" name="job_description" placeholder="Job Description">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker"
                                                    placeholder="Date of exit" name="date_of_exit">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-calendar-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
    <div class="col-xl-6 col-sm-12 col-12">
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="select" name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="others">Others</option>
            </select>
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
                                                        <select class="select" name="country_of_employment">
                                                            <option value="#">Country of Employment</option>
                                                            <option value="Kolkata">Kolkata</option>
                                                            <option value="Bengalore">Bengalore</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control datepicker"
                                                                placeholder="Start Date" name="start_date">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <input type="text" name="job_title" placeholder="Job Title">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <select class="select" name="employment_type">
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
                                                        <select class="select" name="currency">
                                                            <option>Currency </option>
                                                            <option value="$">$(Dollar)</option>
                                                            <option value="₹">₹(Rupees)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <select class="select" name="salary_frequency">
                                                            <option value="Frequency">Frequency </option>
                                                            <option value="Annualy">Annualy</option>
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
                                                        <input type="text" class="form-control datepicker"
                                                            placeholder="Start Date" name="salary_start_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-12 col-12 ">
                                                    <div class="form-group">
                                                        <input type="text" name="gross_salary" placeholder="Gross salary">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Add other fields as needed -->

                                            <div class="row">
                                                <div class="col-xl-12 col-sm-12 col-12">
                                                    <div class="form-btn">
                                                        <button type="submit" name="add_team_member"
                                                            class="btn-apply">Add Team Member</button>
                                                        <a href="add-employee.php" class="btn-secondary">Cancel</a>
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


            <script src="assets/js/jquery-3.6.0.min.js"></script>

            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>

            <script src="assets/js/feather.min.js"></script>

            <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

            <script src="assets/plugins/select2/js/select2.min.js"></script>

            <script src="assets/js/script.js"></script>
            <!-- Add the Bootstrap Datepicker script -->
            <script src="assets/bootstrap-datepicker.js"></script>
            <link rel="stylesheet" href="assets/bootstrap-datepicker.min.css">


            <script>
                // Initialize the datepicker
                $(document).ready(function () {
                    $('.datepicker').datepicker({
                        format: 'yyyy-mm-dd', // Adjust the format as needed
                        autoclose: true
                    });
                });
            </script>
        </div>

</body>

</html>
>>>>>>> c982c37 (Second update)

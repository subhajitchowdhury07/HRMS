<!DOCTYPE html>
<html lang="en">

<head>
<body>
	<?php include("sidebar.php") ?>



		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="row">
					<div class="col-xl-12 col-sm-12 col-12 ">
						<div class="breadcrumb-path mb-4">
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php">Home</a>
								</li>
								<li class="breadcrumb-item active"> Salary calculator</li>
							</ul>
							<h3>CTC calculator</h3>
						</div>
					</div>
          <div class="col-xl-12 col-sm-12 col-12 ">
	<div class="card">
		<div class="card-header">
			<h2 class="card-titles">Salary calculator<span>Put's Gross salary to calculate PF, Taxes, etc,
					</span></h2>
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
			<!-- <div class="row">
				<div class="col-xl-6 col-sm-12 col-12 ">
					<div class="form-group">
						<input type="text" class="form-control datepicker"  placeholder="Start Date" name="salary_start_date">
					</div>
				</div>
			</div> -->
			<div class="row">
				<div class="col-xl-6 col-sm-12 col-12 ">
					<div class="form-group">
						<input type="text" id="grossSalary" class="form-control" placeholder="Gross salary">
					</div>
				</div>
					<div class="btn">
						<button onclick="calculateSalary()">Calculate Salary</button>
				</div>
		</div>

		<!-- Display the calculated values -->
		<div id="results" style="display:none;">
				<p>Basic Salary: <span id="basicSalary"></span></p>
				<p>HRA: <span id="hra"></span></p>
				<p>Medical Allowance: 1200 per month (14400 annually)</p>
				<p>Conveyance: 800 per month (9600 annually)</p>
				<p>Special Allowance: 2543</p>
				<p>ESIC: 505</p>
		</div>

		<br>

		<p><strong>Total Salary: <span id="totalSalary"></span></strong></p>
		
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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Sedulous technology .pvt .ltd</title>

</head>
<body>
    
<?php include("sidebar.php") ?>
<div class="page-wrapper">
<div class="content container-fluid">
<div class="row">
<div class="col-xl-12 col-sm-12 col-12 ">
<div class="breadcrumb-path mb-4">
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><img src="assets/img/dash.png" class="mr-2" alt="breadcrumb">Home</a>
</li>
<li class="breadcrumb-item active"> Profile</li>
</ul>
<h3>Profile	</h3>
</div>
</div>
<div class="col-xl-12 col-sm-12 col-12 mb-4">
<div class="head-link-set">
<ul>
<!-- <li><a href="profile.php">Employement</a></li> -->
<li><a href="profile.php">Detail</a></li>
<li><a href="#" class="active">Document</a></li>
<li><a href="profile-payroll.php">Payroll</a></li>
<!-- <li><a href="profile-timeoff.html">Timeoff</a></li> -->
<!-- <li><a href="profile-review.html">Reviews</a></li> -->
<li><a href="profile-setting.php">Settings</a></li>
</ul>
</div>
</div>
<div class="col-xl-12 col-sm-12 col-12 mb-4">
<div class="row">
<div class="col-xl-12 col-sm-12 col-12">
<div class=" card card-lists">
<div class="card-header">
<h2 class="card-titles">Basic Information</h2>
<a class="btn btn-apply" data-toggle="modal" data-target="#adddocument">Add Document</a>
</div>
<div class="card-body">
<div class="row">
<div class="col-xl-6 col-sm-12 col-12 ">
<div class="card">
<div class="card-header">
<h2 class="card-titles">Passport</h2>
</div>
<div class="card-body">
<div class="employee-contents">
<ul>
<li>
<label><img src="assets/img/pdf.png" alt="pdf" /> Passport.pdf</label>
<a class="edit-link"><i data-feather="edit"></i></a>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="col-xl-6  col-sm-12 col-12 ">
<div class="card">
<div class="card-header">
<h2 class="card-titles">P45</h2>
</div>
<div class="card-body">
<div class="employee-contents">
<ul>
<li>
<label><img src="assets/img/pdf.png" alt="pdf" /> Passport.pdf</label>
<a class="edit-link"><i data-feather="edit"></i></a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xl-6 col-sm-12 col-12 ">
<div class="card">
<div class="card-header">
<h2 class="card-titles">P45</h2>
</div>
<div class="card-body">
<div class="employee-contents">
<ul>
<li>
<label><img src="assets/img/pdf.png" alt="pdf" /> Visa.pdf</label>
<a class="edit-link"><i data-feather="edit"></i></a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="col-12 mt-5">
<div class="row">
<a class="btn btn-doc" href="profile-createdocument.html">Add New Document</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>


<div class="customize_popup">
<div class="modal fade" id="adddocument" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="staticBackdropLabel">Add Document</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class=" col-md-12 p-0">
<div class=" form-popup">
<label>Document Description</label>
<input type="text">
</div>
<div class=" form-popup">
<div class="file-uploads">
<label for="upload_img">
<input type="file" id="upload_img" />
<span>Upload</span>
</label>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary">Add</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>
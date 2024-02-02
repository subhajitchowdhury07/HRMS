<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Sedulous technology .pvt .ltd</title>
<link rel="shortcut icon" href="../assets/img/favicon.png">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">

<link rel="stylesheet" href="../assets/css/style.css">

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    
<?php include("sidebar.php") ?>

<div class="page-wrapper">
<div class="content container-fluid">
<div class="page-name 	mb-4">
<h4 class="m-0"><img src="../assets/img/profiles/avatar-14.jpg" class="mr-1" alt="profile" /> Welcome Maria</h4>
<label>Sun, 29 Nov 2019</label>
</div>
<div class="row mb-4">
<div class="col-xl-6 col-sm-12 col-12">
<div class="breadcrumb-path ">
<ul class="breadcrumb">
<li class="breadcrumb-item"><a href="index.php"><img src="../assets/img/dash.png" class="mr-3" alt="breadcrumb" />Home</a>
</li>
<li class="breadcrumb-item active">Dashboard</li>
</ul>
<h3>Employee Dashboard</h3>
</div>
</div>
<div class="col-xl-6 col-sm-12 col-12">
<div class="row">
<div class="col-xl-6 col-sm-6 col-12">
<a class="btn-emp" href="../index.php"> Admin Dashboard</a>
</div>
<div class="col-xl-6 col-sm-6 col-12">
<a class="btn-dash" href="#">Employee Dashboard</a>
</div>
</div>
</div>
</div>
<div class="row mb-4">
<div class="col-xl-3 col-sm-6 col-12">
<div class="card board1 fill1 ">
<div class="card-body">
<div class="card_widget_header">
<label>Employees</label>
<h4>700</h4>
</div>
<div class="card_widget_img">
<img src="../assets/img/dash1.png" alt="card-img" />
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card board1 fill2 ">
<div class="card-body">
<div class="card_widget_header">
<label>Companies</label>
<h4>30</h4>
</div>
<div class="card_widget_img">
<img src="../assets/img/dash2.png" alt="card-img" />
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card board1 fill3 ">
<div class="card-body">
<div class="card_widget_header">
<label>Leaves</label>
<h4>9</h4>
</div>
<div class="card_widget_img">
<img src="../assets/img/dash3.png" alt="card-img" />
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
<div class="card board1 fill4 ">
<div class="card-body">
<div class="card_widget_header">
<label>Salary</label>
<h4>$5.8M</h4>
</div>
<div class="card_widget_img">
<img src="../assets/img/dash4.png" alt="card-img" />
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xl-6 d-flex mobile-h">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Total Employees</h5>
</div>
</div>
<div class="card-body">
<div id="invoice_chart"></div>
<div class="text-center text-muted">
<div class="row">
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-primary mr-1"></i> Business</p>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-success mr-1"></i> Development</p>
</div>
</div>
<div class="col-4">
<div class="mt-4">
<p class="mb-2 text-truncate"><i class="fas fa-circle text-danger mr-1"></i> Testing</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-xl-6 d-flex">
<div class="card flex-fill">
<div class="card-header">
<div class="d-flex justify-content-between align-items-center">
<h5 class="card-title">Total Salary By Unit</h5>
</div>
</div>
<div class="card-body">
<div id="sales_chart"></div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-xl-6 col-sm-12 col-12 d-flex">
<div class="card card-list flex-fill">
<div class="card-header ">
<h4 class="card-title-dash">Your Upcoming Leave</h4>
<div class="dropdown">
<button class="btn btn-action " type="button" id="roomsBtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-ellipsis-h"></i>
</button>
<div class="dropdown-menu" aria-labelledby="roomsBtn">
<a class="dropdown-item" href="#">Action</a>
</div>
</div>
</div>
<div class="card-body p-0">
<div class="leave-set">
<span class="leave-inactive">
<i class="fas fa-briefcase"></i>
</span>
<label>Mon, 16 Dec 2021</label>
</div>
<div class="leave-set">
<span class="leave-active">
<i class="fas fa-briefcase"></i>
</span>
<label>Fri, 20 Dec 2021</label>
</div>
<div class="leave-set">
<span class="leave-active">
<i class="fas fa-briefcase"></i>
</span>
<label>Wed, 25 Dec 2021</label>
</div>
<div class="leave-set">
<span class="leave-active">
<i class="fas fa-briefcase"></i>
</span>
<label>Fri, 27 Dec 2021</label>
</div>
<div class="leave-set">
<span class="leave-active">
<i class="fas fa-briefcase"></i>
</span>
<label>Tue, 31 Dec 2021</label>
</div>
<div class="leave-viewall">
<a href="leave.php">View all <img src="../assets/img/right-arrow.png" class="ml-2" alt="arrow" /></a>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-12 col-12 d-flex">
<div class="card card-list flex-fill">
<div class="card-header">
<div class="p-0  ">
<h4 class="card-title">Recent Activities</h4>
</div>
</div>
<div class="card-body dash-activity">
<div class="slimscroll activity_scroll">
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-02.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>2 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-05.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>3 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-07.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>4 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-08.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>5 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-09.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>6 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-10.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>2 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-12.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>3 hours ago</span>
</div>
</div>
<div class="activity-set">
<div class="activity-img">
<img src="../assets/img/profiles/avatar-13.jpg" alt="avatar">
</div>
<div class="activity-content">
<label>Lorem ipsum dolor sit amet,</label>
<span>4 hours ago</span>
</div>
</div>
</div>
<div class="leave-viewall activit">
<a>View all <img src="../assets/img/right-arrow.png" class="ml-2" alt="arrow"></a>
</div>
</div>
</div>
</div>
<div class="col-xl-3 col-sm-12 col-12 d-flex">
<div class="card card-list flex-fill ">
<div class="card-header">
<h2 class="card-titles">Team Leads</h2>
<a class="manage-link">Manage Team</a>
</div>
<div class="card-body p-0">
<div class="manage-set">
<div class="manage-name">
<label>John Gibbs</label>
<span>PHP</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-21.jpg" alt="profile">
</div>
</div>
<div class="manage-set">
<div class="manage-name">
<label>Danny Ward</label>
<span>Design</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-20.jpg" alt="profile">
</div>
</div>
<div class="manage-set">
<div class="manage-name">
<label>Linda Craver</label>
<span>IOS</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-19.jpg" alt="profile">
</div>
</div>
<div class="manage-set">
<div class="manage-name">
<label>Jenni Sims</label>
<span>Android</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-18.jpg" alt="profile">
</div>
</div>
<div class="manage-set border-0">
<div class="manage-name">
<label>Maria Cotton</label>
<span>Business</span>
</div>
<div class="manage-img">
<img src="../assets/img/profiles/avatar-17.jpg" alt="profile">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>


<script src="../assets/js/jquery-3.6.0.min.js"></script>

<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<script src="../assets/js/feather.min.js"></script>

<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="../assets/js/script.js"></script>
</body>
</html>
    <div class="col-xl-6 d-flex">
    <div class="card flex-fill">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Attendance Report</h5>
            </div>
        </div>
        <div class="card-body">
        
        <?php
// Include database connection
include '../db_conn.php';

// Function to calculate daily late comings
function calculateDailyLateComings($date) {
global $conn;
$lateCount = 0;

$sql = "SELECT COUNT(*) AS late_count FROM attendance WHERE DATE(clock_in) = :date AND TIME(clock_in) > '10:00:00'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':date', $date);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
$lateCount = $result['late_count'];
}

return $lateCount;
}

// Function to generate date-wise reports for the specified date range
function generateDateWiseReport($startDate, $endDate) {
global $conn;
$report = array();

// Create an array of all dates within the specified range
$allDates = [];
$currentDate = $startDate;
while ($currentDate <= $endDate) {
$allDates[] = $currentDate;
$currentDate = date('Y-m-d', strtotime($currentDate . ' + 1 day'));
}

// Query attendance data for each date and populate the report array
foreach ($allDates as $date) {
$totalAttendance = 0;
$lateComings = 0;

$sql = "SELECT COUNT(*) AS total_attendance FROM attendance WHERE DATE(clock_in) = :date";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':date', $date);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
$totalAttendance = $result['total_attendance'];
$lateComings = calculateDailyLateComings($date);
}

$report[$date] = array(
'total_attendance' => $totalAttendance,
'late_comings' => $lateComings
);
}

return $report;
}

// Function to prepare data for weekly report graph
function prepareWeeklyReportData($report) {
$dates = array_keys($report);
$totalAttendance = array();
$lateComings = array();

foreach ($dates as $date) {
$totalAttendance[] = $report[$date]['total_attendance'];
$lateComings[] = $report[$date]['late_comings'];
}

return array(
'dates' => $dates,
'total_attendance' => $totalAttendance,
'late_comings' => $lateComings
);
}

// Function to find the first attendance date
function findFirstAttendanceDate() {
global $conn;
$sql = "SELECT MIN(DATE(clock_in)) AS first_date FROM attendance";
$stmt = $conn->prepare($sql);
$stmt->execute();
return $stmt->fetchColumn();
}

// Find the first attendance date
$firstDate = findFirstAttendanceDate();

// Calculate the end date (7 days after the first attendance date)
$endDate = date('Y-m-d', strtotime($firstDate . ' + 6 days'));

// Generate date-wise report for the specified date range
$report = generateDateWiseReport($firstDate, $endDate);

// Prepare data for weekly report graph
$weeklyReportData = prepareWeeklyReportData($report);

// Handle next and previous actions
if (isset($_POST['action'])) {
$currentStartDate = $_POST['startDate'];
if ($_POST['action'] === 'next') {
$firstDate = date('Y-m-d', strtotime($currentStartDate . ' + 7 days'));
} elseif ($_POST['action'] === 'previous') {
$firstDate = date('Y-m-d', strtotime($currentStartDate . ' - 7 days'));
}
$endDate = date('Y-m-d', strtotime($firstDate . ' + 6 days'));
$report = generateDateWiseReport($firstDate, $endDate);
$weeklyReportData = prepareWeeklyReportData($report);
}
?>


<style>


.container {
max-width: 800px;
margin: 0 auto;
background-color: #fff;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
padding: 20px;
}

.button-container {
display: flex;
justify-content: space-between;
margin-bottom: 20px;
}

.button-container button {
padding: 10px;
font-size: 16px;
cursor: pointer;
border: none;
background-color: #007bff;
color: #fff;
border-radius: 4px;
transition: background-color 0.3s;
}

.button-container button:hover {
background-color: #0056b3;
}
</style>

<body>
<div class="container">
<h2 style="font-size: small;">Weekly Attendance Report (<?php echo $firstDate . ' to ' . $endDate; ?>)</h2>
<div class="button-container">
<form method="post">
    <input type="hidden" name="startDate" value="<?php echo $firstDate; ?>">
    <button type="submit" name="action" value="previous">Previous</button>
</form>
<form method="post">
    <input type="hidden" name="startDate" value="<?php echo $firstDate; ?>">
    <button type="submit" name="action" value="next">Next</button>
</form>
</div>
<canvas id="weeklyReportChart" width="800" height="400"></canvas>
</div>

<script>
// Get the canvas element
var ctx = document.getElementById('weeklyReportChart').getContext('2d');

// Prepare data for the chart
var data = {
labels: <?php echo json_encode($weeklyReportData['dates']); ?>,
datasets: [{
    label: 'Total Attendance',
    data: <?php echo json_encode($weeklyReportData['total_attendance']); ?>,
    backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgba(54, 162, 235, 1)',
    borderWidth: 1
},
{
    label: 'Late Comings',
    data: <?php echo json_encode($weeklyReportData['late_comings']); ?>,
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
    borderColor: 'rgba(255, 99, 132, 1)',
    borderWidth: 1
}]
};

// Create and display the chart
var myChart = new Chart(ctx, {
type: 'bar',
data: data,
options: {
    scales: {
        x: {
            stacked: true
        },
        y: {
            stacked: true,
            beginAtZero: true
        }
    }
}
});
</script>


            
        </div>
    </div>
</div>

<!-- Leave Taking Percentage -->

<div class="col-xl-6 d-flex">
    <div class="card flex-fill">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Leave Taking Percentage</h5>
            </div>
        </div>
        <div class="card-body">
        <?php
// Include database connection
include '../db_conn.php';

// Function to calculate percentage of leave days taken for a specific month
function calculateLeavePercentage($month, $year) {
global $conn;

// Construct the start and end date of the specified month
$startDate = date('Y-m-01', strtotime("$year-$month"));
$endDate = date('Y-m-t', strtotime("$year-$month"));

// SQL query to fetch leaves data for the specified month where status is Approved
$sql = "SELECT SUM(DATEDIFF(LEAST(`to_date`, :endDate), GREATEST(`from_date`, :startDate)) + 1) AS total_leave_days
FROM leaves
WHERE `from_date` BETWEEN :startDate AND :endDate
AND `to_date` BETWEEN :startDate AND :endDate
AND `status` = 'Approved'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':startDate', $startDate);
$stmt->bindParam(':endDate', $endDate);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Total days in the month
$totalDaysInMonth = date('t', strtotime("$year-$month"));

// Calculate leave percentage
$leavePercentage = ($result['total_leave_days'] / $totalDaysInMonth) * 100;

return $leavePercentage;
}

// Function to get leave percentages for each month of a year
function getLeavePercentagesForYear($year) {
$leavePercentages = array();
for ($month = 1; $month <= 12; $month++) {
$leavePercentage = calculateLeavePercentage($month, $year);
$leavePercentages[] = $leavePercentage;
}
return $leavePercentages;
}

// Example usage: Get leave percentages for each month of 2024
$year = 2024;
$leavePercentages = getLeavePercentagesForYear($year);

// Convert leave percentages array to JSON for use in JavaScript
$leavePercentagesJSON = json_encode($leavePercentages);
?>
<style>
body {
font-family: Arial, sans-serif;
margin: 0;
/* padding: 20px; */
background-color: #f4f4f4;
}

canvas {
background-color: #fff;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
padding: 20px;
}


</style>
<!-- </head>
<body> -->
<canvas id="leavePercentageChart" width="800" height="400"></canvas>

<script>
// Get the canvas element
var ctx = document.getElementById('leavePercentageChart').getContext('2d');

// Parse leave percentages JSON data
var leavePercentages = <?php echo $leavePercentagesJSON; ?>;

// Prepare data for the chart
var data = {
labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
datasets: [{
    label: 'Leave Percentage',
    data: leavePercentages,
    borderColor: 'rgba(75, 192, 192, 1)',
    backgroundColor: 'rgba(75, 192, 192, 0.2)',
    tension: 0.1
}]
};

// Create and display the line chart
var myChart = new Chart(ctx, {
type: 'line',
data: data,
options: {
    scales: {
        y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Leave Percentage (%)'
            }
        }
    }
}
});
</script>
        </div>
    </div>
</div>

<!-- Attendance percentage graph -->

<div class="col-xl-6 d-flex">
    <div class="card flex-fill">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Attendance Percentage</h5>
            </div>
        </div>
        <div class="card-body">

        <?php
// Include database connection
include '../db_conn.php';

// Function to calculate attendance percentage for each employee over the next 3 months
function calculateAttendancePercentage() {
global $conn;

// Get the current date
$currentDate = date('Y-m-d');

// Calculate the end date (3 months from the current date)
$endDate = date('Y-m-d', strtotime('+3 months', strtotime($currentDate)));

// Initialize an array to store attendance percentages for each employee
$attendanceData = array();

// Query to get distinct employees from the attendance table
$sql = "SELECT DISTINCT employee_id FROM attendance";
$stmt = $conn->prepare($sql);
$stmt->execute();
$employees = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Iterate through each employee
foreach ($employees as $employeeId) {
// Query to get the first clock_in date for the employee
$sql = "SELECT MIN(clock_in) AS first_clock_in FROM attendance WHERE employee_id = :employeeId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':employeeId', $employeeId);
$stmt->execute();
$firstClockInDate = $stmt->fetchColumn();

// Calculate the total number of working days (excluding Sundays) for the next 3 months
$totalWorkingDays = 0;
$currentMonth = date('Y-m', strtotime($currentDate));
$endMonth = date('Y-m', strtotime($endDate));
while ($currentMonth <= $endMonth) {
$totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($currentMonth)), date('Y', strtotime($currentMonth)));
for ($i = 1; $i <= $totalDaysInMonth; $i++) {
    $dayOfWeek = date('N', strtotime($currentMonth . '-' . $i));
    if ($dayOfWeek != 7) { // Exclude Sundays
        $totalWorkingDays++;
    }
}
$currentMonth = date('Y-m', strtotime($currentMonth . ' + 1 month'));
}

// Query to count the number of attended days for the employee within the next 3 months
$sql = "SELECT COUNT(DISTINCT DATE(clock_in)) AS attended_days FROM attendance WHERE employee_id = :employeeId AND DATE(clock_in) BETWEEN :firstClockInDate AND :endDate";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':employeeId', $employeeId);
$stmt->bindParam(':firstClockInDate', $firstClockInDate);
$stmt->bindParam(':endDate', $endDate);
$stmt->execute();
$attendedDays = $stmt->fetchColumn();

// Calculate the attendance percentage
$attendancePercentage = ($attendedDays / $totalWorkingDays) * 100;

// Query to get employee name
$sql = "SELECT first_name FROM employees WHERE emp_id = :employeeId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':employeeId', $employeeId);
$stmt->execute();
$employeeName = $stmt->fetchColumn();

// Store the attendance data for the employee
$attendanceData[] = array(
'name' => $employeeName,
'attendancePercentage' => $attendancePercentage
);
}

// Sort attendance data based on attendance percentage in descending order
usort($attendanceData, function($a, $b) {
return $b['attendancePercentage'] - $a['attendancePercentage'];
});

return $attendanceData;
}

// Function to get a subset of employee data based on the current index
function getSubsetOfEmployeeData($attendanceData, $currentIndex, $pageSize) {
$subset = array_slice($attendanceData, $currentIndex, $pageSize);
return $subset;
}

// Calculate attendance percentages for each employee
$attendanceData = calculateAttendancePercentage();

// Handle pagination
$currentIndex = isset($_GET['index']) ? intval($_GET['index']) : 0;
$pageSize = 7; // Change this to 10 if you want to display 10 employees at a time
$totalPages = ceil(count($attendanceData) / $pageSize);
$subsetData = getSubsetOfEmployeeData($attendanceData, $currentIndex, $pageSize);

// HTML and CSS for displaying the bar graph
?>
<style>
body {
font-family: Arial, sans-serif;
margin: 0;
/* padding: 20px; */
background-color: #f4f4f4;
}

canvas {
background-color: #fff;
border-radius: 8px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
padding: 20px;
}

.navigation {
margin-top: 20px;
display: flex;
justify-content: center;
}

.navigation button {
margin: 0 10px;
padding: 8px 16px;
background-color: green; /* Changed button color to green */
color: #fff;
border: none;
border-radius: 4px;
cursor: pointer;
transition: background-color 0.3s;
}

.navigation button:hover {
background-color: #0056b3;
}

.page-info {
margin-top: 10px;
text-align: center;
font-size: 14px;
}
</style>
<!-- </head>
<body> -->
<canvas id="employeeAttendanceChart" width="800" height="400"></canvas>

<div class="navigation">
<?php if ($currentIndex > 0): ?>
<a href="?index=<?= max(0, $currentIndex - $pageSize) ?>"><button id="prevBtn">&lt; Previous</button></a>
<?php endif; ?>
<?php if ($currentIndex < $totalPages - 1): ?>
<a href="?index=<?= min($currentIndex + $pageSize, count($attendanceData) - 1) ?>"><button id="nextBtn">Next &gt;</button></a>
<?php endif; ?>
</div>

<div class="page-info">
<?php
$remaining = count($attendanceData) - ($currentIndex + 1);
echo "Showing " . ($currentIndex + 1) . " - " . min($currentIndex + $pageSize, count($attendanceData)) . " of " . count($attendanceData) . " employees";
if ($remaining > 0) {
    echo " - $remaining remaining";
}
?>
</div>

<script>
var subsetData = <?php echo json_encode($subsetData); ?>;
var ctx = document.getElementById('employeeAttendanceChart').getContext('2d');

function drawChart() {
var employeeNames = subsetData.map(function(data) {
    return data.name;
});
var attendancePercentages = subsetData.map(function(data) {
    return data.attendancePercentage;
});

var data = {
    labels: employeeNames,
    datasets: [{
        label: 'Attendance Percentage',
        data: attendancePercentages,
        backgroundColor: attendancePercentages.map(function(percentage) {
            if (percentage < 75) {
                return 'rgba(255, 99, 132, 0.7)';
            } else if (percentage > 96) {
                return 'rgba(75, 192, 192, 0.7)';
            } else {
                return 'rgba(54, 162, 235, 0.7)';
            }
        }),
        borderWidth: 1
    }]
};

var myChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        indexAxis: 'y',
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Employee Name'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Attendance Percentage (%)'
                }
            }
        }
    }
});
}

drawChart();
</script>


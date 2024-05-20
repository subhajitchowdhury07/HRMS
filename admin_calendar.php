<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HRMS Calendar</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: true,
        selectable: true,
        events: <?php echo json_encode($events); ?>
      });
      calendar.render();
    });
  </script>
</head>
<body>
  <div id="calendar"></div>
  
  <?php
  // Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hrms";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Fetch events from database
  $sql = "SELECT * FROM schedules";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $events = array();
      while ($row = $result->fetch_assoc()) {
          $events[] = array(
              'title' => $row['title'],
              'start' => $row['start_datetime'],
              'end' => $row['end_datetime']
          );
      }
  } else {
      echo "0 results";
  }

  $conn->close();
  ?>
</body>
</html>

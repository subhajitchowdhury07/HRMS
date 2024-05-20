<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        #calendar {
            max-width: 800px;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .week {
            display: flex;
            border-bottom: 1px solid #ddd;
        }

        .day {
            flex: 1;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
            min-height: 80px;
            position: relative;
            border-right: 1px solid #ddd;
            overflow: hidden;
        }

        .day:last-child {
            border-right: none;
        }

        .event {
            background-color: #e0f7fa;
            padding: 5px;
            margin-bottom: 3px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div id="calendar"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendar = document.getElementById('calendar');

            // Fetch data from the server using AJAX
            fetch('get_events.php')
                .then(response => response.json())
                .then(events => {
                    // Create calendar elements
                    const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

                    let currentDay = 1;

                    while (currentDay <= daysInMonth) {
                        const weekElement = document.createElement('div');
                        weekElement.className = 'week';

                        for (let i = 0; i < 7; i++) {
                            const dayElement = document.createElement('div');
                            dayElement.className = 'day';

                            if (currentDay <= daysInMonth) {
                                dayElement.innerText = currentDay;

                                events.forEach(event => {
                                    const eventDate = new Date(event.event_date);
                                    const eventDay = eventDate.getDate();

                                    if (eventDay === currentDay) {
                                        const eventElement = document.createElement('div');
                                        eventElement.className = 'event';
                                        eventElement.innerHTML = `<strong>${event.title}</strong>`;
                                        dayElement.appendChild(eventElement);
                                    }
                                });

                                currentDay++;
                            }

                            weekElement.appendChild(dayElement);
                        }

                        calendar.appendChild(weekElement);
                    }
                })
                .catch(error => console.error('Error fetching events:', error));
        });
    </script>
</body>
</html>

<?php
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

// Fetch events from the database
$sql = "SELECT id, title, event_date FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $events = array();

    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }

    // Return events as JSON
    echo json_encode($events);
} else {
    echo "No events found";
}

$conn->close();
?>

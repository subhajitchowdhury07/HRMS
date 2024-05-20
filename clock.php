<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown Timer</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            color: #007bff;
        }

        button {
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        #countdown {
            margin-top: 20px;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Countdown Timer</h2>

    <button id="startBtn" onclick="startCountdown()">Start</button>
    <button id="stopBtn" onclick="stopCountdown()">Stop</button>
    <button id="resetBtn" onclick="resetCountdown()">Reset</button>

    <div id="countdown">--:--:--</div>

    <script>
        var countdownInterval;
        var countdownStartTime;
        var elapsedSeconds = 0;

        function startCountdown() {
            countdownStartTime = new Date();
            countdownInterval = setInterval(updateCountdown, 1000);
            document.getElementById('startBtn').disabled = true;
            document.getElementById('stopBtn').disabled = false;
        }

        function stopCountdown() {
            clearInterval(countdownInterval);
            elapsedSeconds += Math.floor((new Date() - countdownStartTime) / 1000);
            document.getElementById('startBtn').disabled = false;
            document.getElementById('stopBtn').disabled = true;

            // Store the elapsed time in the database
            storeTime(elapsedSeconds);
        }

        function resetCountdown() {
            clearInterval(countdownInterval);
            elapsedSeconds = 0;
            updateCountdown();
            document.getElementById('startBtn').disabled = false;
            document.getElementById('stopBtn').disabled = true;
        }

        function updateCountdown() {
            var currentTime = new Date();
            var totalElapsedSeconds = elapsedSeconds + Math.floor((currentTime - countdownStartTime) / 1000);

            var hours = Math.floor(totalElapsedSeconds / 3600);
            var minutes = Math.floor((totalElapsedSeconds % 3600) / 60);
            var seconds = totalElapsedSeconds % 60;

            var countdownDisplay = hours.toString().padStart(2, '0') +
                ':' + minutes.toString().padStart(2, '0') +
                ':' + seconds.toString().padStart(2, '0');

            document.getElementById('countdown').textContent = countdownDisplay;
        }

        function storeTime(elapsedSeconds) {
            // Replace '/your/server/storeTime.php' with the actual URL endpoint on your server
            fetch('/your/server/storeTime.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    elapsed_seconds: elapsedSeconds
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the server response if needed
                console.log('Time stored in the database:', data);
            })
            .catch(error => {
                console.error('Error storing time in the database:', error);
            });
        }
    </script>
</body>

</html>

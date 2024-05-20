<?php include "sidebar.php"; ?>
<style>
    .main-wrapper {
        z-index: -1;
    }
</style>

<!DOCTYPE html>
<html>
<head>
    <!-- CSS for full calendar -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
    <!-- JS for jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JS for full calendar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- Bootstrap CSS and JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        @media (min-width: 992px) {
            #calendar {
                position: fixed;
                top: 80px;
                left: 250px;
                z-index: 1000;
                overflow: auto;
                max-height: calc(100vh - 70px);
            }
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Event Entry Popup Modal -->
    <div class="modal fade" id="event_entry_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <form id="add_event_form">
                        <div class="form-group">
                            <label for="event_name">Event Name</label>
                            <input type="text" name="event_name" id="event_name" class="form-control" placeholder="Enter your event name">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="event_start_date">Event Start</label>
                                    <input type="date" name="event_start_date" id="event_start_date" class="form-control" placeholder="Event start date">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="event_end_date">Event End</label>
                                    <input type="date" name="event_end_date" id="event_end_date" class="form-control" placeholder="Event end date">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event_time">Event Time</label>
                            <input type="time" name="event_time" id="event_time" class="form-control" placeholder="Event time">
                        </div>
                        <div class="form-group">
                            <label for="event_description">Event Description</label>
                            <textarea name="event_description" id="event_description" class="form-control" rows="3" placeholder="Enter event description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="event_color">Event Color</label>
                            <input type="color" name="event_color" id="event_color" class="form-control" placeholder="Enter event color">
                        </div>
                        <div class="form-group">
    <label for="event_invitees">Invitees</label>
    <select name="event_invitees[]" id="event_invitees" class="form-control" multiple>
        <?php
        // Fetch employee details for dropdown
        $sql = "SELECT id, emp_id, first_name, last_name FROM employees";
        $stmt = $conn->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id'] . '">' . $row['first_name'] . ' ' . $row['last_name'] . " ( " . $row['emp_id'] . ")" . '</option>';
        }
        ?>
    </select>
</div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="save_event()">Save Event</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Description Popup Modal -->
    <div class="modal fade" id="eventDescriptionModal" tabindex="-1" role="dialog" aria-labelledby="eventDescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventDescriptionModalLabel">Event Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Time:</strong> <span id="eventTime"></span></p> <!-- Display event time -->
                    <p id="eventDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="delete_event()">Delete</button>
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    display_events();
});

function display_events() {
    var events = [];

    $.ajax({
        url: 'display_event.php',
        dataType: 'json',
        success: function(response) {
            var result = response.data;

            $.each(result, function(i, item) {
                events.push({
                    event_id: result[i].event_id,
                    title: result[i].title,
                    start: result[i].start,
                    end: result[i].end,
                    color: result[i].color,
                    description: result[i].description,
                    time: moment(result[i].start).format('h:mm A') // Format time using moment.js with Indian time format
                });
            });

            $('#calendar').fullCalendar({
                defaultView: 'month',
                timeZone: 'local',
                editable: true,
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    $('#event_start_date').val(moment(start).format('YYYY-MM-DD'));
                    $('#event_end_date').val(moment(end).format('YYYY-MM-DD'));
                    $('#event_entry_modal').modal('show');
                },
                events: events,
                eventClick: function(calEvent, jsEvent, view) {
                    $('#eventDescription').text(calEvent.description);
                    $('#eventTime').text(calEvent.time); // Set the event time
                    $('#eventDescriptionModal').modal('show');
                    $('#eventDescriptionModal').data('event_id', calEvent.event_id); // Save event id in modal data
                },
                dayRender: function (date, cell) {
                    var today = moment().format('YYYY-MM-DD');
                    if (date.format('YYYY-MM-DD') === today) {
                        cell.css("border-color", "blue");
                    }
                }
            });
        },
        error: function(xhr, status, error) {
            alert('Failed to load events: ' + error);
        }
    });
}

function save_event() {
    var event_name = $("#event_name").val();
    var event_start_date = $("#event_start_date").val();
    var event_end_date = $("#event_end_date").val();
    var event_time = $("#event_time").val();
    var event_description = $("#event_description").val();
    var event_color = $("#event_color").val();
    var event_invitees = $("#event_invitees").val(); // Get the selected invitees

    if (event_name === "" || event_start_date === "" || event_end_date === "" || event_time === "") {
        alert("Please enter all required details.");
        return false;
    }

    $.ajax({
        url: "save_event.php",
        type: "POST",
        dataType: 'json',
        data: {
            event_name: event_name,
            event_start_date: event_start_date,
            event_end_date: event_end_date,
            event_time: event_time,
            event_description: event_description,
            event_color: event_color,
            event_invitees: event_invitees // Send invitees to the server
        },
        success: function(response) {
            $('#event_entry_modal').modal('hide');
            if (response.status) {
                alert(response.msg);
                location.reload();
            } else {
                alert(response.msg);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + ': ' + error);
            alert('Failed to save event.');
        }
    });
    return false;
}

function delete_event() {
    var event_id = $('#eventDescriptionModal').data('event_id');

    $.ajax({
        url: "delete_event.php",
        type: "POST",
        dataType: 'json',
        data: {
            event_id: event_id
        },
        success: function(response) {
            $('#eventDescriptionModal').modal('hide');
            if (response.status) {
                alert(response.msg);
                location.reload();
            } else {
                alert(response.msg);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + ': ' + error);
            alert('Failed to delete event.');
        }
    });
    return false;
}

function accept_invitation(invitation_id) {
    $.ajax({
        url: 'accept_invitation.php',
        type: 'POST',
        dataType: 'json',
        data: { invitation_id: invitation_id },
        success: function(response) {
            if (response.status) {
                alert(response.msg);
                location.reload();
            } else {
                alert(response.msg);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + ': ' + error);
            alert('Failed to accept invitation.');
        }
    });
}
</script>
</body>
</html>

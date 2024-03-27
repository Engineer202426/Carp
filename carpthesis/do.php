<?php

include('config.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT do_value, timeday FROM dosensor";
$result = $conn->query($sql);

$MorningDOvalue = null;
$TimeMorning = "Morning";

$AfternoonDOvalue = null;
$TimeAfternoon = "Afternoon";

$NightDOvalue = null;
$TimeNight = "Night";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['timeday'] === $TimeMorning) {
            $MorningDOvalue = $row['do_value'];
        } elseif ($row['timeday'] === $TimeAfternoon) {
            $AfternoonDOvalue = $row['do_value'];
        } elseif ($row['timeday'] === $TimeNight) {
            $NightDOvalue = $row['do_value'];
        }
    }
}

$DOData = array(
    array("name" => $TimeMorning, "y" => $MorningDOvalue),
    array("name" => $TimeAfternoon, "y" => $AfternoonDOvalue),
    array("name" => $TimeNight, "y" => $NightDOvalue),
);

$chartTitle = "Daily Monitoring Average";
$axisYTitle = "Dissolved Oxygen Value";

// Close the database connection
$conn->close();


?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add jQuery library (you can download it or use CDN) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include Highcharts library -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <title>dosensor</title>
<script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "<?php echo $chartTitle; ?>"
                },
                axisY: {
                    title: "<?php echo $axisYTitle; ?>"
                },
                legend: { // Add legend
                    cursor: "pointer",
                    fontSize: 16,
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "line",
                    lineColor: "#4F81BC", // Adjust line color as needed
                    markerColor: "#4F81BC", // Adjust marker color as needed
                    markerType: "circle",
                    markerSize: 8,
                    name: "Dissolved Oxygen",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($DOData, JSON_NUMERIC_CHECK); ?>
                }]
            });

            chart.render();

            function toggleDataSeries(e) {
                if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }

        }
    </script>
<style>
        #vertnav {
            margin-bottom: 20px;
        }

        #chartContainer {
        border: 2px solid #ddd;
        border-radius: 8px;
        height: 400px; 
        width: 60%; 
        margin: auto; 
        background-color: white; 
        padding: 15px; 
    }


        .d-flex.justify-content-center {
            margin-top: 20px;
        }

        .btn-primary {
            margin: 0 10px;
        }
    </style>
</head>
<body>
<?php include('navbar.php') ?>
<div class="container-fluid">
        <div class="row">
            <?php include('navvertical.php') ?>
            
            <div class="col-md-10" id="chartContainer"></div>
            </div>
     

<div class="d-flex justify-content-center">
    <!-- Turn on DO button -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#turnDOon" style="margin: 45px;" id="turnOnButton">
        Turn on DO
    </button>

    <!-- Turn off DO button -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#turnDOoff" style="margin: 45px;" id="turnOffButton">
        Turn off DO
    </button>
</div>


<!-- Modal -->
<div class="modal fade" id="turnDOon" tabindex="-1" aria-labelledby="turnDOonLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="turnDOonLabel">Dissolved Oxygen Sensor Turned On</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // jQuery document ready function
    $(document).ready(function () {
        // Event listener for button click
        $('#turnOnButton').click(function () {
            // Make an AJAX request to upload data to the database
            $.ajax({
                type: 'POST',  // Use POST method
                url: 'individualsensorsbuttonlogic.php',  // Specify the server-side script to handle the request
                data: {
                    tableName: 'sensorcontrol',
                    columnName: 'docontrol',
                    value: 1
                },
                success: function (response) {
                    // Handle the success response (if needed)
                    console.log('Data uploaded successfully');
                },
                error: function (error) {
                    // Handle the error (if any)
                    console.error('Error uploading data:', error);
                }
            });
        });
    });
</script>


<!-- Modal -->
<div class="modal fade" id="turnDOoff" tabindex="-1" aria-labelledby="turnDOoffLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="turnDOoffLabel">Dissolved Oxygen Sensor Turned Off</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    // jQuery document ready function
    $(document).ready(function () {
        // Event listener for button click
        $('#turnOffButton').click(function () {
            // Make an AJAX request to upload data to the database
            $.ajax({
                type: 'POST',  // Use POST method
                url: 'individualsensorsbuttonlogic.php',  // Specify the server-side script to handle the request
                data: {
                    tableName: 'sensorcontrol',
                    columnName: 'docontrol',
                    value: 0
                },
                success: function (response) {
                    // Handle the success response (if needed)
                    console.log('Data uploaded successfully');
                },
                error: function (error) {
                    // Handle the error (if any)
                    console.error('Error uploading data:', error);
                }
            });
        });
    });
</script>
<script>
        
        $(function () {
            Highcharts.chart('chartContainer', {
            chart: {
                type: 'line'
            },
            title: {
                text: '<?php echo $chartTitle; ?>'
            },
            xAxis: {
                categories: ['Morning', 'Afternoon', 'Night']
            },
            yAxis: {
                title: {
                    text: '<?php echo $axisYTitle; ?>'
                }
            },
            series: [{
                name: 'Dissolved Oxygen',
                data: <?php echo json_encode($DOData, JSON_NUMERIC_CHECK); ?>
            }]
        });
    });
    </script>
</div>
</body>
</html>

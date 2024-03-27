<?php include('navbar.php') ?>
<?php

include('config.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch values from the database
$sql = "SELECT ph_value, timeday FROM phsensor";
$result = $conn->query($sql);

$Morningvalue = null;
$TimeMorning = "Morning";

$Afternoonvalue = null;
$TimeAfternoon = "Afternoon";

$Nightvalue = null;
$TimeNight = "Night";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['timeday'] === $TimeMorning) {
            $Morningvalue = $row['ph_value'];
        } elseif ($row['timeday'] === $TimeAfternoon) {
            $Afternoonvalue = $row['ph_value'];
        } elseif ($row['timeday'] === $TimeNight) {
            $Nightvalue = $row['ph_value'];
        }
    }
}

$PHData = array(
    array("y" => $Morningvalue, "label" => $TimeMorning),
    array("y" => $Afternoonvalue, "label" => $TimeAfternoon),
    array("y" => $Nightvalue, "label" => $TimeNight),
);

$chartTitle = "Daily Monitoring Average";
$axisYTitle = "PH Value";

// Close the database connection
$conn->close();

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<title>phsensor</title>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
    title: {
        text: "<?php echo $chartTitle; ?>"
    },
    axisY: {
        title: "<?php echo $axisYTitle; ?>"
    },
    data: [{
        type: "line",
        dataPoints: <?php echo json_encode($PHData, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
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
    </style>
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <!-- Vertical Navigation -->
            <?php include('navvertical.php') ?>
        
            <div class="col-md-10" id="chartContainer"></div>
        </div>

     
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<div class="d-flex justify-content-center">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#turnPHon" style="margin: 45px;" id="turnOnButton">
        Turn on PH
    </button>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#turnPHoff" style="margin: 45px;" id="turnOffButton">
        Turn off PH
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="turnPHon" tabindex="-1" aria-labelledby="turnPHonLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="turnPHonLabel">PH Sensor Turned On</h1>
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
                    columnName: 'phcontrol',
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
<div class="modal fade" id="turnPHoff" tabindex="-1" aria-labelledby="turnPHoffLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="turnPHoffLabel">PH Sensor Turned Off</h1>
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
        $('#turnOffButton').click(function () {
            // Make an AJAX request to upload data to the database
            $.ajax({
                type: 'POST',  // Use POST method
                url: 'individualsensorsbuttonlogic.php',  // Specify the server-side script to handle the request
                data: {
                    tableName: 'sensorcontrol',
                    columnName: 'phcontrol',
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
                name: 'PH LEVEL',
                data: <?php echo json_encode($PHData, JSON_NUMERIC_CHECK); ?>
            }]
        });
    });
  
</script>

</body>
</html>

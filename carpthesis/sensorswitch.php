<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DO Sensor Data</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <style>
        .chart-container {
            width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>
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

$chartTitle = "Daily Dissolved Oxygen Average";
$axisYTitle = "Dissolved Oxygen Value";


$sql = "SELECT tds_value, timeday FROM tdssensor";
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
            $Morningvalue = $row['tds_value'];
        } elseif ($row['timeday'] === $TimeAfternoon) {
            $Afternoonvalue = $row['tds_value'];
        } elseif ($row['timeday'] === $TimeNight) {
            $Nightvalue = $row['tds_value'];
        }
    }
}

$TDSData = array(
    array("y" => $Morningvalue, "label" => $TimeMorning),
    array("y" => $Afternoonvalue, "label" => $TimeAfternoon),
    array("y" => $Nightvalue, "label" => $TimeNight),
);

$chartTitle = "Daily TDS Average";
$axisYTitle = "TDS Value";

$sql = "SELECT temp_value, timeday FROM tempsensor";
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
            $Morningvalue = $row['temp_value'];
        } elseif ($row['timeday'] === $TimeAfternoon) {
            $Afternoonvalue = $row['temp_value'];
        } elseif ($row['timeday'] === $TimeNight) {
            $Nightvalue = $row['temp_value'];
        }
    }
}

$TempData = array(
    array("y" => $Morningvalue, "label" => $TimeMorning),
    array("y" => $Afternoonvalue, "label" => $TimeAfternoon),
    array("y" => $Nightvalue, "label" => $TimeNight),
);

$chartTitle = "Daily Temperature Average";
$axisYTitle = "Temperature Value";

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

$chartTitle = "Daily PH Average";
$axisYTitle = "PH Value";

$conn->close();
?>
<?php include('navbar.php') ?>
<div class="main-content">
<div class="michael">
<div class="row">
    <div class="col-lg-4">
        <fieldset>
            <legend>Dissolved Oxygen Chart</legend>
            <div id="chart1" class="chart-container"></div>
          
        </fieldset>
    </div>
    <div class="col-lg-4">
        <fieldset>
            <legend>TDS Chart</legend>
            <div id="chart2" class="chart-container"></div>
       
        </fieldset>
    </div>
    <div class="col-lg-4">
        <fieldset>
            <legend>Switch</legend>
            <div id="chart5" class="chart-container">
            <form action="controller.php" method="post">
  <?php
  // Read the content of the .txt file for DO sensor
  $doSensorStatus = file_get_contents("sensor_status.txt");
  // Define button color based on sensor status
  $doButtonColor = $doSensorStatus == "1" ? "btn-success" : "btn-danger";
  ?>
  <button type="submit" class="btn <?php echo $doButtonColor; ?>" name="toggle">DO Sensor Switch</button>
</form>
<form action="controller1.php" method="post">
  <?php
  $phSensorStatus = file_get_contents("sensor_status1.txt");
  $phButtonColor = $phSensorStatus == "1" ? "btn-success" : "btn-danger";
  ?>
  <button type="submit" class="btn <?php echo $phButtonColor; ?> mt-4" name="toggle">PH Sensor Switch</button>
</form>
<form action="controller2.php" method="post">
  <?php
  $phSensorStatus = file_get_contents("sensor_status2.txt");
  $phButtonColor = $phSensorStatus == "1" ? "btn-success" : "btn-danger";
  ?>
  <button type="submit" class="btn <?php echo $phButtonColor; ?> mt-4" name="toggle">TDS Sensor Switch</button>
</form>
<form action="controller3.php" method="post">
  <?php
  $phSensorStatus = file_get_contents("sensor_status3.txt");
  $phButtonColor = $phSensorStatus == "1" ? "btn-success" : "btn-danger";
  ?>
  <button type="submit" class="btn <?php echo $phButtonColor; ?> mt-4" name="toggle">TEMPERATURE Sensor Switch</button>
</form>

            </div>
       
        </fieldset>
    </div>
   
    </div>
    <div class="row">
    <div class="col-lg-4">
        <fieldset>
            <legend>Temperature Chart</legend>
            <div id="chart3" class="chart-container"></div>
           
        </fieldset>
    </div>
    <div class="col-lg-4">
        <fieldset>
            <legend>PH Chart</legend>
            <div id="chart4" class="chart-container"></div>
           
        </fieldset>
</div>
<div class="col-lg-4">
        <fieldset>
            <legend>Ultra sonic</legend>
            <div id="chart6" class="chart-container"></div>
           
        </fieldset>
</div>
</div>
</div>
<script>
 $(document).ready(function(){
            Highcharts.chart('chart1', {
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
        Highcharts.chart('chart2', {
            chart: {
                type: 'bar'
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
                name: 'TDS Value',
                data: <?php echo json_encode($TDSData, JSON_NUMERIC_CHECK); ?>
            }]
        });
        Highcharts.chart('chart3', {
            chart: {
                type: 'area'
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
                name: 'Temperature Value',
                data: <?php echo json_encode($TempData, JSON_NUMERIC_CHECK); ?>
            }]
        });
        Highcharts.chart('chart4', {
            chart: {
                type: 'column'
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
<style>
  .main-content {
    margin-left: 10px; 
   
}

@media screen and (max-width: 768px) {
    .main-content {
        margin-left: 0; 
    }
}
.chart-container {
    border: 1px solid #ddd; 
    padding: 10px;
    background-color: #fff; 
    margin-bottom: 20px; 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
}


.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 660px; 
    margin: 1em auto;
}

@media (max-width: 768px) {
    .main-content {
        margin-left: 0;
    }
    .chart-container {
        margin-bottom: 0;
    }
    .highcharts-figure, .highcharts-data-table table {
        min-width: 100%;
        max-width: 100%;
    }
}
.michael{
    margin-left: 30px;
}
</style>
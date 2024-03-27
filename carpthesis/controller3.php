<?php
// Filename: controller.php

$filename = 'sensor_status3.txt';

// If it's a POST request, toggle the sensor status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle'])) {
    // Read the current sensor status from the file
    $sensorStatus = file_exists($filename) ? intval(file_get_contents($filename)) : 0;
    
    // Toggle the sensor status
    $sensorStatus = $sensorStatus == 0 ? 1 : 0;
    
    // Write the new sensor status back to the file
    file_put_contents($filename, $sensorStatus);

    // Redirect back to the controller interface after toggling the sensor
    header('Location: sensorswitch.php');
    exit();
}

// For a GET request, return the current sensor status
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Read the current sensor status from the file
    $sensorStatus = file_exists($filename) ? intval(file_get_contents($filename)) : 0;
    echo $sensorStatus;
}
?>

<?php

include("config.php");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from AJAX request
$tableName = $_POST['tableName'];
$columnName = $_POST['columnName'];
$value = $_POST['value'];

// Prepare and execute the SQL statement
$sql = "UPDATE $tableName SET $columnName = $value";
$result = $conn->query($sql);

// Close the connection
$conn->close();

// Send a response back to the client (you can customize the response as needed)
if ($result) {
    echo "Data uploaded successfully";
} else {
    echo "Error uploading data";
}
?>

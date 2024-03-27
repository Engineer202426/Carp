<?php

include('config.php');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from AJAX request
$tableName = $_POST['tableName'];
$values = $_POST['values'];

// Prepare and execute the SQL statement
$sql = "UPDATE $tableName SET";
foreach ($values as $columnName => $value) {
    $sql .= " $columnName = $value,";
}
// Remove the trailing comma
$sql = rtrim($sql, ",");
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

<?php
// Include your database connection configuration
include('config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'field' and 'value' parameters are set in the POST request
    if(isset($_POST['field']) && isset($_POST['value'])) {
        // Sanitize and validate the input
        $field = $_POST['field'];
        $value = ($_POST['value'] == 1) ? 1 : 0; // Ensure value is either 0 or 1

        // Prepare and execute the SQL query to update the sensor control value in the database
        $sql = "UPDATE sensorcontrol SET $field = $value WHERE constant_id = 1"; // Assuming constant_id is always 1
        if ($conn->query($sql) === TRUE) {
            // If update successful, return success response
            echo json_encode(array("success" => true));
        } else {
            // If update fails, return error response
            echo json_encode(array("error" => "Error updating database"));
        }
    } else {
        // If 'field' or 'value' parameters are missing, return error response
        echo json_encode(array("error" => "Missing parameters"));
    }
} else {
    // If request method is not POST, return error response
    echo json_encode(array("error" => "Invalid request method"));
}

// Close the database connection
$conn->close();
?>

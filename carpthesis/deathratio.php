<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortality Rate</title>
    <?php include('config.php'); ?>

</head>
<body>
<nav>
    <?php include('navbar.php') ?>
</nav>

<div class="container mt-5">
    <h2>Insert Carp Date of Death</h2>

    <form method="post" action="">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Date Died" aria-label="Carp Death" aria-describedby="button-addon2" name="numdeath" id="numdeath" required>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Submit</button>
            </div>
        </div>
    </form>

    <?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numdeath = $_POST['numdeath'];

    $sql = "INSERT INTO `death` (`id`, `numdeath`, `datedeath`) VALUES (NULL, '$numdeath', current_timestamp());";

    if ($conn->query($sql) === TRUE) {
        echo "Date of Death data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch data from the database
$sql = "SELECT UNIX_TIMESTAMP(datedeath)*1000 AS x, numdeath AS y FROM death";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Initialize an array to store data points
    $dataPoints = array();

    // Loop through the result set and populate the dataPoints array
    while ($row = $result->fetch_assoc()) {
        $dataPoints[] = $row;
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>


</div>


<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Mortality Rate"
        },
        axisY: {
           
            
            suffix: "",
            prefix: "deaths: "
        },
        data: [{
            type: "spline",
            markerSize: 5,
            xValueFormatString: "MMM, DD,YYYY",
           
            yValueFormatString: " ,##0.##",
            xValueType: "dateTime",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });

    chart.render();
}
</script>

</head>
<body>
<div id="chartContainer" style="height: 470px; width: 95%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>                              

<!-- Add Bootstrap JS and Popper.js scripts here -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

</body>
</html>

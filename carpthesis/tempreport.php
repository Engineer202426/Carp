<?php
include('config.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$fromDate = isset($_GET['from']) ? $_GET['from'] : '';
$toDate = isset($_GET['to']) ? $_GET['to'] : '';

// Fetch data from the database based on the selected date range
if ($fromDate && $toDate) {
    $sql = "SELECT UNIX_TIMESTAMP(temp_create)*1000 as x, temp_value as y FROM tempsensor WHERE DATE(temp_create) BETWEEN '$fromDate' AND '$toDate'";
} else {
    $sql = "SELECT UNIX_TIMESTAMP(temp_create)*1000 as x, temp_value as y FROM tempsensor";
}

$result = mysqli_query($conn, $sql);

$dataPoints = array();
while ($row = mysqli_fetch_assoc($result)) {
    $dataPoints[] = $row;
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE HTML>
<html>

<head>

    <!-- Add necessary CSS and JS files for Bootstrap and datepicker -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add necessary CSS and JS files for Bootstrap datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        function filterByDate() {
            var fromDate = $('#fromDatepicker').val();
            var toDate = $('#toDatepicker').val();
            // Redirect to the same page with the selected date range as parameters
            window.location.href = '?from=' + fromDate + '&to=' + toDate;
        }

        window.onload = function () {

            // Initialize datepickers
            $('#fromDatepicker, #toDatepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                onSelect: function (dateText) {
                    filterByDate();
                }
            });

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "All Temperature sensor value"
                },
                axisY: {
                    title: "Temperature VALUE "
                },
                data: [{
                    type: "spline",
                    markerSize: 5,
                    xValueFormatString: "MMM DD, YYYY",
                    yValueFormatString: "#,##0.##",
                    xValueType: "dateTime",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });

            chart.render();
        }
    </script>
</head>

<body>
<nav>
    <?php include('navbar.php') ?>

</nav>
    
    <div class="container-fluid">
        <div class="row">
            <?php include('navverticalreport.php') ?>
            <div class="col-md-10">
                <!-- Add datepickers for filtering with Bootstrap styling -->
                <div class="input-group mb-3" style="width: 30%;">
                    <input type="text" class="form-control" id="fromDatepicker" placeholder="From Date">
                    <input type="text" class="form-control" id="toDatepicker" placeholder="To Date">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="filterByDate()">Filter by Date Range</button>
                    </div>
                </div>

                <div id="chartContainer" style="height: 470px; width: 95%;"></div>
                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

                <script>
                function filterByDate() {
                    var fromDate = $('#fromDatepicker').val();
                    var toDate = $('#toDatepicker').val();
                    // Redirect to the same page with the selected date range as parameters
                    window.location.href = '?from=' + fromDate + '&to=' + toDate;
                }
                </script>
            </div>
        </div>
    </div>
</body>

</html>

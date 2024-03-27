<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weightratio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <style>
        h2 {
            color: #1D2E28;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        button {
            background-color: #1D2E28;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php
    include('config.php');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $dataPoints = [];

    // Function to calculate sample size using Sloven's Formula
    function calculateSampleSize($populationSize, $marginOfError)
    {
        return round($populationSize / (1 + $populationSize * ($marginOfError * $marginOfError)));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["numbers"])) {
            $numbers = $_POST["numbers"];

            // Insert each individual carp weight into the database
            if (!empty($numbers)) {
                $numberArray = explode(",", $numbers);
                $numberArray = array_map("trim", $numberArray);
                $numberArray = array_filter($numberArray, "is_numeric");

                if (!empty($numberArray)) {
                    $total = array_sum($numberArray);
                    $average = $total / count($numberArray);

                    // Insert individual carp weights into the database
                    foreach ($numberArray as $weight) {
                        $sql = "INSERT INTO weight (carpweight) VALUES ($weight)";

                        if ($conn->query($sql) !== TRUE) {
                            echo "<p class='text-danger'>Error uploading data to the database: " . $conn->error . "</p>";
                            exit();
                        }
                    }

                    echo "<p class='text-success'>The average is: $average grams. Data uploaded to the database successfully.</p>";
                } else {
                    echo "<p class='text-danger'>Please enter valid numeric values.</p>";
                }
            } else {
                echo "<p class='text-danger'>Please enter a list of numbers.</p>";
            }
        } elseif (isset($_POST["populationSize"]) && isset($_POST["marginOfError"])) {
            // Calculate sample size using Sloven's Formula
            $populationSize = $_POST["populationSize"];
            $marginOfError = $_POST["marginOfError"];

            if (is_numeric($populationSize) && is_numeric($marginOfError) && $marginOfError > 0) {
                $sampleSize = calculateSampleSize($populationSize, $marginOfError);

                echo "<p class='text-success'>Required Sample Size: $sampleSize</p>";

                // Display input fields for individual weights
                echo "<form method='post' action='#'>";
                echo "<div class='form-group' id='inputFields'>";
                for ($i = 0; $i < $sampleSize; $i++) {
                    echo "<label for='individualWeight_$i'>Enter weight for carp " . ($i + 1) . " (in grams):</label>";
                    echo "<input type='text' name='individualWeight[]' id='individualWeight_$i' class='form-control' required>";
                }
                echo "</div>";
                echo "<button type='submit' class='btn btn-primary' style='background-color: #1D2E28;'>Submit Individual Weights</button>";
                echo "</form>";
            } else {
                echo "<p class='text-danger'>Please enter valid numeric values.</p>";
            }
        }
    }

    // Fetch data from the database and calculate monthly averages
    $sql = "SELECT DATE_FORMAT(date_taken, '%M') AS month, AVG(carpweight) AS avg_weight FROM weight GROUP BY MONTH(date_taken) ORDER BY MONTH(date_taken)";
    $result = $conn->query($sql);

    if ($result) {
        $dataPoints = [];
        while ($row = $result->fetch_assoc()) {
            $month = $row['month'];
            $averageWeight = $row['avg_weight'];

            // Create data point for the chart
            $dataPoints[] = array("label" => $month, "y" => $averageWeight);
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>

    <div class="container mt-5">
        <h2>Slovin's Formula Calculator</h2>

        <form id="sampleSizeForm" method="post" action="#">
            <div class="form-group">
                <label for="populationSize">Enter Population Size:</label>
                <input type="number" id="populationSize" name="populationSize" placeholder="Enter population size"
                    required>
            </div>

            <div class="form-group">
                <label for="marginOfError">Enter Margin of Error (as a fraction, e.g., 0.05):</label>
                <input type="number" step="0.01" id="marginOfError" name="marginOfError"
                    placeholder="Enter margin of error" required>
            </div>

            <button type="button" onclick="calculateSampleSize()" class='btn btn-primary' style='background-color: #1D2E28;'>Calculate Sample Size</button>
        </form>

        <p id="result"></p>
    </div>

    <div class="container">
        <h2>Weight</h2>
        <form method="post" action="#">
            <div class="form-group">
                <label for="numbers">Enter the weight of each carp (comma-separated in grams):</label>
                <input type="text" name="numbers" id="numbers" class="form-control" required
                    style="margin-bottom: 25px;">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #1D2E28;">Calculate Average</button>
        </form>
    </div>

    <div class="container">
        <h2>Carp Weight Chart</h2>
        <div id="chartContainer" style="height: 470px; width: 100%;"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Carp Weight"
                },
                axisX: {
                    title: "Month"
                },
                axisY: {
                    title: "Average Weight (grams)"
                },
                data: [{
                    type: "column",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });

            chart.render();
        });

        function calculateSampleSize() {
            var populationSize = document.getElementById("populationSize").value;
            var marginOfError = document.getElementById("marginOfError").value;

            if (isNaN(populationSize) || isNaN(marginOfError) || marginOfError <= 0) {
                document.getElementById("result").innerHTML = "Please enter valid numeric values.";
                return;
            }

            var sampleSize = Math.round(populationSize / (1 + populationSize * (marginOfError * marginOfError)));
            document.getElementById("result").innerHTML = "Required Sample Size: " + sampleSize;

            // Display input fields for individual weights
            var inputFields = document.getElementById("inputFields");
            inputFields.innerHTML = "";
            for (var i = 0; i < sampleSize; i++) {
                var label = document.createElement("label");
                label.setAttribute("for", "individualWeight_" + i);
                label.innerHTML = "Enter weight for carp " + (i + 1) + " (in grams):";

                var input = document.createElement("input");
                input.setAttribute("type", "text");
                input.setAttribute("name", "individualWeight[]");
                input.setAttribute("id", "individualWeight_" + i);
                input.setAttribute("class", "form-control");
                input.setAttribute("required", "");

                inputFields.appendChild(label);
                inputFields.appendChild(input);
            }
        }
    </script>

</body>

</html>

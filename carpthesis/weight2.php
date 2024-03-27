<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Percentage Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        input {
            padding: 10px;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        p {
            font-size: 18px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h2>Percentage Calculator</h2>

    <label for="numberInput">Enter a number:</label>
    <input type="number" id="numberInput" placeholder="Enter a number">

    <button onclick="calculatePercentage()">Calculate 65%</button>

    <p id="result"></p>

    <script>
        function calculatePercentage() {
            // Get the input value
            var inputValue = document.getElementById("numberInput").value;

            // Check if the input is a valid number
            if (!isNaN(inputValue)) {
                // Calculate 65% of the input value
                var result = inputValue * 0.65;

                // Display the result
                document.getElementById("result").innerHTML = "65% of " + inputValue + " is: " + result;
            } else {
                // Display an error message if the input is not a valid number
                document.getElementById("result").innerHTML = "Please enter a valid number.";
            }
        }
    </script>

</body>
</html>

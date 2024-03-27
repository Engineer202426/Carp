<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add jQuery library (you can download it or use CDN) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <?php   include('config.php'); ?>
</head>
<body>
    <?php include('navbar.php'); ?>
 <span>

 <div class="btn-group" style="margin: 45px; padding-left: 35px;">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#turnSENSORSon"
        id="turnOnButton">Turn on DO</button>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#turnSENSORSoff"
        id="turnOffButton" style="margin-left: 20px;">Turn off DO</button>
</div>


<!-- Modal -->
<div class="modal fade" id="turnSENSORSon" tabindex="-1" aria-labelledby="turnSENSORSonLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="turnSENSORSonLabel">All Sensor Turned On</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="turnSENSORSoff" tabindex="-1" aria-labelledby="turnSENSORSoffLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="turnSENSORSoffLabel">All Sensor Turned Off</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</span>   
<script>
    // jQuery document ready function
    $(document).ready(function () {
        // Event listener for button click
        $('#turnOnButton').click(function () {
            // Make an AJAX request to upload data to the database
            $.ajax({
                type: 'POST',  // Use POST method
                url: 'sensorsbuttoncontrollogic.php',  // Specify the server-side script to handle the request
                data: {
                    tableName: 'sensorcontrol',
                    values: {
                        docontrol: 1,
                        tdscontrol: 1,
                        tempcontrol: 1,
                        phcontrol: 1
                    }
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

<script>
    // jQuery document ready function
    $(document).ready(function () {
        // Event listener for button click
        $('#turnOffButton').click(function () {
            // Make an AJAX request to upload data to the database
            $.ajax({
                type: 'POST',  // Use POST method
                url: 'sensorsbuttoncontrollogic.php',  // Specify the server-side script to handle the request
                data: {
                    tableName: 'sensorcontrol',
                    values: {
                        docontrol: 0,
                        tdscontrol: 0,
                        tempcontrol: 0,
                        phcontrol: 0
                    }
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

</body>
</html>
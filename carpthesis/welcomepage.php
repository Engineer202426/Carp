
<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARPAKAN</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* This is added to prevent scrollbars caused by video */
        }

        #video-background {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
        }

        #overlay-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-size: 24px;
            z-index: 1; /* Ensure it's above the other layers */
        }

        #overlay-text p {
            position: relative;
            display: inline-block;
        }

        #overlay-text p::before,
        #overlay-text p::after {
            content: "";
            position: absolute;
            display: inline-block;
            height: 100%;
            width: 50%;
            background: linear-gradient(to right, transparent, #1D2E28);
            z-index: -1;
        }

        #overlay-text p::before {
            left: 0;
            transform-origin: 100% 50%;
            transform: skewY(-45deg);
        }

        #overlay-text p::after {
            right: 0;
            transform-origin: 0 50%;
            transform: skewY(45deg);
        }
    </style>
</head>

<body>
    <?php include('navbar.php') ?>

    <video autoplay muted loop id="video-background">
        <source src="pics/welcome1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div id="overlay-text">
        <p>SUSTAINABLE IOT-BASED SMART AQUACULTURE THROUGH REMOTE 
        <br>SENSING AND CONTROL  FOR CARP FISH IN A 
        <br>SMALL-SCALE FISHERIES</p>
    </div>

    <!-- Your content goes here -->
</body>

</html>

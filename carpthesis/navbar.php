<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>CARPAKAN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyAe1WgBi0vdfBZlZ2IeWJmMzUf4W6oX"
        crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        nav {
            background-color:#1D2E28;
            border: none;
            box-shadow: none;
        }

        .navbar-brand h1 {
            color: white;
            margin: 0;
        }

        .navbar-toggler-icon {
            background-color: white;
        }

        .navbar-nav {
            display: flex;
            justify-content: space-between;
        }

        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .navbar-nav .nav-item a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            background-color: transparent;
            opacity: 0.8;
            padding: 6px 8px; /* Adjusted padding for smaller size */
    font-size: 12px; /* Adjusted font size for smaller size */
       
            border-radius: 5px;
        }

        .navbar-nav .nav-item a:hover {
            opacity: 1;
            color: #ffc107;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .profile-btn {
            position: relative;
        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }

        .profile-dropdown {
            position: absolute;
            top: 60px;
            right: 0;
            display: none;
            background-color: #1D2E28;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
        }

        .profile-dropdown a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .profile-dropdown a:hover {
            background-color: #f8f9fa;
        }

        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-bottom: 10px;
            overflow: hidden;
            object-fit: cover;
        }

        .profile-btn:hover .profile-dropdown {
            display: block;
        }

        .navbar-nav .nav-item.profile-btn .btn-light {
            background-color: transparent;
            color: white;
            border: none;
            opacity: 0.8;
        }

        .navbar-nav .nav-item.profile-btn {
            margin-left: 500px; /* Adjust the margin as needed */
        }

        .navbar-nav .nav-item.profile-btn .btn-light:hover {
            opacity: 1;
        }

        .navbar-nav .nav-item:nth-last-child(2) {
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="welcomepage.php"><h1>CARPAKAN</h1></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-light" href="sensorswitch.php" role="button">Sensor Switch</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light" href="doreport.php" role="button">Data Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light" href="weight.php" role="button">Weight Ratio</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light" href="deathratio.php" role="button">Mortality Rate</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item profile-btn">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="profileDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="pics/carpakan44.png" alt="User Image" class="profile-image"
                                    onerror="this.onerror=null;this.src='path-to-default-avatar.png';">
                            </button>
                            <div class="dropdown-menu profile-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="aboutus.php">About us</a>
                                <a class="dropdown-item logout-btn" href="index.php">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <hr>

    <!-- Your page content goes here -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-d4NfFbBDwUjcl6JLlZq9L7PirZZFd9PGqDz5nFOWsGclgCt4cc3faK4KNC5bPpGm"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyAe1WgBi0vdfBZlZ2IeWJmMzUf4W6oX"
        crossorigin="anonymous"></script>
</body>

</html>




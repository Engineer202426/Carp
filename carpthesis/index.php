
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./login.css">
    <link rel="shortcut icon" href="./img/l1.gif" type="image/x-icon">
    <?php include('config.php'); 
    
        $error_message = '';

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $enteredUsername = $_POST["username"];
            $enteredPassword = $_POST["password"];

            $sql = "SELECT * FROM account WHERE username = '$enteredUsername' AND password = '$enteredPassword'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Authentication successful
                header("Location: welcomepage.php");
                exit();
            } else {
                // Authentication failed
                $error_message = "Login failed. Please check your username and password.";
            }
        }
        $conn->close();     
    ?>
</head>

<body>
    <div class="login-container">
        <div class="left-section">
            <div class="login-logo">
                <img src="./pics/carpakan44.png" alt="Logo" width="400">
                <h2>Carpthesis</h2>
            </div>
        </div>

        <div class="right-section">
            <form method="post" action="index.php">
                <div class="mb-3">
                    <label for="username" class="form-label color-text">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label color-text">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="error-message"><?php echo $error_message; ?></div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.login-container {
    display: flex;
    width: 70%;
    height: 500px;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px #000;
    overflow: hidden;
}

.left-section {
    flex: 1;
    padding: 20px;
    text-align: center;
    border-right: 4px solid #228B22; 
    background-color:#228B22; 
    color: #fff; 
}

.right-section {
    flex: 1;
    padding: 20px;
    margin-top: 150px;
}

.login-logo {
    margin-bottom: 20px;
}

.form-label {
    font-weight: bold;
}

.form-control {
    width: 70%; 
    margin-right: auto;
    margin-left: auto;
}

.btn-primary {
    width: 20%; 
    margin-left: 200px;
    background-color: #228B22; 
    color: #bf9b30; 
    border: 1px solid #bf9b30;
}

.btn-primary:hover {
    background-color: #bf9b30;
    color: black; 
}

h2 {
    font-family: 'Great Vibes', cursive;
    font-size: 3em;
    margin: 20px 0;
    color: #bf9b30; 
}
</style>
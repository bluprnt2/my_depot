<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . "/APIClient.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    APIClient::login($_POST['username'], $_POST['password']);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if (APIClient::isLoggedIn()) {
        header("Location: index.php");
    } else {
        $error = "Your Login Name or Password is invalid";


        die($error);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--With this we connect CSS and HTML-->
        <link rel = "stylesheet" type = "text/css" href="bin/style.css"/>
        <!--With this we connect font-awesome.css and index.html-->
        <link rel = "stylesheet" type = "text/css" href ="bin/font-awesome.css">
    </head>
    <body id="login-form-body">
        <div class = "login-container" style="height:auto;">
            <img src ="bin/images/RowanSeal.png"/>
            <form id="login-form" action="login.php" method="post">
                <div class="form-input">
                    <input type="text" name="username" placeholder="Enter Username">
                </div>
                <div class ="form-input">
                    <input type="password" name="password" placeholder="Enter Password">
                </div>
                <input type="submit" name="submit" value="LOGIN" class="btn-login">
                <button type="submit" formaction="index.php">BACK</button>
                <!-- <input type="reset" name="back" value="BACK" class="btn-login" formaction="index.php"> -->
            </form><br>
            <p>Login Form powered by <a class="footer-text" href="http://www.rowan.edu/home/">Rowan University </a></p>
        </div>
    </body>
</html>

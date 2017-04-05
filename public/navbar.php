<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__."/APIClient.php");
    echo '
        <a class="w3-bar-item w3-button" href="index.php">Home</a>
        <a class="w3-bar-item w3-button" href="calendar.php">Calendar</a>
    ';

    if(APIClient::isLoggedIn()) {
        echo '
            <a class="w3-bar-item w3-button" href="logout.php">Logout</a>
        ';
        if(APIClient::isAdmin()){

        }
    } else{
        echo '
            <a class="w3-bar-item w3-button" href="login.php">Login</a>
            <a class="w3-bar-item w3-button" href="survey.php">Fill a Survey</a>
        ';
    }
?>

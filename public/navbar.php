<?php
    require_once("../APIClient.php");
    echo '
        <a class="w3-bar-item w3-button" href="index.php">Home</a>
        <a class="w3-bar-item w3-button" href="#">About</a>
        <a class="w3-bar-item w3-button" href="#">Schedule</a>
        <a class="w3-bar-item w3-button" href="feedbackform.php">Feedback</a>
        <a class="w3-bar-item w3-button" href="http://rowan.edu">Rowan Home</a>
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
        ';
    }
?>

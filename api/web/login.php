<?php
    require("APIClient.php");

    APIClient::login('admin', '12345');
    if(APIClient::isLoggedIn())
        echo "Logged in successfully";
    else echo "Invalide user credentials...";
?>

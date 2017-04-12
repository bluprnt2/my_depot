<?php
    define('__ROOT__',dirname(dirname(__FILE__)));
    require(__ROOT__."/APIClient.php");

    APIClient::login('admin', '12345');
    if(APIClient::isLoggedIn())
        echo "Logged in successfully";
    else echo "Invalide user credentials...";
?>

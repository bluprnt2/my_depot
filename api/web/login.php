<?php
    require("APIClient.php");

    $params = array();
    $params['username'] = 'sample_user';
    $params['password'] = password_hash('12345', PASSWORD_BCRYPT);

    echo APIClient::APICall("http://localhost:8080/login.php", $params);
?>

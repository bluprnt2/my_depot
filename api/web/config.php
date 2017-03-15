<?php
    $token_request = "grant_type=client_credentials";
    $client_name = "testclient";
    $client_password = "testpass";
    $server = 'http://' . $_SERVER['SERVER_NAME'] . ':';
    $web_url = $server . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
    $api_url = $server . "8080" . "/api.php";
?>

<?php

    require_once('server.php');

    $global_request = OAuth2\Request::createFromGlobals();

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    }

    echo json_encode(array(
        'success' => true,
        'token' => $_POST['access_token'],
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ));

?>

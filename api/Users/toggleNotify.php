<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Users.php');
    require_once('../Auth.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        if($_POST['userid'] == checkLogin($_POST['access_token'], $oauthsql)) {
            echo json_encode(
                toggleNotify($_POST['userid'], $tutorsql)
            );
        }
    }
?>
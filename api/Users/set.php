<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Users.php');
    require_once('../Auth.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        $userid = checkLogin($_POST['access_token'], $oauthsql);
        if($userid != NULL && (checkAdmin($userid, $tutorsql) || $_POST['user_id'] == $userid)) {
            echo json_encode(setUser(
                $userid,
                $_POST['username'],
                $_POST['firstName'],
                $_POST['lastName'],
                $_POST['password'],
                $_POST['admin'],
                $_POST['notify'],
                $tutorsql
            ));
        }
    }
?>

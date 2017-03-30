<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Announcements.php');
    require_once('../Auth.php');
    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        $userid = checkLogin($_POST['access_token'], $oauthsql);
        if($userid != NULL && checkAdmin($userid, $tutorsql)) {
            echo json_encode(removeFile(
                $userid,
                $_POST['courseID'],
                $_POST['fileName'],
                $tutorsql
            ));
        }
    }
?>
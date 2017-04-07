<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Auth.php');
    require_once('../Logs.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        $userid = checkLogin($_POST['access_token'], $oauthsql);
        if($userid != NULL && $_POST['userID'] != NULL && $_POST['courseID'] != NULL) {
            echo json_encode(
                addLog(
                    $_POST['userID'],
                    $_POST['courseID'],
                    $_POST['comments'],
                    $tutorsql
                )
            );
        } else {
            echo json_encode(array(
                'success' => false
            ));
        }
    }
?>

<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Auth.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        echo json_encode(array(
            'token' => $_POST['access_token'],
            'logged_in' => $id = checkLogin($_POST['access_token'], $oauthsql),
            'admin' => checkAdmin($id, $tutorsql)
        ));
    }

?>

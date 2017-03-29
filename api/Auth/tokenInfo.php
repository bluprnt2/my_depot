<?php
    define('__ROOT__', dirname(dirname(dirname(__FILE__))));
    require_once(__ROOT__ . '/api/oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once(__ROOT__ . '/api/server.php');
    require_once(__ROOT__ . '/api/Auth.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        echo json_encode(array(
            'token' => $_POST['access_token'],
            'logged_in' => $id = checkLogin($_POST['access_token'], $oauthsql),
            'userID' => $id,
            'admin' => checkAdmin($id, $tutorsql)
        ));
    }

?>

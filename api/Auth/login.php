<?php
    define('__ROOT__', dirname(dirname(dirname(__FILE__))));
    date_default_timezone_set("UTC");
    require_once(__ROOT__.'/api/oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once(__ROOT__.'/api/server.php');
    require_once(__ROOT__.'/api/Auth.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
	echo $server->getResponse();
        die;
    } else {
        if(checkPassword($_POST['username'], $_POST['password'], $tutorsql, $oauthsql)) {
            echo json_encode(array(
                'success' => true
            ));
        } else {
            echo json_encode(array(
                'success' => false
            ));
        }
    }

?>

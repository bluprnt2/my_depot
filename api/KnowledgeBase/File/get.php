<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../KnowledgeBase.php');
    require_once('../Auth.php');
    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
	//should parameter be var char or int?
	//I think it should be var char because we want the name of the file.
        echo json_encode(getFile((string) $_POST['fileName'], $tutorsql));
    }
?>
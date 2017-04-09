<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Locations.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        echo json_encode(getLocs(
            $_POST['locID'],
            $_POST['buildingName'],
            $_POST['roomNumber'],
            $tutorsql));
    }

?>

<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../PunchCards.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        //Checks if user is checked-in in the last 12 hours
        echo json_encode(
            getCheckedIn(
                $_POST['userID'],
                $tutorsql
            )
        );
    }
?>

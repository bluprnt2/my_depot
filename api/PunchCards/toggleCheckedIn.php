<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Auth.php');
    require_once('../PunchCards.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        $userid = checkLogin($_POST['access_token'], $oauthsql);
        //Spec assumes that anyone can checkin for anyone else based on honor system
        if($userid != NULL) {
            echo json_encode(
                //adds punchcard toggling last checkin in the last 12 hours, if none just marks as true
                toggleCheckedIn(
                    $_POST['userID'],  //Means close to nothing now that I think about it, since people can share the computer...
                    $tutorsql
                )
            );
        }
    }
?>

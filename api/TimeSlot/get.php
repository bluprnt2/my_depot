<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../TimeSlots.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        echo json_encode(
            getTimeSlots(
                $_POST['starttime'],
                $_POST['endtime'],
                $_POST['deptID'],
                $_POST['locID'],
                $_POST['courseID'], 
                $tutorsql)
            );
    }
?>

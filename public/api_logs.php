<?php
    require_once("../APIClient.php");

    if(APIClient::isAdmin()) {
        $logs = APIClient::getLogs(null, null, null, null, null);

        foreach($logs as $l) {
            echo $l->getTimeStamp() . "<br />";
        }
    }
?>

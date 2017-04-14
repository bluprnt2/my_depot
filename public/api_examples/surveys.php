<?php
    require_once("../../APIClient.php");
    $srvys = APIClient::getSurveys(null,null, null, null, null);
    var_dump($srvys);
?>

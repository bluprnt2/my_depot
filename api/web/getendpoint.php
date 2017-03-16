<?php
    require("APIClient.php");
    echo APIClient::getCall("http://localhost:8080/getendpoint.php");
?>

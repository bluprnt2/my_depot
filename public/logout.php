<?php
    require_once("../APIClient.php");

    APIClient::logout();
    header("Location: index.php");
?>

<?php
date_default_timezone_set("UTC");

    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');

    $server->handleTokenRequest($global_request)->send();
?>

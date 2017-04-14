<?php
    define('__ROOT__',dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once(__ROOT__.'/server.php');

    $server->handleTokenRequest($global_request)->send();
?>

<?php
    //Replace username, password & location depending on configuration (Please don't push any passwords to the public git repository...)

    require_once('./oauth2-server-php/src/OAuth2/Autoloader.php');
    $dsn      = 'mysql:dbname=oauthtables;host=localhost';
    $username = 'root';
    $password = '';
    //require_once("server.php");
    Oauth2\Autoloader::register();

    $storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
    // Pass a storage object or array of storage objects to the OAuth2 server class
    $server = new OAuth2\Server($storage);

    // Add the "Client Credentials" grant type (it is the simplest of the grant types)
    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));
?>

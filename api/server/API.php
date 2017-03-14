<?php
    //I was able to get an access token returned by:
    // make databse through mysql using OAuth.sql file
    // run in mysql: INSERT INTO oauth_clients (client_id, client_secret, redirect_uri) VALUES ("testclient", "testpass", "http://fake/");
    // replace username, password & location depending on configuration
    // run: php -S localhost:8080
    // run: curl -u testclient:testpass http://localhost:8080/api.php -d 'grant_type=client_credentials'
    // Should return something like this: {"access_token":"8bb16dc4838e2e43a7cf9fe72bbbc4df8b96f4d8","expires_in":3600,"token_type":"Bearer","scope":null}

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
    $server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
?>

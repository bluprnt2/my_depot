<?php
    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once(__ROOT__.'/api/oauth2-server-php/src/OAuth2/Autoloader.php');

    //namespace API;
    //Replace password depending on configuration (Please don't push any passwords to the public git repository...)
    date_default_timezone_set("UTC");

    $host     = 'ec2-52-55-181-20.compute-1.amazonaws.com';
    $dbname   = "oauthtables";
    //$dsn      = 'mysql:dbname=oauthtables;host=ec2-52-55-181-20.compute-1.amazonaws.com';
    $dsn      = 'mysql:dbname=' . $dbname . ';host=' . $host;
    $username = 'tutoradmin';
    $password = '';
    Oauth2\Autoloader::register();

    $storage = new OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
    // Pass a storage object or array of storage objects to the OAuth2 server class
    $server = new OAuth2\Server($storage);

    // Add the "Client Credentials" grant type (it is the simplest of the grant types)
    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

    $tutorsql = new mysqli($host, $username, $password, "tutoroauthapi");
    $oauthsql = new mysqli($host, $username, $password, $dbname);

    $global_request = OAuth2\Request::createFromGlobals();
?>

<?php
    require("config.php");

    $curl = curl_init();
    $params = array();
    $params['client_id'] = $client_name;
    $params['client_secret'] = $client_password;
    $params['grant_type'] = 'client_credentials';
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
    //echo $api_url . "\n";
    echo "Response: " . curl_exec($curl);
?>

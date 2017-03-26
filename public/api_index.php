<?php
    require("../APIClient.php");

    $params = array();
    $params['amount'] = 1;
    //echo APIClient::APICall("/Announcements/get.php", $params);

    echo "Logged in: " . ((APIClient::isLoggedIn()) ? 'true' : 'false') . "<br />";
    echo "Admin privileges: " . ((APIClient::isAdmin()) ? 'true' : 'false');
?>

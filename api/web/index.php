<?php
    require("APIClient.php");
    echo "Logged in: " . ((APIClient::isLoggedIn()) ? 'true' : 'false') . "<br />";
    echo "Admin privileges: " . ((APIClient::isAdmin()) ? 'true' : 'false');
?>

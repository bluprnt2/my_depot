<?php
    require("../../APIClient.php");

    $logged_in = APIClient::isLoggedIn();
    echo "Logged in: " . ($logged_in ? 'true' : 'false') . "<br />";
    if ($logged_in) echo "Username: " . APIClient::getCurrentUser()->getUsername() . "<br />";
    echo "Admin privileges: " . ((APIClient::isAdmin()) ? 'true' : 'false');
?>

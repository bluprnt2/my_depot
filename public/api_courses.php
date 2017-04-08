<?php
    require_once("../APIClient.php");

    $courses = APIClient::getCourses(null, null);

    foreach($courses as $c) {
        echo 'Name: ' . $c->getName() . '<br />' . '<br />';
    }
?>

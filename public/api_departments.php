<?php
    require_once("../APIClient.php");

    if(APIClient::isAdmin()) {
        $dept = new Department(null, "Test Department - " . uniqid());
        APIClient::addDepartment($dept);
    }

    $departments = APIClient::getDepartments(null);

    foreach($departments as $d) {
        echo 'Name: ' . $d->getName() . '<br />' . '<br />';
    }
?>

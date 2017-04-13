<?php
    require_once("../../APIClient.php");


    if(APIClient::isAdmin()) {
        $course = new Course(
            null,
            "Course - " . uniqid(),
            1
        );
        APIClient::addCourse($course);
    }

    $courses = APIClient::getCourses(null, null);

    foreach($courses as $c) {
        echo 'Name: ' . $c->getName() . '<br />' . '<br />';
    }
?>

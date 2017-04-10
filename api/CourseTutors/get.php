<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../CourseTutors.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        echo json_encode(
            getCourseTutors($_POST['course_id'], $_POST['tutor_id'], $tutorsql)
        );
    }
?>

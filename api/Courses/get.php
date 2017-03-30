<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Courses.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        if ($_POST['courseID'] != NULL){ //Most exact
            echo json_encode(
                getCourseByID($_POST['courseID'], $tutorsql)
            );
        } else if ($_POST['deptID'] != NULL){ //Less exact
            echo json_encode(
                getCoursesByDepartment($_POST['deptID'], $tutorsql)
            );
        } else { //Literally all
            echo json_encode(
                getCourses($tutorsql)
            );
        }
    }
?>


<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Users.php');
    require_once('../Surveys.php');

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        echo json_encode(addSurvey(
            $_POST['courseID'],
            $_POST['tutorID'],
            $_POST['rating'],
            $_POST['title'],
            $_POST['comment'],
            $tutorsql
        ));
    }
?>


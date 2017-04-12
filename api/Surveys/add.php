<<<<<<< HEAD
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

=======
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
>>>>>>> refs/remotes/origin/master

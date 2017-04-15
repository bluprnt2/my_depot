<?php
    require_once("../../APIClient.php");

    //You need to be logged in for the files to be returned at all
    $already_logged_in = APIClient::isLoggedIn();
    if(!$already_logged_in) {
        APIClient::login("admin", "12345");
        if(APIClient::isLoggedIn()) {
            echo "Logged In!";
        } else {
            echo "Login failed...";
        }
    }

    $files = APIClient::getFiles(null, null, null);

    foreach($files as $f) {
        echo "ID: " . $f->getID() . "<br />";
        echo "Course: " . APIClient::getCourses($f->getCourseID(), null)[0]->getName() . "<br />";
        echo "User: " . APIClient::getUser($f->getUserID())->getUserName() . "<br />";
        echo "FileName: " . $f->getFilename() . "<br /><br />";
    }
?>

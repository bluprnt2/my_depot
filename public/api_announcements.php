<?php
    require_once("../APIClient.php");

    if(APIClient::isAdmin()) {
        $announcement = new Announcement(
            null,
            "Announcement - " . uniqid(),
            "Lorem im stuff",
            null,
            null
        );
        APIClient::addAnnouncement($announcement);
    } else echo "You need to login as an administrator to add an announcement <br /><br/>";
    //prints out 5 of the most recent announcements
    $announcements = APIClient::getAnnouncements(5);
    foreach($announcements as $item) {
        echo    'Title:      ' . $item->getTitle() . '<br />' .
                'Content:    ' . $item->getContent() . '<br />' .
                'Posted by:  ' . $item->getUser()->getUsername() . '<br />' .
                'Department: ' . $item->getDepartmentID() . '<br />' .
                'Timestamp:  ' . $item->getTimestamp() . '<br /> <br />';
    }
?>

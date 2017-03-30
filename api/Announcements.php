<?php
    //Not tested
    function addAnnouncement($userid, $title, $content, $deptID, $tutorserver) {
        $query = "INSERT INTO Announcements (userID, title, content, deptID) VALUES (?, ?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('issi', $userid, $title, $content, $deptID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Tested
    function getAnnouncements($num, $tutorserver) {
        $query = "SELECT * FROM Announcements ORDER BY tStamp DESC LIMIT ?";

        $announcements = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $num);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $announcements[] = $a;
            }
            $stmnt->close();
            return $announcements;
        }
    }
?>

<?php
    function addUser($userid, $title, $content, $deptID, $tutorserver) {
        $query = "INSERT INTO Users (userName, firstName, lastName, saltHash, admin) VALUES (?, ?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('issi', $userid, $title, $content, $deptID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    function getUser($userid, $tutorserver) {
        $query = "SELECT * FROM Users WHERE userID=?";

        $user = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $userid);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $user[] = $a;
            }
            $stmnt->close();
            return $user;
        }
    }

    function getUserNotify($userid, $tutorserver) {
        $user = getUser($userid, $tutorserver);

        return (boolean) $user['notify'];
    }

    function toggleUserNotify($userid, $tutorserver) {
        $new_notify = !getUserNotify($userid, $tutorserver);
        $query = "UPDATE Users SET notify=? WHERE userID=?";

        $user = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $new_notify, $userid);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

<?php
    //Not Tested
    function addUser($username, $firstName, $lastName, $password, $admin, $notify, $tutorserver) {
        $saltHash = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO Users (userName, firstName, lastName, saltHash, admin, notify) VALUES (?, ?, ?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ssssii',
                $username,
                $firstName,
                $lastName,
                $saltHash,
                $admin,
                $notify
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Tested
    function getUser($userid, $tutorserver) {
        $query = "SELECT userName, firstName, lastName, admin, notify FROM Users WHERE ID=?";

        $user = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $userid);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            $user = $result->fetch_assoc();
            $stmnt->close();
            return $user;
        }
    }

    //Not Tested
    function setUser($userid, $username, $firstName, $lastName, $password, $admin, $notify, $tutorserver) {
        if ($password != NULL)
            $saltHash = password_hash($password, PASSWORD_BCRYPT); //Will be null if no new password
        //Coalesce makes sure null values are just ignored on the update
        $query = "UPDATE Users SET
            userName =COALESCE(?, userName),
            firstName=COALESCE(?, firstName),
            lastName =COALESCE(?, lastName),
            saltHash =COALESCE(?, saltHash),
            admin    =COALESCE(?, admin),
            notify   =COALESCE(?, notify)
        WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ssssiii',
                $username,
                $firstName,
                $lastName,
                $saltHash,
                $admin,
                $notify,
                $userid
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

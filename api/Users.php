<?php
    require_once 'passwordLib.php';
    //Not Tested
    function addUser($username, $firstName, $lastName, $password, $admin, $notify, $email, $tutorserver) {
        $saltHash = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO Users (userName, firstName, lastName, saltHash, admin, notify, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ssssiis',
                $username,
                $firstName,
                $lastName,
                $saltHash,
                $admin,
                $notify,
                $email
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Tested
    function getUsers($userid, $tutorserver) {
        $query = "SELECT ID, userName, firstName, lastName, admin, notify, email FROM Users WHERE ID=COALESCE(?, ID)";

        $users = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $userid);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($u = $result->fetch_assoc()) {
                $users[] = $u;
            }
            $stmnt->close();
            return $users;
        }
    }

    //Not Tested
    function setUser($userid, $username, $firstName, $lastName, $password, $admin, $notify, $email, $tutorserver) {
        if ($password != NULL)
            $saltHash = password_hash($password, PASSWORD_BCRYPT); //Will be null if no new password
        //Coalesce makes sure null values are just ignored on the update
        $query = "UPDATE Users SET
            userName =COALESCE(?, userName),
            firstName=COALESCE(?, firstName),
            lastName =COALESCE(?, lastName),
            saltHash =COALESCE(?, saltHash),
            admin    =COALESCE(?, admin),
            notify   =COALESCE(?, notify),
            email    =COALESCE(?, email)
        WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ssssiisi',
                $username,
                $firstName,
                $lastName,
                $saltHash,
                $admin,
                $notify,
                $email,
                $userid
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

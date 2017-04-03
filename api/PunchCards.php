<?php
    function getPunchCards($punchcard_id, $user_id, $checkedIn, $startTime, $endTime, $tutorserver){
        $query = "SELECT * FROM PunchCards WHERE
            ID=COALESCE(?, ID) AND
            userID=COALESCE(?, userID) AND
            checkedIn=COALESCE(?, checkedIn) AND
            tStamp BETWEEN COALESCE(?, tStamp) AND COALESCE(?, tStamp)";

        $punchcards = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiss', $punchcard_id, $user_id, $checkedIn, $startTime, $endTime);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $punchcards[] = $a;
            }
            $stmnt->close();
            return $punchcards;
        }
    }

    function getCheckedIn($user_id, $tutorserver) {
        $query = "SELECT checkedIn FROM PunchCards WHERE
            userID=? ORDER BY tStamp DESC LIMIT 1
            WHERE tStamp BETWEEN DATE_SUB(NOW(), INTERVAL 12 HOUR) AND NOW()";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $user_id);
            $stmnt->bind_result($checkedIn);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->fetch();
            $stmnt->close();
            if($checkedIn != null) {
                return $checkedIn;
            } else {
                return false;
            }
        }
    }

    function toggleCheckedIn($user_id, $tutorserver) {
        $checkingIn = !getCheckedIn();

        $query="INSERT INTO PunchCards(userID, checkedIn) VALUES (?, ?)"


        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $user_id, $checkingIn);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }


?>

<?php
    function getLogs($startTime, $endTime) {
        $query = "SELECT * FROM Logs WHERE tStamp BETWEEN COALESCE(?, tStamp) AND COALESCE(?, tStamp)";

        $logs = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ss', $startTime, $endTime);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $logs[] = $a;
            }
            $stmnt->close();
            return $logs;
        }
    }

    function addLog($user_id, $course_id, $comments) {
        $query = "INSERT INTO Logs (userID, courseID, comments) VALUES (?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iis', $user_id, $course_id, $comments);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

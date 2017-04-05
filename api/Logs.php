<?php
    //Not Tested
    function addLog($courseID, $comments, $tutorserver) {
        $query = "INSERT INTO Courses (userID, courseID, comments) VALUES (?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iis',
                $userID,
                $courseID,
                $comments
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function getCourses($id, $courseID, $userID, $startTime, $endTime, $tutorserver) {
        $query = "SELECT * FROM Courses WHERE
            ID=COALESCE(?, ID) AND
            courseID=COALESCE(?, courseID) AND
            userID=COALESCE(?, userID) AND
            tStamp BETWEEN COALESCE(?, tStamp) AND COALESCE(?, NOW())";

        $logs = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiss', $id, $courseID, $userID, $startTime, $endTime);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $logs[] = $a;
            }
            $stmnt->close();
            return $logs;
        }
    }

?>

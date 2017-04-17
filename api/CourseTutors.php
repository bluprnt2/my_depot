<?php
    //Not Tested
    function getCourseTutors($courseID, $tutorID, $tutorserver) {
        $query = "SELECT * FROM CourseTutors WHERE courseID=COALESCE(?, courseID) AND userID=COALESCE(?, userID)";

        $tutorids = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $courseID, $tutorID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $tutorids[] = $a;
            }
            $stmnt->close();
            return $tutorids;
        }
    }

    //Not Tested
    function addCourseTutors($courseID, $tutorID, $tutorserver) {
        $query = "INSERT INTO CourseTutors (courseID, userID) VALUES (?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $courseID, $tutorID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function delCourseTutors($courseID, $tutorID, $tutorserver) {
        $query = "DELETE FROM CourseTutors WHERE courseID=? AND userID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $courseID, $tutorID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

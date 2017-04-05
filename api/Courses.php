<?php

    function addCourse($courseName, $deptID, $tutorserver) {
        $query = "INSERT INTO Courses (courseName, deptID) VALUES (?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('si',
                $courseName,
                $deptID
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function getCourses($id, $deptID, $tutorserver) {
        $query = "SELECT * FROM Courses WHERE ID=COALESCE(?, ID) AND deptID=COALESCE(?, deptID)";

        $courses = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $id, $deptID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $courses[] = $a;
            }
            $stmnt->close();
            return $courses;
        }
    }

?>

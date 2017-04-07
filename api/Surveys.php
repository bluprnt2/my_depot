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
<?php

    function addCourse($courseName, $deptID, $tutorserver) {
        $query = "INSERT INTO Courses (courseName, deptID) VALUES (?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ss',
                $courseName,
                $deptID
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function getCourses($tutorserver) {
        $query = "SELECT * FROM Courses";

        $courses = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $courses[] = $a;
            }
            $stmnt->close();
            return $courses;
        }
    }

    //Not Tested
    function getCourseByID($id, $tutorserver) {
        $query = "SELECT * FROM Courses WHERE ID=?";

        $course = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $id);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            $course = $result->fetch_assoc();
            $stmnt->close();
            return $course;
        }

    }

    //Not Tested
    function getCoursesByDepartment($dept_id, $tutorserver) {
        $query = "SELECT * FROM Courses WHERE deptID=?";

        $courses = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $dept_id);
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

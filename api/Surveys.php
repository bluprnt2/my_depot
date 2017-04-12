<<<<<<< HEAD
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
=======
<?php

    function addSurvey($courseID, $tutorID, $rating, $title, $comment, $tutorserver) {
        $query = "INSERT INTO Surveys (courseID, tutorID, rating, title, comment) VALUES (?, ?, ?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiss',
                $courseID,
                $tutorID,
                $rating,
                $title,
                $comment
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function getSurvey($surveyID, $courseID, $tutorID, $rating, $viewed, $tutorserver) {
        $query = "SELECT * FROM Surveys WHERE
            ID=COALESCE(?, ID) AND
            courseID=COALESCE(?, courseID) AND
            tutorID=COALESCE(?, tutorID) AND
            rating=COALESCE(?, rating) AND
            viewed=COALESCE(?, viewed)";

        $surveys = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiii', $surveyID, $courseID, $tutorID, $rating, $viewed);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $surveys[] = $a;
            }
            $stmnt->close();
            return $surveys;
        }
    }

    //Not Tested
    function viewSurvey($surveyID, $tutorserver) {
        $query = "UPDATE Surveys SET viewed='1' WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiss',
                $surveyID,
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

?>
>>>>>>> refs/remotes/origin/master

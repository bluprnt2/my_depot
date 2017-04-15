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
    function getSurveys($surveyID, $courseID, $tutorID, $rating, $viewed, $tutorserver) {
        $query = "SELECT * FROM Surveys WHERE
            ID=COALESCE(?, ID) AND
            ((courseID IS NULL AND ? IS NULL) OR courseID=COALESCE(?, courseID)) AND
            ((tutorID IS NULL AND ? IS NULL) OR tutorID=COALESCE(?, tutorID)) AND
            rating=COALESCE(?, rating) AND
            viewed=COALESCE(?, viewed)";

        $surveys = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiiiii', $surveyID, $courseID, $courseID, $tutorID, $tutorID, $rating, $viewed);
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
                $surveyID
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

?>

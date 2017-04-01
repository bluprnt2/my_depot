<?php
    //Not Tested
    function addTutorTimeSlot($timeslotID, $tutorID) {
        $query = "INSERT INTO TutorTimeSlots (userID, tSlotID) VALUES (?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $tutorID, $timeslotID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function delTutorTimeslot($timeslotID, $tutorID) {
        $query = "DELETE FROM TutorTimeSlots WHERE userID=? AND tSlotID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $tutorID, $timeslotID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function getTutorTimeslots($timeslotID, $tutorID, $tutorserver) {
        $query = "SELECT * FROM TutorTimeSlots WHERE tSlotID=COALESCE(?, tSlotID) AND userID=COALESCE(?, userID)";

        $tutorids = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ii', $timeslotID, $tutorID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $tutorids[] = $a;
            }
            $stmnt->close();
            return $tutorids;
        }
    }
?>

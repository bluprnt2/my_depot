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
    function getTutorIDs($timeslotID) {
        $query = "SELECT userID FROM TutorTimeSlots WHERE tSlotID=?";

        $tutorids = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $timeslotID);
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
    function getTimeSlotIDs($tutorID) {
        $query = "SELECT tSlotID FROM TutorTimeSlots WHERE userID=?";

        $timeslotids = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $tutorID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $timeslotids[] = $a;
            }
            $stmnt->close();
            return $timeslotids;
        }
    }
?>

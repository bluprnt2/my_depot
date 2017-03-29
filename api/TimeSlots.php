<?php
    //Not Tested
    function addTimeSlot($locID, $deptID, $courseID, $startTime, $endTime) {
        $query = "INSERT INTO TimeSlots (locID, deptID, courseID, startTime, endTime) VALUES (?, ?, ?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiss', $locID, $deptID, $courseID, $startTime, $endTime);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function getTimeSlots($locID, $deptID, $courseID, $startTime, $endTime){
        $query = "SELECT * FROM TimeSlots WHERE locID=? AND deptID=? AND courseID=? AND startTime=? AND endTime=?";

        $timeslots = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiss', $locID, $deptID, $courseID, $startTime, $endTime);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $timeslots[] = $a;
            }
            $stmnt->close();
            return $timeslots;
        }
    }

    //Not Tested
    function setTimeSlot($timeslotID, $locID, $deptID, $courseID, $startTime, $endTime){
        $query = "UPDATE TimeSlots SET locID=?, deptID=?, courseID=?, startTime=?, endTime=? WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiissi', $locID, $deptID, $courseID, $startTime, $endTime, $timeslotID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function delTimeslot($timeslotID) {
        $query = "DELETE FROM TimeSlots WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $timeslotID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

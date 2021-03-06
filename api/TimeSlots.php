<?php
    //Not Tested
    function addTimeSlot($locID, $deptID, $courseID, $startTime, $endTime, $tutorserver) {
        $query = "INSERT INTO TimeSlots (locID, deptID, courseID, startTime, endTime) VALUES (?, ?, ?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiss', $locID, $deptID, $courseID, $startTime, $endTime);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function getTimeSlots($tSlotID, $locID, $deptID, $courseID, $startTime, $endTime, $tutorserver){
        $query = "SELECT * FROM TimeSlots WHERE
            ID=COALESCE(?, ID) AND
            locID=COALESCE(?, locID) AND
            deptID=COALESCE(?, deptID) AND
            ((courseID IS NULL AND ? IS NULL) OR courseID=COALESCE(?, courseID)) AND

            ((startTime BETWEEN COALESCE(?, startTime) AND COALESCE(?, startTime))
            OR (endTime BETWEEN COALESCE(?, endTime) AND COALESCE(?, endTime)))";

        $timeslots = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiiissss',
                $tSlotID, $locID, $deptID, $courseID, $courseID,
                $startTime, $endTime, $startTime, $endTime
            );
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
    function delTimeslot($timeslotID, $tutorserver) {
        $query = "DELETE FROM TimeSlots WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $timeslotID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

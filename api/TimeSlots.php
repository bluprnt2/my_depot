<?php
    function addTimeSlot($locID, $deptID, $courseID, $startTime, $endTime) {
        $query = "INSERT INTO Announcements (locID, deptID, courseID, startTime, endTime) VALUES (?, ?, ?, ?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iiiss', $locID, $deptID, $courseID, $startTime, $endTime);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    function getTimeSlots($locID, $deptID, $courseID, $startTime, $endTime){

    }
?>

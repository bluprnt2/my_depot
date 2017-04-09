<?php
    //Not Tested
    function addLoc($buildingName, $roomNumber, $tutorserver) {
        $query = "INSERT INTO Locations (buildingName, roomNumber) VALUES (?, ?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('ss', $buildingName, $roomNumber);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    //Not Tested
    function getLocs($locID, $buildingName, $roomNumber, $tutorserver){
        $query = "SELECT * FROM Locations WHERE
            ID=COALESCE(?, ID) AND
            buildingName=COALESCE(?, buildingName) AND
            roomNumber=COALESCE(?, roomNumber)";
        $locations = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('iss', $locID, $buildingName, $roomNumber);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $locations[] = $a;
            }
            $stmnt->close();
            return $locations;
        }
    }

    //Not Tested
    function delLoc($locID, $tutorserver) {
        $query = "DELETE FROM Locations WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $locID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

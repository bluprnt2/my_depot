<?php
    function addDepartment($deptName, $tutorserver) {
        $query = "INSERT INTO Departments (deptName) VALUES (?)";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('s', $deptName);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }

    function getDepartments($deptID, $tutorserver) {
        $query = "SELECT * FROM Departments WHERE ID=COALESCE(?, ID)";

        $departments = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $deptID);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $departments[] = $a;
            }
            $stmnt->close();
            return $departments;
        }
    }

    function delDepartment($id, $tutorserver) {
        $query = "DELETE FROM Departments WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i',
                $id
            );
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        }
    }
?>

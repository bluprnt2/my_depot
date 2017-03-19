<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');

    function getAnnouncements($num, $tutorserver) {
        $query = "SELECT * FROM Announcements ORDER BY tSlot DESC LIMIT ?";
        
        $announcements = array();
        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('i', $num);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $result = $stmnt->get_result();
            while($a = $result->fetch_assoc()) {
                $announcements[] = $a;
            }
            $stmnt->close();
            return $announcements;
        }
    }

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        echo json_encode(getAnnouncements((int) $_POST['amount'], $tutorsql));
    }

?>

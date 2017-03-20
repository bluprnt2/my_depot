<?php
date_default_timezone_set("UTC");

    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');

    function checkLogin($token, $oauthserver) {
        $query = "SELECT user_id FROM oauth_access_tokens WHERE access_token=?";

        if($stmnt = $oauthserver->prepare($query)) {
            $stmnt->bind_param('s', $token);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->bind_result($id);
            $stmnt->fetch();
            $stmnt->close();
            if($id != null) {
                return $id;
            } else {
                return false;
            }
        } else {
            echo "Mysql Error!";
        }
    }

    function checkAdmin($userid, $tutorserver) {
        $query = "SELECT admin FROM Users WHERE ID=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('s', $userid);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->bind_result($admin);
            $stmnt->fetch();
            $stmnt->close();
            return $admin;
        } else {
            echo "Mysql Error!";
        }
    }

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        echo json_encode(array(
            'token' => $_POST['access_token'],
            'logged_in' => $id = checkLogin($_POST['access_token'], $oauthsql),
            'admin' => checkAdmin($id, $tutorsql)
        ));
    }

?>

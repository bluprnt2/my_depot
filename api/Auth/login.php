<?php
    date_default_timezone_set("UTC");

    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');

    function checkPassword($uname, $pword, $tutorserver, $oauthserver) {
        $query = "SELECT saltHash, ID, admin FROM Users WHERE userName=?";

        if($stmnt = $tutorserver->prepare($query)) {
            $stmnt->bind_param('s', $uname);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->bind_result($sh, $id, $admin_priv);
            $stmnt->fetch();
            $stmnt->close();
            if(password_verify($pword, $sh)) {
                setLoggedIn((int)$id, $oauthserver);
                return true;
            } else {
                return false;
            }
        } else {
            echo "Mysql Error!";
        }
    }

    function setLoggedIn($userid, $server) {
        $query = "UPDATE oauth_access_tokens SET user_id=?, expires=expires WHERE access_token=?";

        if($stmnt = $server->prepare($query)) {
            $stmnt->bind_param('is', $userid, $_POST['access_token']);
            $stmnt->execute() or trigger_error($stmt->error, E_USER_ERROR);
            $stmnt->close();
        } else {
            echo "Mysql Error!";
        }
    }

    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
        if(checkPassword($_POST['username'], $_POST['password'], $tutorsql, $oauthsql)) {
            echo json_encode(array(
                'success' => true
            ));
        } else {
            echo json_encode(array(
                'success' => false
            ));
        }
    }

?>

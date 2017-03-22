<?php
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
?>

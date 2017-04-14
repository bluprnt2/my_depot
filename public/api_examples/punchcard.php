<?php
    require_once("../../APIClient.php");

    //var_dump(APIClient::getCheckedIn(1));
    if(APIClient::getCheckedIn(1)) echo "Admin checked-in";
    else echo "Admin away";

    echo "<br /><br />";

    if(APIClient::isLoggedIn()) {
        APIClient::toggleCheckedIn(1);

        if(APIClient::isAdmin()) {
            $punchcards = APIClient::getPunchCards(null, null, null, null, null);

            foreach($punchcards as $p) {
                echo "User: " . APIClient::getUser($p->getUserID())->getUsername() . "<br />" .
                     "CheckedIn: " . ($p->getCheckedIn() ? 'true' : 'false') . "<br />" .
                     "Timestamp: " . $p->getTimeStamp() . "<br /> <br />";
            }
        }
    }
?>

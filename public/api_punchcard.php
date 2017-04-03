<?php
    require_once("../APIClient.php");

    //var_dump(APIClient::getCheckedIn(1));
    if(APIClient::getCheckedIn(1)) echo "Admin checked-in";
    else echo "Admin away";
?>

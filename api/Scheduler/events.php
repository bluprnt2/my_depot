
<?php
    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../Auth.php');
	require_once('API/get.php');
    if (!$server->verifyResourceRequest($global_request)) 
	{
        $server->getResponse()->send();
        die;
    } else 
	{
		$userid = checkLogin($_POST['access_token'], $oauthsql);
        if($userid != NULL) 
		{
			echo json_encode(
				get.getTimeSlots(
                $_POST['tSlotID'],
                $_POST['locID'],
                NULL,
                NULL,
                $_POST['starttime'],
                $_POST['endtime'],
				$tutorsql
				)
			);
		}
	}
?>
<?php
    date_default_timezone_set("UTC");

    require_once('../oauth2-server-php/src/OAuth2/Autoloader.php');
    require_once('../server.php');
    require_once('../EmailService.php');
    require_once('../server.php');
    if (!$server->verifyResourceRequest($global_request)) {
        $server->getResponse()->send();
        die;
    } else {
	$subject = 'New Feedback Available!';
	$message = 'Please check the feedback center of the website for more details!';
	$recipients = $_POST['emails'];
	print_r(notify($recipients, $subject, $message));
    }
?>

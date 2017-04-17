<?php

require_once 'php-aws-ses/vendor/autoload.php';


function notify($recipients, $subject, $message) {
	$host_email = 'bakert0@students.rowan.edu';
	
	$m = new SimpleEmailServiceMessage();
	$m->addBCC($recipients);
        $m->addTo($host_email);
	$m->setFrom($host_email);
	$m->setSubject($subject);
	$m->setMessageFromString($message);

	$ses = new SimpleEmailService('KEY', 'SECRET_KEY');
	return $ses->sendEmail($m);
}

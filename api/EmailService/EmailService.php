<?php

require_once '../php-aws-ses/vendor/autoload.php';
require_once 
$m = new SimpleEmailServiceMessage();
$m->addTo('bakert0@students.rowan.edu');
$m->setFrom('bakert0@students.rowan.edu');
$m->setSubject('Hello, world!');
$m->setMessageFromString('This is the message body.');

$ses = new SimpleEmailService('AKIAIBHU7KWO4XMBG44A', 'v2NDJ133kFgJRyuSk3G+cIGapQShPb3VzHvT5C+z');
print_r($ses->sendEmail($m));

// Successful response should print something similar to:
//Array(
//     [MessageId] => 0000012dc5e4b4c0-b2c566ad-dcd0-4d23-bea5-f40da774033c-000000
//     [RequestId] => 4953a96e-29d4-11e0-8907-21df9ed6ffe3
//)

<?php
define('DB_SERVER', 'ec2-52-55-181-20.compute-1.amazonaws.com');
define('DB_USERNAME', 'tutoradmin');
define('DB_PASSWORD', '314Pip3R');
define('DB_DATABASE', 'test');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) or die("Error connecting to database");
?>
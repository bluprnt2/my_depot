<?php
$servername = "ec2-52-55-181-20.compute-1.amazonaws.com";
$username = "tutoradmin";
$password = "314Pip3R";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
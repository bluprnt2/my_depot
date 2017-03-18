<?php
// get values passed from login.php file
include('login.php');
 $username = $_POST['username'];
 $password = $_POST['password'];
 
 //to prevent mysql injection
 $username = stripclashes($username);
 $password = stripclashes($password);
 $username = mysql_real_escape_string($username);
 $password = mysql_real_escape_string($password);
 
 //connect to the server and select database(this is subjected to change)
 mysql_connect("localhost", "root", "");
 mysql_select_db("login");
 
 // query the database for user
 $result = mysql_query("select * from users where username = '$username'  and password = '$password'")
         or die("FAILED TO LOGIN, CLICK ON FORGOT PASSWORD FOR HELP".mysql_error());
 
 $row =  mysql_fetch_array($result);
 if( $row['username'] ==  $username && $row['password'] == $password) {
     if($row['admin'] == 1){ 
         //subjected to changes.Should actually go to admin page
        echo "Login successful. Welcome Admin!";
     }
     else{
         //subjected to changes.Should actually go to tutor page
        echo "Login successful. Welcome Tutor!";
     }
 }
 else {
     echo "Failed to login. Try again or click forgot password.";
 }
 ?>

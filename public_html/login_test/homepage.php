<?php
include("config.php");
session_start();
?>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
</head>
<body>

<div class="w3-bar w3-border w3-light-grey">
    <?php
    if (isset($_SESSION['username'])) {
        //$_SESSION['username'] is logged in

        //if user is admin, show admin nav bar

        //else show tutor nav bar
        include 'menu_tutor.php';
    } else {
        //no one is logged in, show basic nav bar
        include 'menu_basic.php';
    }
    ?>
</div>

<div class="w3-container">
    <?php include 'home.php'; ?>
</div>

<div class="footer">
    <?php include 'footer.php'; ?>
</div>

</body>
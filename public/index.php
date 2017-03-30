<?php
    require_once("../APIClient.php");
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
        include("navbar.php");
    ?>
</div>

<div class="w3-container">
    <?php include 'feedbackform.php'; ?>
</div>

<div class="footer">
    <?php include 'footer.php'; ?>
</div>

</body>

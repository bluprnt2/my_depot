<?php
session_start();

//JS console output for testing
//echo "<script>console.log('');</script>";

echo "<script>console.log('destroying session');</script>";
session_destroy();
header("Location: homepage.php");
?>
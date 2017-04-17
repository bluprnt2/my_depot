<?php
require_once("../APIClient.php");


//NEW NAVBAR DESIGN
//
//1 Home
//2 About
//3 Schedule
//4 Feedback
//
//--- Add Spacing ---
//5 Logbook
//6 Reports
//7 Register
//8 Shared Knowledgebase
//
//
//
//--- Float Right ---
//9  Rowan Home
//10 Login/Logout

$basic_bar = '<div id="basic-bar">'
        . '<a class="w3-bar-item w3-button" href="index.php">Home</a>'
        . '<a class="w3-bar-item w3-button" href="#">About</a>'
        . '<a class="w3-bar-item w3-button" href="scheduler.php">Schedule</a>'
        . '<a class="w3-bar-item w3-button" href="feedbackform.php">Feedback</a>'
        . '</div>';



$login_rowan = '<div id="login-rowan-bar">'
        . '<a class="w3-bar-item w3-button" href="http://rowan.edu">Rowan Home</a>';



if (APIClient::isLoggedIn()) {
    $tutor_bar = '<div id="tutor-bar">'
            . '<a class="w3-bar-item w3-button" href="logbook.php">Logbook</a>'
            . '<a class="w3-bar-item w3-button" href="knowledge_base.php">Shared Knowledgebase</a>'
            . '<a class= "w3-bar-item w3-button" href="settings.php">Settings</a>'
            . '</div>';
    $login_rowan = $login_rowan . '<a class="w3-bar-item w3-button" href="logout.php">Logout</a>';

    if (APIClient::isAdmin()) {
        $admin_bar = '<div id="admin-bar">'
                . '<a class="w3-bar-item w3-button" href="report.php">Reports</a>'
                . '<a class= "w3-bar-item w3-button" href="register.php">Register</a>'
                . '</div>';
    } else {
        $admin_bar = '';
    }
} else {
    $login_rowan = $login_rowan . '<a class="w3-bar-item w3-button" href="login.php">Login</a>';
    $admin_bar = '';
}
$login_rowan = $login_rowan . '</div>';
?>

<div style="height: 10px" class="w3-container w3-yellow"> </div>
<div id="navbar" class="w3-bar w3-border w3-light-grey w3-large">
<?php
echo $basic_bar . $tutor_bar . $admin_bar . $login_rowan;
?>
</div>

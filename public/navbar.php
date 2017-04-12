<?php
    require_once("../APIClient.php");
    
    echo '
           <div class="w3-container w3-yellow">
                <br>
           </div>
            
           ';
    echo '
        <a class="w3-bar-item w3-button" href="index.php">Home</a>
        <a class="w3-bar-item w3-button" href="#">About</a>
        <a class="w3-bar-item w3-button" href="scheduler.php">Schedule</a>
        <a class="w3-bar-item w3-button" href="feedbackform.php">Feedback</a>
        <a class="w3-bar-item w3-button" href="http://rowan.edu">Rowan Home</a>
    ';

    if(APIClient::isLoggedIn()) {
        if(APIClient::isAdmin()){
            echo '
                <a class="w3-bar-item w3-button" href="report.php">Reports</a>  
                <a class= "w3-bar-item w3-button" href="register.php">Register</a>
            ';
        }
        echo '
            <a class="w3-bar-item w3-button" href="knowledge_base.php">Shared Knowledgebase</a>
			<a class="w3-bar-item w3-button" href="logbook.php">Logbook</a>
            <a class="w3-bar-item w3-button" href="logout.php">Logout</a>
        ';

    } else{
        echo '
            <a class="w3-bar-item w3-button" href="login.php">Login</a>            
        ';
    }
?>

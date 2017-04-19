<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
require_once("../APIClient.php");
$title = "About Drop-in Tutor Application";
include("header.php");
?>



<?php
include("navbar.php");
?>

<div class="w3-container w3-brown">
    <h1 class="">About this application...</h1>
</div>
<div class="w3-container">


    <div id="about-info" class="w3-panel w3-amber">
        <h3>Students</h3>
        <p>All university students have basic access to the application. From
            the home page, they can view the schedule of all drop-in tutoring sessions
            being offered campus wide. Students can also leave some feedback via the 
            feedback form page. </p>
        <h3>Tutors</h3>
        <p>Drop-in tutors will find this application useful for logging daily sessions
            as they take place. There is also a shared knowledge base available for
            passing back and forth any resources that one may find useful in providing
            assistance to any students.</p>
        <h3>Administrators</h3>
        <p>Registered administrators have access to a reporting feature to 
            produce detailed reports on the all sessions which have taken place. They 
            may also perform any necessary maintenance to the site via the Settings page.
        </p><br>        
        <p><strong>Front-end developers: </strong>Bryan Nunez, Jeremiah Caban, Eric Carpizo, 
            Aanchal Chaturvedi and Huy Ly. </p>
        <p><strong>Back-end developers: </strong>Chris Mariani, Tim Baker</p>
    </div>
</div>

<div class="w3-container">
    <?php include("footer.php"); ?>
</div>

</body>
</html>
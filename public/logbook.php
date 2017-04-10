<?php
	require_once("../APIClient.php"); 
	
	$title = "Session Logging";
    	include("header.php"); 
	if(!APIClient::isLoggedIn())
	{
		
		//header("Location: /public/index.php"); /* Redirect browser */
		echo '<p><a href="index.php">Redirect</a></p>';
		exit();
	}
    ?>
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
	<!--link rel = "stylesheet" href = "bin/style.css"-->
	  
        <!--Yellow bar -->
    <div class="w3-container w3-yellow">
       <p></p>  
    </div>
        <!--add nav bar -->
    <div class="w3-container">
        
    </div>
     <!-- search box -->   
    <div class="w3-bar w3-border w3-light-grey">
     <div>
    <?php
    include("navbar.php"); 
    ?>
    <input class="w3-input w3-border " type="text" placeholder="Search Rowan" style="width:15%" >
    </div>
    <!-- Brown bar with heading-->    
    <div class="w3-container w3-brown">
    <h2>Session Logging - Drop In Tutoring Services</h2>
    </div>
    <img src ="bin/images/background.jpg" alt = "Background" style="width:100%">
    <div id = "main" class = "w3-display-container w3-display-middle w3-light-grey" 
          style ="height:400px; width:600px;margin-top:150px;margin:0 auto;text-align: center; border-radius: 10px; border-color: solid brown">
         <form class = "w3-container" method = "POST">
             <h2><b>Tutor Check-In</b></h2>
    <!------------------------ Code for the two drop down menus- Courses, Tutors------------------------------>
   
	<p style = "font-size: 80%"> Select a Course 
	<select name="Course"> 
	 <!--option value = "" disabled selected> Choose a course </option>-->
         <?php
              $courses = APIClient::getCourses(null,null,null);
              foreach($courses as $a){
		echo "<option value = ".$a->getID().">". $a->getName() ."</option>";
                }
         
	?>
        </select><br>
        </p>
	<p style = "font-size: 80%"> Tutor
	<select name="Tutor"> 
	<?php
	
              $tutors = APIClient::getUser(null);
	        foreach($tutors as $t) {
                echo "<option value = ".$t->getUserID().">". $t->getUsername() ."</option>";
	       }
		
         ?>     
        </select><br>
	 </p>
	<p style = "font-size: 80%">
	    
	    <textarea name="Comment" style = "width: 50%; height: 80%">Additional Comments</textarea><br>
            
        </p>
	<input type ="submit" value = " Log Session " class = "w3-btn w3-brown", name = "submit">
	<?php
	
	require_once("../APIClient.php");
	if(isset($_POST['submit']))
	{
	$Tutor = $_POST["Tutor"];
	$Course = $_POST["Course"];
	 $log = new Log( 
		null,
		$Tutor,
		$Course,
		$_POST["Comment"],
		null
	);
		 APIClient::addLog($log);
	}

	?>
        <input type="reset" value = " Clear Form " class = "w3-btn w3-brown">
	</form>
	</div>
	
    <?php
    	include("footer.php"); 
	?>
	</body>
	</html>
	
	
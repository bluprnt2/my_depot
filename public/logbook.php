
	
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
    <h1></h1>
    <h2>Session Logging - Drop In Tutoring Services</h2>
    </div>
    <img src ="background.jpg" alt = "Background" style="width:100%">
    <!--<div class="w3-display-topright"> <img src="RowanSeal.jpg" style="width:40%"> </div>-->
            
     <div class = "w3-display-container w3-display-middle w3-light-grey" 
          style ="height:400px; width:500px;margin-top:150px;margin:0 auto;text-align: center; border-radius: 10px; border-color: solid brown">
         <form>
             <h2>Tutor Check-In</h2>
        <p>
            <input class="w3-checkbox" type="checkbox" name = "tutor" value = "tutor1">
	    <label>Tutor1</label>
            <input class="w3-checkbox" type="checkbox" name = "tutor" value = "tutor2">
            <label>Tutor2</label>
	     <?php
	     if ($_POST['tutor'] == 'tutor1')
	     {
		
	     }
	
		if ($_POST['tutor'] == 'tutor2')
	     {
		
	     }
	    ?>
        </p>
       
        <p> Select a course
            <select name="Course"> 
         <?php
              $courses = APIClient::getCourses(null,null,null);
              foreach($courses as $a){
		echo "<option value = \""."$a->getID()"."\">". $a->getName() ."</option>";
                //echo "<option>". $a->getName() ."</option>";
              }
         
	?>
        </select>
        </p>
        <p> Tutor
            <select name="Tutor"> 
         <?php
	
              $tutors = APIClient::getUser(null);
	      //$selectedTutor = array( );
              foreach($tutors as $t) {
                echo "<option value = \""."0"."\">". $t->getUsername() ."</option>";
	       }
		
         ?>
     
        </select>
        </p>

      
        <input type ="submit" value = " Log Session " class = "w3-btn w3-brown", name = "submit">
	<?php
	
	require_once("../APIClient.php");
	if(isset($_POST['submit']))
	{
	$Tutor = $_POST['Tutor'];
	$Course = $_POST['Course'];
	 $log = new Log(
		null,
		$Tutor,
		//APIClient::getUser($Tutor->getUserName())->getUserID(),
		// does not work APIClient::getCourse($Course->getID()),
		$Course,
		null,
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
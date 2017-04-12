<?php
	$title = "Register";
	include("header.php");
?>
   <!--Yellow bar -->
    <div class="w3-container w3-yellow">
       <p></p>  
    </div>
        <!--add nav bar -->
    <div class="w3-container">
        
    </div>
	<div class="w3-bar w3-border w3-light-grey">
	<?php
    include("navbar.php"); 
    ?>
	</div>
	
	<div class="w3-container w3-brown" >
    <h2>Registration Form</h2>
    </div>
	<img src ="bin/images/background1.jpg" alt = "Background" style="width:100%">
	<!--- Form begins here ----->
	<div class = "w3-container w3-light-grey w3-display-middle" style = "width:30%; height:60%">
	<form id="register" action="register.php" method="post">
	<label>First Name</label> 
    <input class="w3-input w3-border w3-round" type="text" name="firstname">
  
	<label>Last Name</label>
	<input class="w3-input w3-border w3-round" type="text" name="lastname">
    
	<label>User Name</label>
	<input class="w3-input w3-border w3-round" type="text" name="username">
    
	<label>Enter Password</label>
    <input class="w3-input w3-border w3-round" type="password" name="password1">
    
	<label>Re-Enter Password</label>
	<input class="w3-input w3-border w3-round" type="password" name="password2">
    
    <input type="submit" name="submit" formaction = "index.php" class="w3-block w3-brown w3-display-bottom-middle w3-large">
         
    </form><br>
	
	</div>
	
	<?php
	include("footer.php");
	?>
	
		 
		
	
  
	
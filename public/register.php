<?php
	$title = "Register";
	include("header.php");
?>

        <!--add nav bar -->
    <div class="w3-container">

    </div>
	<div class="w3-bar w3-border w3-light-grey">
	<?php
    include("navbar.php");
    ?>
	</div>

	<div class="w3-container" style="background-color: #800000; color: white;">
    <h2>Tutor Registration</h2>
    </div>
	<img src ="bin/images/background1.jpg" alt = "Background" style="width:100%">
	<!--- Form begins here ----->
	<div class = "w3-container w3-light-grey w3-display-bottommiddle w3-third" style = "width:50%; height:490px; padding: 20px;">
	<form id="register" action="register.php" method="post">
	<label>First Name</label>
    <input class="w3-input w3-border w3-round" type="text" name="firstname">

	<label>Last Name</label>
	<input class="w3-input w3-border w3-round" type="text" name="lastname">

	<label>User Name</label>
	<input class="w3-input w3-border w3-round" type="text" name="username">

    <label>Email</label>
	<input class = "w3-input w3-border w3-round" type= "text" name= "email">

	<label>Password</label>
	<input class = "w3-input w3-border w3-round" type= "password" name= "password">

	<label>Admin        </label>
    	<input class="w3-radio" type="radio" name="isAdmin" value = "yes">
	<label>Yes</label>
	<input class = "w3-radio" type = "radio" name = "isAdmin" value = "no">
	<label>No</label><br>

	<label>Allow notification </label>
	<input class="w3-radio" type="radio" name="notify" value = "yes">
	<label>Yes</label>
	<input class = "w3-radio" type = "radio" name = "notify" value = "no">
	<label>No</label>
    <p>
    <input type="submit" name="submit"  class="w3-btn w3-display-bottom-middle w3-large" style="background-color: #800000; color: white; margin: center;">
	<input type="reset" value = "Reset" class = "w3-btn w3-large" style="width: 90px; background-color: #800000; color: white;">
    </p>

	<?php
	require_once("../APIClient.php");
	if(isset($_POST['submit']))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
        $email = $_POST["email"];
		$isAdmin = false;
		if($_POST["isAdmin"] == "yes")
		{
			$isAdmin = true;
		}
		$notify = false;
		if($_POST["notify"] == "yes")
		{
			$notify = true;
		}

		$user = new User(null, $username, $firstname, $lastname, $isAdmin, $notify, $email);
		APIClient::addUser($user, $password);
	}
	?>
	</form><br>
	</div>


	<div style="display-left: 10px; padding-left: 15px;">
	<?php
	include("footer.php");
	?>
	</div>
	</body>
	</html>

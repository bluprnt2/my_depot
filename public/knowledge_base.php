
	<?php
		require_once("../APIClient.php");
		//include ("connectiondb.php");
		$title = "Knowledge Base";
		include("header.php");
		include("navbar.php");
		//only tutors and admins should be able to
		//access and modify the knowledge base.
		//check if the user is logged in,
		//if not, redirect them.
		
		if(!APIClient::isLoggedIn())
		{
			//make note to update navbar on login
			//admin has option to view knowledge base but can remove files
			//header('Location: ./tutor_web_app/public/home.php');
			echo '<p><a href="home.php">Only Tutors and Admins have access to the Knowledge Base</a><p>';
			exit();
		}
		
	?>
		
		<!--kb = knowledge base-->
		<div id="kb-container">
			<div id="kb-title">
				<div class="yellowBox">Knowledge Base</div>
			</div>
			
			<div id="kb-content">
				<!--subject and course selection container-->
				<div id="kb-file-selector">
					<select id=subject" >
						<option value="">Select a Subject</option>
						<?php
						//onChange="getCourses(this.value);"
							$departments = APIClient::getDepartments(null, null);
							foreach($departments as $d) {
								echo "<option>". $d->getName() . "</option>";
							}
						?>
					</select>
					
					<select id="kb-course" >
						<option value="">Select a Course</option>
						<?php
							//onChange="getFiles(this.value);"
							$courses = APIClient::getCourses(null, null, null);
							foreach($courses as $a){
								echo "<option>". $a->getName() ."</option>";
							}
						?>
					</select>
					
					<select id="kb-filename">
						<option selected="selected">Select a File</option>
					</select>
					
					<button class="kb-button" onClick="return showFile();">Submit</button>
				</div>
				
				<div id="kb-main">
					<div class="subjectName">Sample Subject</div>
					<div class="filesDisplay">File 1</div>
				</div>
			</div>
			<div id="kb-footer">
			<?php
				include("footer.php");
			?>
			</div>
		</div>
	</body>
</html>

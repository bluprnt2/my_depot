
	<div id="kb-yellowbar"></div>
	
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
			header('Location: ./tutor_web_app/index.php');
			echo '<p><a href="index.php">Only Tutors and Admins have access to the Knowledge Base</a><p>';
			exit();
		}
	?>
		
		<!--kb = knowledge base-->
		<div id="kb-container">
			<div id="kb-title">
				<div class="">Knowledge Base</div>
			</div>
			
			
			<div id="wrapper">
				<div id="kb-selection">
					<form method="POST">
					<div id="kb-selection-component1">
						<select id="kb-department" >
							<option name="department" value="">Select a Department</option>
							
							<?php
							/*
							$departments = APIClient::getDepartments(null);
								foreach($departments as $d) {
									echo "<option value=".$d->getID().">". $d->getName() . "</option>";
								}
							*/
							?>
							
							
						</select>
						
						<button id="kb-loadButton" name="load-courses" type="submit" onClick="">Load Courses
						<?php
						/*
							if(isset($_POST('load-courses')))
							{
								$department = $_POST['department'];
							}
						*/
						?>
						</button>
					</div>

					<div id="kb-selection-component2">
						<select id="kb-course">
							<option name="course" value="">Select a Course</option>
							<?php
								
								if(isset($department))
								{
									$courses = APIClient::getCourses(null, $department);
									foreach($courses as $a){
										echo "<option>". $a->getName() ."</option>";
									}
								}
							?>
						</select>
						
						<button id="kb-loadButton" type="submit" onClick="">Load Files</button>
					</div>
					
					<div id="kb-selection-component3">
						<select id="kb-filename">
							<option name="file" selected="selected">Select a File</option>
							<?php
								$course = $_POST['course'];
								if(isset($course))
								{
									$courses = APIClient::getFiles($course, null);
									foreach($files as $a){
										echo "<option>". $a->getFileName() ."</option>";
									}
								}
							?>
						</select>
						
						<button id="kb-loadButton" type="submit" onClick="">Open File</button>
					</div>
					</form>
				</div>
			</div>
				<div id="kb-instructions">
					<div id="kb-instructionsTitle">Knowledge Base Instructions</div>
					<div id="kb-instructionsText"><p><span>1. Select a Department and click "Load Courses" to load a course.</span>
					<span>2. Select a Course and click "Load Files" to load a course's files.</span>
					<span>3. Select a File and click "Load File" to load a file.</span></p>
					</div>
				</div>
			</div>
				
			<div id="kb-content">
					<div class="courseName">
						<?php
							$filename = $_GET['file']; 
							if(isset($filename))
							{
								$courses = APIClient::getFiles($course, $filename);
								foreach($courses as $a){
									echo "<option>". $a->getName() ."</option>";
								}
							}
						?>
					</div>
					<div class="filesDisplay">
						<?php
							$filename = $_GET['file']; 
							if(isset($filename))
							{
								$courses = APIClient::getFiles($course, $filename);
								foreach($courses as $a){
									echo "<option>". $a->getContent() ."</option>";
								}
							}
						?>
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

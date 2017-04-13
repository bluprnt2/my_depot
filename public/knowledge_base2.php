
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
			header('Location: ./index.php');
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
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
					
					<div id="kb-selection-component2">
						<select id="kb-course">
							<option name="course" value="" type="submit">Select a Course</option>
							<?php
								$courses = APIClient::getCourses(null, null);
								foreach($courses as $c){
									echo "<option value=".$c->getID().">". $c->getName() ."</option>";
								}
								/*if(isset($_POST['course']))
								{
									$course= $_POST['course'];
								}*/
							?>
						</select>
						
						<input id="kb-loadButton" type="submit" name="load-files" value='Load Files' onClick="window.location.reload()"></button>
					</div>
					
					<div id="kb-selection-component3">
						<select id="kb-filename">
							<option name="files" value="" type="submit">Select a File</option>
							<?php
								//if(isset($course))
								//{
									$files = APIClient::getFiles(null, null);
									foreach($files as $f){
										echo "<option value=".$f->getID().">". $f->getFileName() ."</option>";
									}
								//}
								/*if(isset($_POST['files']))
								{
									$file= $_POST['files'];
								}*/
							?>
						</select>
						
						<input id="kb-loadButton" type='submit' name="load-file" value='Load File' onClick="window.location.reload()"></button>
					</div>
					</form>
				</div>
			</div>
				<div id="kb-instructions">
					<div id="kb-instructionsTitle">Knowledge Base Instructions</div>
					<div id="kb-instructionsText">
					<span>1. Select a Course and click "Load Files" to load a course's files.</span>
					<span>2. Select a File and click "Load File" to load a file.</span>
					</div>
				</div>
			</div>
				
			<div id="kb-content">
					<div class="courseName">
						<?php
							if(isset($file))
							{
								$filename = APIClient::getFiles($course, $file);
								foreach($file as $a){
									echo $a->getName();
								}
							}
						?>
					</div>
					<div class="filesDisplay">
						<?php
							if(isset($filename))
							{
								$fileContents = APIClient::getFiles($course, $filename);
								foreach($file as $a){
									echo $a->getContent();
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

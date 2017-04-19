	<?php
		require_once("../APIClient.php");
		$title = "Knowledge Base";
		include("header.php");
	?>
	<div id="kb-yellowbar"></div>
	<?php
		include("navbar.php");
		//only tutors and admins should be able to
		//access and modify the knowledge base.
		//check if the user is logged in,
		//if not, redirect them.
		
		if(!APIClient::isLoggedIn())
		{
			if(APIClient::isLoggedIn()) {
				echo "Logged In!";
			} else {
				echo "Login failed...";
			}
			//make note to update navbar on login
			//admin has option to view knowledge base but can remove files
			header('Location: ./index.php');
			echo '<p><a href="index.php">Only Tutors and Admins have access to the Knowledge Base</a><p>';
			exit();
		}
	?>
		
		<!--kb = knowledge base-->
		<div id="kb-container">
			<div id="kb-title">Knowledge Base</div>
			
			<div id="wrapper">
				<div id="kb-selection">
				<?php
					$departments = APIClient::getDepartments(null);
					$courses = APIClient::getCourses(null, null, null);
					$files = APIClient::getFiles(null, null, null);
				?>
									
					<div id="kb-selection-component">
					<form id="selDeptForm" method="POST">	
						<select id="kb-department" name="department" class="dept-list" onChange="changeDepartment('selDeptForm')">
							<option value="">Select a Department</option>
							<?php
								foreach($departments as $d) {
									$name = $d->getName();
									$id = $d->getID();
									echo "<option value=" . $id . ">" . $name . "</option>";		
								}									
							?>
						</select>
						<select id="kb-course" name="course" class="course-list" onChange="changeCourse('selDeptForm')">
							<option value="">Select a Course</option>
							<?php
								foreach($courses as $c){
									$courseValues = array("deptID"=>$c->getDeptID(), "ID"=>$c->getID());
									echo "<option value=" . json_encode($courseValues) . ">". $c->getName() ."</option>";
								}
							?>
						</select>
						<select id="kb-file" name="file" class="file-list">
							<option value="">Select a File</option>
							<?php
								foreach($files as $f){
									$fileValues = array("fileID"=>$f->getID(), "courseID"=>$f->getCourseID());
									echo "<option value=" . json_encode($fileValues) . ">". $f->getFilename() ."</option>";
								}
							?>
						</select>
						<div id="kb-buttons">
							<input id="kb-loadButton" type="submit" name="load-file" value ="Load File">
							<input id="kb-clearButton" type="reset" value = "Clear Form">
						</div>
						<?php
						if(isset($_POST['load-file']))
						{
							$file = $_POST['file'];
							$fileExplode = explode(',', $file);
							$fileExplode[0] = preg_replace('/[^0-9.]+/', '', $fileExplode[0]);
							$fileExplode[1] = preg_replace('/[^0-9.]+/', '', $fileExplode[1]);
							$File = APIClient::getFiles((int)$fileExplode[0], (int)$fileExplode[1], null);
						}
						?>
					</form>
					</div>
					
					
					<h3 id="kb-name">
						<?php
							if(isset($_POST['load-file']))
							{
								foreach($File as $f) {
									echo $f->getFilename();
								}						
							}
						?>
					</h3>
					<p id="kb-content">
						<?php
							if(isset($_POST['load-file']))
							{
								foreach($File as $f) {
									echo $f->getContent();
								}	
							}
							else
							{
								echo "Select and Load a File using the dropdown lists above.";
							}
						?>
					</p>
				</div>
			</div>
			<script> //author: Chris Mariani
				function changeDepartment(id) {
					var form = document.getElementById(id);
					var dept = form.getElementsByClassName("dept-list")[0];
					var course = form.getElementsByClassName("course-list")[0];
					course.options[0].selected=true;
					hide(course, "deptID", dept.value);
				}
				
				function changeCourse(id) {
					var form = document.getElementById(id);
					var course = form.getElementsByClassName("course-list")[0];
					var file = form.getElementsByClassName("file-list")[0];
					file.options[0].selected=true;
					hide(file, "courseID", JSON.parse(course.value).ID);
				}
				
				function hide(drop, value_name, value) {
					for(i = 1; i <= drop.length; i++) {
						var v = true;
						var checking = JSON.parse(drop.options[i].value);
						var checked = checking[value_name];
						if(!(checked instanceof Array)) {
							if(checked == value) v = false;
						} else {
							for(j = 0; j < checked.length; j++) {
								if(checked[j] == value) v = false;
							}
						}
						drop.options[i].hidden=v;
					}
				}
			</script>
			<div id="kb-footer">
			<?php
				include("footer.php");
			?>
			</div>
		</div>
	</body>
</html>
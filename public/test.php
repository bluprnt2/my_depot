
	<?php
		//include ("connectiondb.php");
		$title = "Knowledge Base";
		include("header.php");
		include("navbar.php");
	?>
		
		<div id="container">
			<!--Yellow bar -->
			<div id="header">
				<!--yellow bar-->
				<div class="yellowBox"></div>
				<!--navigation bar-->
				<div id="nav">
				<input class="w3-input w3-border" type="text" placeholder="Search Rowan" style="width:15%" >	  
				</div>
			</div>
			
			<div id="divider">
				<p></p>
			</div>
			
			<div id="content">
				<!--subject and course selection container-->
				<div id="file-selector">
					<select id=test">
						<option value="">test</option>
					</select>
					<select id=test2">
						<option value="">test</option>
					</select>
					<select id=test3">
						<option value="">test</option>
					</select>
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
					
					<select id="course" >
						<option value="">Select a Course</option>
						<?php
							//onChange="getFiles(this.value);"
							$courses = APIClient::getCourses(null, null, null);
							foreach($courses as $a){
								echo "<option>". $a->getName() ."</option>";
							}
						?>
					</select>
					
					<select id="filename">
						<option selected="selected">Select a File</option>
					</select>
					
					<button class="button" onClick="return showFile();">Submit</button>
				</div>
				
				<div id="main">
					<div class="subjectName">Sample Subject</div>
					<div class="filesDisplay">File 1</div>
				</div>
			</div>
			<div id="footer">
			<?php
				include("footer.php");
			?>
			</div>
		</div>
	</body>
</html>

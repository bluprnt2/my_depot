<?php
    require_once("../APIClient.php");
    $title = "Settings";
    include("header.php");

    include("navbar.php");
	if(!APIClient::isLoggedIn())
	{
		//make note to update navbar on login
		//admin has option to view knowledge base but can remove files
		header('Location: ./index.php');
		echo '<p><a href="index.php">Only Tutors and Admins have access to the Settings</a><p>';
		exit();
	}
    $depts=APIClient::getDepartments(null);
    $courses=APIClient::getCourses(null, null, null);
	$files = APIClient::getFiles(null, null, null);
    $users=APIClient::getUser(null);
    $coursetutors=APIClient::getCourseTutors(null, null);
?>
<div class="w3-container w3-brown" >
    <h2>Settings</h2>
</div>


<div id="settings-page-container" class="w3-contianer">

    <!-- Form for adding a class to the database -->

<div class="login-container settings-container">
    <form id="addClassForm" method="POST">
        <h3>Add Class</h3>
        <input type="text" name="class" placeholder="Course Name">
        <select name="Department" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
        <br /><br />
        <button type="submit" name="addClass">Add Class</button>
    </form>
</div>

    <!-- Form for removing a class from the database -->
<div class="login-container settings-container">
    <form id="delClassForm" method="POST">
        <h3>Remove Class</h3>
        <!-- Allows for narrowing down classes by department -->
        <select name="Department" onChange="delClassUpdate()" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
        <br />
    	<select name="Course" class="course-list settings-dropdown">
    		<option value="">Select a Course</option>
    		<?php
    			foreach($courses as $a){
    				echo "<option value=\"{ 'deptID':" . $a->getDeptID() . ", 'ID':" . $a->getID() . "}\">". $a->getName() ."</option>";
    			}
    		?>
    	</select>
        <br /><br />
        <button type="submit" name="delClass">Remove Class</button>
    </form>
</div>

    <!-- Form for adding a department to the database -->

<div class="login-container settings-container">
    <form id="addDeptForm" method="POST">
        <h3>Add Department</h3>
        <input type="text" name="deptName" placeholder="Department Name">
        <br />
        <button type="submit" name="delClass">Add Department</button>
    </form>
</div>

    <!-- Form for removing a department from the database -->

<div class="login-container settings-container">
    <form id="delDeptForm" method="POST">
        <h3>Remove Department</h3>
        <select name="Department" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
        <br />
        <button type="submit" name="delClass">Remove Department</button>
    </form>
</div>

<div class="login-container settings-container">
    <form id="addLocForm" method="POST">
        <h3>Add Location</h3>
        <input type="text" name="locName" placeholder="Building Name">
        <br />
        <input type="text" name="locRoomNumber" placeholder="Room Number">
        <br />
        <button type="submit" name="locClass">Add Location</button>
    </form>
</div>

<div class="login-container settings-container">
    <form id="delLocForm" method="POST">
        <h3>Remove Location</h3>
        <select name="Location" class="loc-list settings-dropdown">
    		<option value="">Select a Location</option><?php
            foreach($locs as $l) {
                $name = $l->getBuildingName() . " Rm. " . $l->getRoomNumber();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
        <br />
        <button type="submit" name="delClass">Remove Department</button>
    </form>
</div>
    <!-- Form for associating tutors with courses -->

<div class="login-container settings-container">
    <form id="assocTutorForm" method="POST">
        <h3>Associate Tutor w/ Class</h3>
        <select name="Department" onChange="assocTutorUpdate()" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
    	<select name="Course" class="course-list settings-dropdown">
    		<option value="">Select a Course</option>
    		<?php
    			foreach($courses as $a){
    				echo "<option value=\"{ 'deptID':" . $a->getDeptID() . ", 'ID':" . $a->getID() . "}\">". $a->getName() ."</option>";
    			}
    		?>
    	</select>
        <select name="Tutor" class="tutor-list settings-dropdown">
    		<option value="">Select a Tutor</option>
    		<?php
    			foreach($users as $t){
                    if(!$t->getAdmin())
    				    echo "<option value=" . $t->getUserID() . ">". $t->getUsername() ."</option>";
    			}
    		?>
        </select>
        <button type="submit" name="assocTutor">Assign Tutor</button>
    </form>
</div>

    <!-- Form for removing tutors from classes or completely-->

<div class="login-container settings-container">
    <form id="delTutorForm" method="POST">
        <h3>Remove User</h3>
        <select name="Department" onChange="delTutorUpdate()" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
    	<select name="Course" onChange="delTutorUpdate()" class="course-list settings-dropdown">
    		<option value="">Select a Course</option>
    		<?php
    			foreach($courses as $a){
    				echo "<option value=\"{ 'deptID':" . $a->getDeptID() . ", 'ID':" . $a->getID() . "}\">". $a->getName() ."</option>";
    			}
    		?>
    	</select>
        <select name="Tutor" class="tutor-list settings-dropdown">
    		<option value="">Select a Tutor</option>
    		<?php
    			foreach($users as $t){
                    if(!$t->getAdmin())
                        $courseids = " ";
                        foreach($coursetutors as $c){
                            if($c->{'tutorID'} == $t->getUserID){
                                //$courseids.concat("'courseID':" . $c->{'courseID'}. " ");
                            }
                        }
    				    echo "<option value=\"{" . $courseids . "'ID':" . $t->getUserID() . "}\">". $t->getUsername() ."</option>";
    			}
    		?>
        </select>
        <br /><br />
        <button type="submit" name="delTutorClass">Remove from Course</button>
        <button type="submit" name="delTutor">Delete Account</button>
    </form>
</div>
<div class="login-container settings-container">
   <form id="rmFileForm" method="POST">
       <h3>Remove File</h3>
       <select name="Department" class="dept-list settings-dropdown">
			<option value="">Select a Department</option>
           <?php
				foreach($depts as $d) {
					echo "<option value=".$d->getID().">" . $d->getName() . "</option>";
				}					
			?>
       </select>
       <select name="Course" class="dept-list settings-dropdown">
			<option value="">Select a Course</option>
           <?php
				foreach($courses as $c){
					echo "<option value=".$c->getID().">" . $c->getName() ."</option>";
				}
			?>
       </select>
       <select name="File" class="dept-list settings-dropdown">
			<option value="">Select a File</option>
           <?php
				foreach($files as $f){
					echo "<option value=".$f->getID().">".$f->getFilename()."</option>";
				}
			?>
       </select>
       <button type="submit" name="delFile">Delete File
		   <?php
			if(isset($_POST['delFile']))
			{
				$file = $_POST['File'];

				APIClient::removeFile($file);
			}
			?>
		</button>
   </form>
</div>


<div class="login-container settings-container">
	<form id="addFileForm" method="POST">
        <h3>Add File</h3>
        <select name="CourseID" class="dept-list settings-dropdown">
			<option value="">Select a Course</option>
           <?php
				foreach($courses as $c){
					echo "<option value=".$c->getID().">" . $c->getName() ."</option>";
				}
			?>
       </select>
		<select name="AuthorID" class="tutor-list settings-dropdown">
    		<option value="">Select a Author of File</option>
    		<?php
    			foreach($users as $t){
                    if(!$t->getAdmin()){
    				    echo "<option value=".$t->getUserID().">". $t->getUsername() ."</option>";
					}
				}
    		?>
        </select>
    	<input type="text" name="filename" placeholder="Title" />
        <textarea name="content" placeholder="Content" style="width:100%; height: 320px; resize: none"></textarea>
        <br />
        <button type="submit" name="addFile">Add File
		<?php

		if(isset($_POST['addFile']))
		{
    		$CourseID = $_POST["CourseID"];
    		$UserID = $_POST["AuthorID"];
    		$Filename = $_POST["filename"];

    		$newFile = new KnowledgeFile(
    			null,
    			$CourseID,
    			$UserID,
    			$Filename,
    			$_POST["content"],
    			null
    		);

			APIClient::addFile($newFile);
		}
		?>
		</button>
        <button type="reset">Clear Form</button>
    </form>
</div>
</div>
<script>
    function hide(drop, value) {
        for(i = 1; i < drop.length; i++) {
            var v = true;
            if(drop.options[i].value.includes(value)) v = false;
            drop.options[i].hidden=v;
        }
    }
    function changedDepartment(id) {
        var form = document.getElementById(id);
        var dept = form.getElementsByClassName("dept-list")[0];
        var course = form.getElementsByClassName("course-list")[0];
        course.options[0].selected=true;
        hide(course, "'deptID':".concat(dept.value));
    }

    function changeCourse(id) {
        var form = document.getElementById(id);
        var course = form.getElementsByClassName("course-list")[0];
        var tutor = form.getElementsByClassName("tutor-list")[0];
        tutor.options[0].selected=true;
        hide(tutor, "'courseID':".concat(course.value));
    }

    function delClassUpdate() {
        changedDepartment("delClassForm");
    }
    function assocTutorUpdate(){
        changedDepartment("assocTutorForm");
    }

    function delTutorUpdate() {
        changedDepartment("delTutorForm");
        changeCourse("delTutorForm");
    }
</script>
<div id="kb-footer">
    <?php
        include("footer.php");
    ?>
</div>

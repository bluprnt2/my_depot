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
        <input type="text" name="class">
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
        <input type="text" name="deptName">
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
    <!-- Form for associating tutors with courses -->

<div class="login-container settings-container">
    <form id="assocTutorForm" method="POST">
        <h3>Associate Tutor w/ Class</h3>
        Department: <select name="Department" onChange="assocTutorUpdate()" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
    	Class: <select name="Course" class="course-list settings-dropdown">
    		<option value="">Select a Course</option>
    		<?php
    			foreach($courses as $a){
    				echo "<option value=\"{ 'deptID':" . $a->getDeptID() . ", 'ID':" . $a->getID() . "}\">". $a->getName() ."</option>";
    			}
    		?>
    	</select>
        Tutor: <select name="Tutor" class="tutor-list settings-dropdown">
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

<div class="login-container settings-container">
    <form action="./register.php">
        <h3>Add User</h3>
        <button type="submit">Add new User</button>
    </form>
</div>

    <!-- Form for removing tutors from classes or completely-->

<div class="login-container settings-container">
    <form id="delTutorForm" method="POST">
        <h3>Remove User</h3>
        Department: <select name="Department" onChange="delTutorUpdate()" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
    	Class: <select name="Course" onChange="delTutorUpdate()" class="course-list settings-dropdown">
    		<option value="">Select a Course</option>
    		<?php
    			foreach($courses as $a){
    				echo "<option value=\"{ 'deptID':" . $a->getDeptID() . ", 'ID':" . $a->getID() . "}\">". $a->getName() ."</option>";
    			}
    		?>
    	</select>
        Tutor: <select name="Tutor" class="tutor-list settings-dropdown">
    		<option value="">Select a Tutor</option>
    		<?php
    			foreach($users as $t){
                    if(!$t->getAdmin())
                        $courseids = " ";
                        foreach($coursetutors as $c){
                            if($c->{'tutorID'} == $t->getUserID){
                                $courseids.concat("'courseID':" . $c->{'courseID'}. " ");
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
	<form id="addFileForm" method="POST">
        <h3>Add File</h3>
        Course ID: <input type="text" name="classID">
		Author User ID: <input type="text" name="authorID">
        Filename: <textarea type="filename" name="filename">
    	File Contents: <input type="text" name="content" style = "width: 50%; height: 80%">
        <input type="submit" name="addFile" class="addFileButton" value="Add File">
		<?php

		if(isset($_POST['submit']))
		{
		$CourseID = $_POST["classID"];
		$UserID = $_POST["authorID"];
		$Filename = $_POST["filename"];
		$Content = $_POST["content"];

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
        <input type="reset" value="Clear Form" class="addFileButton">
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

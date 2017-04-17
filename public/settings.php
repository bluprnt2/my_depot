<?php
    require_once("../APIClient.php");
    $title = "Settings";
    include("header.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST")
        echo "<meta http-equiv='refresh' content='0'>";

    include("navbar.php");
	if(!APIClient::isLoggedIn())
	{
		//make note to update navbar on login
		//admin has option to view knowledge base but can remove files
		header('Location: ./index.php');
		echo '<p><a href="index.php">Only Tutors and Admins have access to the Settings</a><p>';
		exit();
	}
    $is_admin = APIClient::isAdmin();
    $depts=APIClient::getDepartments(null);
    $courses=APIClient::getCourses(null, null, null);
	$files = APIClient::getFiles(null, null, null);
    if(!$is_admin){
        $temp_files = $files;
        $files = array();
        $userid = APIClient::tokenInfo()->{'userID'};
        foreach($temp_files as $t) {
            if($t->getUserID() == $userid){
                $files[] = $t;
            }
        }
    }
    $locs = APIClient::getLocations(null, null, null);
    $users=APIClient::getUser(null);
    $coursetutors=APIClient::getCourseTutors(null, null);
?>
<div class="w3-container w3-brown" >
    <h2>Settings</h2>
</div>


<div id="settings-page-container" class="w3-contianer">

    <!-- Form for adding a class to the database -->

<div class="login-container settings-container admin-form">
    <form id="addClassForm" method="POST">
        <h3>Add Class</h3>
        <input type="text" name="className" placeholder="Course Name">
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
    <?php
        if(isset($_POST['addClass'])) {
            $className = $_POST['className'];
            $deptID = $_POST['Department'];

            $newClass = new Course(null, $className, $deptID);
            APIClient::addCourse($newClass);
        }
    ?>
</div>

    <!-- Form for removing a class from the database -->
<div class="login-container settings-container admin-form">
    <form id="delClassForm" method="POST">
        <h3>Remove Class</h3>
        <!-- Allows for narrowing down classes by department -->
        <select name="Department" onChange="changeDepartment('delClassForm')" class="dept-list settings-dropdown">
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
                    $courseValues = array("deptID"=>$a->getDeptID(), "ID"=>$a->getID());
    				echo "<option value=". json_encode($courseValues) . ">". $a->getName() ."</option>";
    			}
    		?>
    	</select>
        <br /><br />
        <button type="submit" name="delClass">Remove Class</button>
    </form>
    <?php
        if(isset($_POST['delClass'])) {
            $courseID = json_decode($_POST["Course"])->{'ID'};
            APIClient::deleteCourse($courseID);
        }
    ?>
</div>

    <!-- Form for adding a department to the database -->

<div class="login-container settings-container admin-form">
    <form id="addDeptForm" method="POST">
        <h3>Add Department</h3>
        <input type="text" name="deptName" placeholder="Department Name">
        <br />
        <button type="submit" name="addDept">Add Department</button>
    </form>
    <?php
        if(isset($_POST['addDept'])) {
            $deptName = new Department(null, $_POST["deptName"]);
            APIClient::addDepartment($deptName);
        }
    ?>
</div>

    <!-- Form for removing a department from the database -->

<div class="login-container settings-container admin-form">
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
        <button type="submit" name="delDept">Remove Department</button>
    </form>
    <?php
        if(isset($_POST['delDept'])) {
            $deptID = $_POST["Department"];
            APIClient::deleteDepartment($deptID);
        }
    ?>
</div>

<div class="login-container settings-container admin-form">
    <form id="addLocForm" method="POST">
        <h3>Add Location</h3>
        <input type="text" name="locName" placeholder="Building Name">
        <br />
        <input type="text" name="locRoomNumber" placeholder="Room Number">
        <br />
        <button type="submit" name="addLoc">Add Location</button>
    </form>
    <?php
        if(isset($_POST['addLoc'])) {
            $locName = $_POST["locName"];
            $roomNumber = $_POST["locRoomNumber"];
            $location = new Location(null, $locName, $roomNumber);
            APIClient::addLocation($location);
        }
    ?>
</div>

<div class="login-container settings-container admin-form">
    <form id="delLocForm" method="POST">
        <h3>Remove Location</h3>
        <select name="Location" class="loc-list settings-dropdown">
    		<option value="">Select a Location</option><?php
            foreach($locs as $l) {
                $name = $l->getBuildingName() . " Rm. " . $l->getRoomNumber();
                $id = $l->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
        <br />
        <button type="submit" name="delLoc">Remove Location</button>
        <?php
            if(isset($_POST['delLoc'])){
                $locID = $_POST["Location"];
                APIClient::delLocation($locID);
            }
        ?>
    </form>
</div>
    <!-- Form for associating tutors with courses -->

<div class="login-container settings-container admin-form">
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

<div class="login-container settings-container admin-form">
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
       <select name="Department" class="dept-list settings-dropdown" onChange="changeDepartment('rmFileForm')">
			<option value="">Select a Department</option>
           <?php
				foreach($depts as $d) {
					echo "<option value=" . $d->getID() . ">" . $d->getName() . "</option>";
				}
			?>
       </select>
       <select name="Course" class="course-list settings-dropdown" onchange="changeCourse('rmFileForm')">
			<option value="">Select a Course</option>
           <?php
				foreach($courses as $c){
                    $courseValues = array("deptID"=>$c->getDeptID(), "ID"=>$c->getID());
					echo "<option value=" . json_encode($courseValues) . ">" . $c->getName() ."</option>";
				}
			?>
       </select>
       <select name="File" class="tutor-list settings-dropdown">
			<option value="">Select a File</option>
           <?php
				foreach($files as $f){
                    $fileValues = array("ID"=>$f->getID(), "userID"=>$f->getUserID(), "courseID"=>$f->getCourseID());
					echo "<option value=" . json_encode($fileValues) . ">".$f->getFilename()."</option>";
				}
			?>
       </select>
       <button type="submit" name="delFile">Delete File
		   <?php
			if(isset($_POST['delFile']))
			{
				$file = json_decode($_POST['File']);
				APIClient::removeFile($file->{'userID'}, $file->{'ID'});
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
					echo "<option value=" . $c->getID() . ">" . $c->getName() ."</option>";
				}
			?>
       </select>
    	<input type="text" name="filename" placeholder="Title/Filename" />
        <textarea name="content" placeholder="Content" style="width:100%; height: 320px; resize: none"></textarea>
        <br />
        <button type="submit" name="addFile">Add File
		<?php

		if(isset($_POST['addFile']))
		{
    		$CourseID = $_POST["CourseID"];
    		$Filename = $_POST["filename"];
            $Content = $_POST["content"];

    		$newFile = new KnowledgeFile(
    			null,
    			$CourseID,
    			null,
    			$Filename,
    			$Content,
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
    if(<?php echo ($is_admin ? 'false' : 'true'); ?>){
        var admin_forms = document.getElementsByClassName("admin-form");
        for(var i = 0; i < admin_forms.length; i++) {
            admin_forms.item(i).style.display = "none";
        }
    }

    function hide(drop, value_name, value) {
        for(i = 1; i < drop.length; i++) {
            var v = true;
            if(drop.options[i].value.includes("\"" + value_name + "\"" + ":" + "\"" + value + "\"")) v = false;
            drop.options[i].hidden=v;
        }
    }
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
        var tutor = form.getElementsByClassName("tutor-list")[0];
        tutor.options[0].selected=true;
        hide(tutor, "courseID", JSON.parse(course.value).ID);
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

    function delFileUpdate() {
        //changedDepartment("rmFileForm");
        changedCourse("rmFileForm");
    }
</script>
<div id="kb-footer">
    <?php
        include("footer.php");
    ?>
</div>

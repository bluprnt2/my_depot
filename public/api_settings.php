<?php
    require_once("../APIClient.php");
    $title = "Settings";
    include("header.php");

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
?>
<style type="text/css">
    .settings-dropdown {
        float:none;
        width: auto;
        margin-right:0;
    }
</style>

<div class="w3-bar w3-border w3-light-grey w3-cell">
    <?php include("navbar.php"); ?>
</div>

<div class="w3-contianer">
    <h1>Settings</h1>
    <form id="addClassForm" method="POST">
        <h3>Add Class</h3>
        Class: <input type="text" name="class">
        Department: <select name="Department" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
        <button type="submit" name="addClass">Add Class</button>
    </form>
    <form id="delClassForm" method="POST">
        <h3>Remove Class</h3>
        Department: <select name="Department" onChange="delClassUpdate()" class="dept-list settings-dropdown">
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
        <button type="submit" name="delClass">Remove Class</button>
    </form>
    <form id="addDeptForm" method="POST">
        <h3>Add Department</h3>
        Department: <input type="text" name="deptName">
        <button type="submit" name="delClass">Add Department</button>
    </form>
    <form id="delDeptForm" method="POST">
        <h3>Remove Department</h3>
        Department: <select name="Department" class="dept-list settings-dropdown">
    		<option value="">Select a Department</option><?php
            foreach($depts as $d) {
                $name = $d->getName();
                $id = $d->getID();
                echo "<option value=" . $id . ">" . $name . "</option>";
            }
        ?></select>
        <button type="submit" name="delClass">Remove Department</button>
    </form>
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
    			//onChange="getFiles(this.value);"
    			foreach($users as $t){
                    if(!$t->getAdmin())
    				    echo "<option value=" . $t->getUserID() . ">". $t->getUsername() ."</option>";
    			}
    		?>
        </select>
        <button type="submit" name="assocTutor">Assign Tutor</button>
    </form>
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
    function delClassUpdate() {
        changedDepartment("delClassForm");
    }
    function assocTutorUpdate(){
        changedDepartment("assocTutorForm");
    }
</script>

<?php
    include("footer.php");
?>

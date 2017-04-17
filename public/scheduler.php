<?php
$title = "Scheduler";
include("header.php");
?>
<<<<<<< HEAD
    <div class="w3-container w3-yellow">
        <p></p>
    </div>
=======

>>>>>>> refs/remotes/origin/master
    <div class="w3-container">
	</div>
	<div class="w3-bar w3-border w3-light-grey">
    <?php
    include("navbar.php");
    ?>
	</div>

	<style type="text/css" media="screen">
           html, body{
            height:90%;
        }
    </style>


	<div style="height:50px;background-color:#92543f">
    <div id="contbox" style="position: relative; font: bold 17px Arial">
        <div
            style="position: absolute; left: 10px; top: -4px; color:#fafafa">
            <h3>Schedule Viewer</h3>
		</div>
    </div>
	</div>
	

	<div id="addTimeSlotForm" class = "login-container">
   <label>YYYY-MM-DD HH:MM:SS</label>
    <form id="login-form" action="scheduler.php" method="post">
        <div class="form-input">
            <input type="datetime" name="startTime" placeholder="Start Time">
        </div>
        <div class ="form-input">
            <input type="datetime" name="endTime" placeholder="End Time">
        </div>
        <div class="form-input">
            <?php
                $depts=APIClient::getDepartments(null);
                $courses=APIClient::getCourses(null, null, null);
                $locs=APIClient::getLocations(null, null, null)
            ?>
            <select name="deptID" onChange="addTimeSlotUpdate()" class="dept-list settings-dropdown">
        		<option value="">Select a Department (Required)</option><?php
                foreach($depts as $d) {
                    $name = $d->getName();
                    $id = $d->getID();
                    echo "<option value=" . $id . ">" . $name . "</option>";
                }
            ?></select>
            <select name="courseID" class="course-list settings-dropdown">
        		<option value="">Select a Course (Required)</option><?php
    			foreach($courses as $a){
                    $value = array("deptID" => $a->getDeptID(), "ID" => $a->getID());
    				echo "<option value=\"" . htmlspecialchars(json_encode($value))."\">". $a->getName() ."</option>";
    			}
            ?></select>
            <select name="locID" class="settings-dropdown">
        		<option value="">Select a Location (Required)</option><?php
    			foreach($locs as $a){
    				echo "<option value=" . $a->getID() . ">". $a->getBuildingName() . " Rm. " . $a->getRoomNumber() ."</option>";
    			}
            ?></select>
        </div>
        <input type="submit" name="addTimeSlotForm" value="Submit" class="btn-login">
    </form><br />
	</div>

	<div id="scheduler_here" class="dhx_cal_container"
     style='width:100%;height:100%;'>
    <div class="dhx_cal_navline">
        <div class="dhx_cal_prev_button">&nbsp;</div>
        <div class="dhx_cal_next_button">&nbsp;</div>
        <div class="dhx_cal_today_button"></div>
        <div class="dhx_cal_date"></div>
        <div class="dhx_cal_tab" name="day_tab"
             style="right:332px;"></div>
        <div class="dhx_cal_tab" name="week_tab"
             style="right:268px;"></div>
        <div class="dhx_cal_tab" name="month_tab"
             style="right:204px;"></div>

    </div>
    <div class="dhx_cal_header"></div>
    <div class="dhx_cal_data"></div>
	</div>

	<div class="w3-container">
    <?php include("footer.php"); ?>
	</div>
	<script>
    /**
	* The following Javascript calls the restful API to
	* create all timeslots and populate them in the scheduler.
	*/
	
    document.addEventListener("DOMContentLoaded", function () {
        init();
		var slots = <?php
			require_once("../APIClient.php");
			$events = APIClient::getTimeSlots(null, null, null, null, null, null);
			$e_array = array();
			foreach($events as $e) {
				$e_array[] = array(
					"ID"		 => $e['ID'],
					"start_date" => $e['startTime'],
					"end_date"   => $e['endTime'],
					"text"		 => $e['courseID'],
					"location"	 => $e['locID']
					);
				};
			echo json_encode($e_array);
			?>;
		var cnames = <?php
			require_once("../APIClient.php");
			$courses = APIClient::getCourses(null, null);
			$c_array = array();
        	foreach($courses as $co) {
				$c_array[] = array(
					"ID" => $co->getID(),
					"Name" => $co->getName()
					);
				};
			echo json_encode($c_array);
			?>;
		var bnames = <?php
			require_once("../APIClient.php");
			$buildings = APIClient::getLocations(null, null, null);
			$b_array = array();
        	foreach($buildings as $bld) {
				$b_array[] = array(
					"ID" => $bld->getID(),
					"Name" => $bld->getBuildingName(),
					"Room" => $bld->getRoomNumber()
					);
				};
			echo json_encode($b_array);
			?>;
		slots.forEach(event);
		function event(item) {
				var coursename = "";
				var index = 0;
				var flag = true;
				//discovering/assigning equivalent String for Course
				while (flag == true) {
					if(cnames[index].ID == item.text){
						coursename = cnames[index].Name + " - ";
						flag = false;
					}
					index++;
				};
				index = 0;
				//discovering/assigning equivalent String for Building
				while (flag == false) {
					if(bnames[index].ID == item.location){
						coursename = coursename + bnames[index].Name +
									" " + bnames[index].Room + " " + " ";
						flag = true;
					}
					index++;
				};
				//add the actual events and their info to the calendar
				scheduler.addEvent({
				start_date: item.start_date,//"yyyy-mm-dd hh:ii"
				end_date:   item.end_date,//"yyyy-mm-dd hh:ii"
				text:   	coursename + " Event ID:" + item.ID,
				});
		}
	});

    window.addEventListener("resize", function () {
        modSchedHeight();
    });

    //Hide the addTimeslot stuff unless admin
    if(!<?php echo (APIClient::isAdmin() ? 'true' : 'false'); ?>)
        document.getElementById("addTimeSlotForm").style.display='none';

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
        hide(course, "\"deptID\":\"".concat(dept.value).concat("\""));
    }

    function addTimeSlotUpdate() {
        changedDepartment("addTimeSlotForm");
    }
	</script>
    <?php
        //Stuff for submitting the timeslot
        if(isset($_POST['addTimeSlotForm'])) {
            $startTime = $_POST["startTime"];
            $endTime = $_POST["endTime"];
            $courseID = json_decode($_POST["courseID"])->{'ID'};
            $deptID = $_POST["deptID"];
            $locID = $_POST["locID"];

            //Department, course, & Location ids can't be null when adding to the DB
            $tslot = new TimeSlot(null, $locID, $deptID, $courseID, $startTime, $endTime);
            APIClient::addTimeSlot($tslot);
            echo "<meta http-equiv='refresh' content='0'>";
        }
    ?>
<?php
$title = "Scheduler";
include("header.php");
?>

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
            <h3>Schedule Viewer</h3></div>
    </div>
</div>
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
	* Create all timeslots and populate them in the scheduler.
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
			console.log(slots);
		var cNames = <?php
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
					if(cNames[index].ID == item.text){
						coursename = cNames[index].Name + " - ";
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
</script>
</body>
</html>
<<<<<<< HEAD
<!DOCTYPE html>
<!-- Just tagging for potential usage in Senior Proj-->
<!-- GNU GPL License -->
<!-- For further integration with DB for Proj-->
<!-- https://dhtmlx.com/docs/products/dhtmlxScheduler/ -->
<!-- https://docs.dhtmlx.com/tutorials__connector_codeigniter__step1.html-->
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Scheduler</title>
</head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="/codebase/dhtmlxscheduler.js" type="text/javascript" 
												charset="utf-8"></script>
	<link rel="stylesheet" href="/codebase/dhtmlxscheduler.css" 
			type="text/css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">

	<style type="text/css" media="screen">
    html, body{
        margin:0px;
        padding:0px;
        height:100%;
        overflow:hidden;
    }   
</style>

	<script type="text/javascript" charset="utf-8">
	function init() {
		//configuring a calendar
		window.resizeTo(950,700)
		modSchedHeight();
		scheduler.config.api_date="%Y-%m-%d %H:%i";
		scheduler.config.hour_date="%h:%i %A";
		scheduler.config.first_hour = 8;
		scheduler.config.last_hour = 18;
		scheduler.config.multi_day = true;
		scheduler.config.date_step = "5"
		scheduler.config.drag_move = false;
		//initializing here
		scheduler.init('scheduler_here', new Date(),"week");
		scheduler.setLoadMode("week")
		scheduler.templates.event_class=function(s,e,ev)
			{ return ev.custom?"custom":""; };
			
		var slots = <?php
        require_once("../APIClient.php");
        $events = APIClient::getTimeSlots(null, null, null, null, null, null);
		//Need to implement names for each course ID
        $e_array = array();
        foreach($events as $e) {
            $e_array[] = array(
                "start_date" => $e['startTime'],
                "end_date"   => $e['endTime'],
				"text"		=>  $e['courseID'],
				"location"	=>  $e['locID']			
			);
        };	
        echo json_encode($e_array);
					?>;
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
		?>	
		var bNames = <?php
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
		?>
		
		//Handy for testing			
		console.log(slots);
		console.log(bNames);
		//console.log(cNames);
		//////////////////////////
		//adding to calendar
		slots.forEach(event); 
		
		
		function event(item) {

				var courseName, buildName = "";
				var index = 0;
				var flag = true;
				//discovering equivalent String for Course
				while (flag == true) {
					if(cNames[index].ID == item.text){
						courseName = "(\n " + cNames[index].Name + " )";
						flag = false;
					}
					index++;
				};		
				index = 0;
				//discovering equivalent String for Building
				while (flag == false) {
					if(bNames[index].ID == item.location){
						buildName = "( " + bNames[index].Name + " )" + bNames[index].Room;
						flag = true;
					}
					index++;
				};
				scheduler.addEvent({
				start_date: item.start_date,//"2017-04-16 09:00"
				end_date:   item.end_date,//"2017-04-16 12:00"
				text:   	courseName + buildName,
				
		});
		}
	}
	</script>

=======
<?php
$title = "Scheduler";
include("header.php");
?>
    <div class="w3-container w3-yellow">
        <p></p>  
    </div>
    <div class="w3-container">
	</div>
<div class="w3-bar w3-border w3-light-grey">
    <?php
    include("navbar.php");
    ?>
</div>
>>>>>>> refs/remotes/origin/master

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

<<<<<<< HEAD
	<!--<br> skip a line. -->
	<div class="w3-bar w3-border w3-light-grey">
   <?php
   
   include("navbar.php");
   ?>
	</div>
	
	<div style="height:50px;background-color:#92543f ">
		
		<div id="contbox" style="position: relative; font: bold 17px Arial">
			<div 
				style="position: absolute; left: 10px; top: -4px; color:#fafafa">
			<h3>Scheduler</h3></div>
            </div>
		</div>
	</div>
		<div id="kb-footer">
			<?php
				include("footer.php");
			?>
		</div>
	<!-- some spacing before scheduler entity-->
    <ul>
        <li>
            <a></a>
            <span></span>
        </li>
    </ul>
<div class = "login-container">
   <label>YYYY-MM-DD HH:II</label>
    <form id="login-form" action="scheduler.php" method="post">
        <div class="form-input">
            <input type="datetime" name="startTime" placeholder="Start Time">
        </div>
        <div class ="form-input">
            <input type="datetime" name="endTime" placeholder="End Time"><input type="int" name="courseID" placeholder="Course ID">
        </div>
        <input type="submit" name="submit" value="Submit" class="btn-login">
		
        <!-- <input type="reset" name="back" value="BACK" class="btn-login" formaction="index.php"> -->
     
	<?php
	require_once("../APIClient.php");
	if(isset($_POST['submit']))
	{
		$startTime = $_POST["startTime"];
		$endTime = $_POST["endTime"];
		$courseID = $_POST["courseID"];

		
		$tslot = array(null,$courseID, $startTime, $endTime);
		APIClient::addTimeSlot($tslot);
	}
	?>	
	</form><br>
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
	</body>
=======
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
>>>>>>> refs/remotes/origin/master
</html>
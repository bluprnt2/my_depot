/* 
 * Functionality to be called in the Scheduler.
 */

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
		scheduler.config.readonly = true;
		//initializing here
		scheduler.init('scheduler_here', new Date(),"week");
		scheduler.setLoadMode("week")
		scheduler.templates.event_class=function(s,e,ev)
			{ return ev.custom?"custom":""; };
	}

function modSchedHeight() {
    var headHeight = 100;
    var sch = document.getElementById("scheduler_here");
    sch.style.height =
            (parseInt(document.body.offsetHeight) - headHeight) + "px";
    var contbox = document.getElementById("contbox");
    contbox.style.width = (parseInt(document.body.offsetWidth) - 300) + "px";
}

function openModal(){
    document.getElementById('modal').style.display='block';
}

function closeModal(){
    document.getElementById('modal').style.display='none';
}

function clearText(e){
   e.value = '';
}
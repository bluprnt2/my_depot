/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function init() {
    //configuring a calendar
    window.resizeTo(950, 700);
    modSchedHeight();
    scheduler.config.xml_date = "%Y-%m-%d %H:%i";
    scheduler.config.hour_date = "%h:%i %A";
    scheduler.config.first_hour = 8;
    scheduler.config.last_hour = 18;
    scheduler.config.multi_day = true;
    scheduler.config.date_step = "5";
    //initializing here
    scheduler.init('scheduler_here', new Date(), "week");
    scheduler.setLoadMode("week");
    scheduler.templates.event_class = function (s, e, ev)
    {
        return ev.custom ? "custom" : "";
    };

//Temporary inline events to be removed later(Demonstrating input format)
    scheduler.parse([
        {start_date: "2017-03-27 10:00", end_date: "2017-03-27 13:45", text: "Computer Science"},
    ], "json");
}

function modSchedHeight() {
    var headHeight = 100;
    var sch = document.getElementById("scheduler_here");
    sch.style.height =
            (parseInt(document.body.offsetHeight) - headHeight) + "px";
    var contbox = document.getElementById("contbox");
    contbox.style.width = (parseInt(document.body.offsetWidth) - 300) + "px";
}
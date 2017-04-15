<?php
$title = "TEST Scheduler";
include("header.php");
?>
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

<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        init();
    });

    window.addEventListener("resize", function () {
        modSchedHeight();
    });
</script>

<div class="w3-container">
    <?php include("footer.php"); ?>
</div>

</body>
</html>
<script>
    var obj = <?php
        require_once("../../APIClient.php");

        $events = APIClient::getTimeSlots(null, null, null, null, null, null);

        $obj_array = array();
        foreach($events as $e) {
            $obj_array[] = array(
                "start_date" => $e['startTime'],
                "end_date"   => $e['endTime']
            );
        }
        echo json_encode($obj_array);
    ?>
</script>

<?php echo json_encode($events); //Just for seeing when opening the page ?>

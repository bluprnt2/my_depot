<h1 class="page-header w3-yellow">Rowan University Drop-in Tutoring Application</h1>
<div id="home-container" class="w3-container">
    
    <div id="home-info" class="w3-panel w3-khaki w3-margin">
        <h2>Welcome</h2>
        <p>
           Drop-in Tutoring Services are offered in a variety of departments for 
           numerous courses. Tutoring is available free of charge to all Rowan 
           University undergraduate students. Students can hit the 'Schedule'
           button to see a list of all available times.
        </p>        
    </div>
    <div id="home-announce" class="w3-panel w3-gray">
        <a class="w3-bar-item w3-button w3-yellow " href="https://www.facebook.com/RowanUniversity/">Facebook</a>
        <a class="w3-bar-item w3-button w3-yellow" href="https://twitter.com/RowanUniversity">Twitter</a>
        
        <h2>Announcements</h2>
        <?php
        $announcements = APIClient::getAnnouncements(10);
        foreach ($announcements as $a) {
            /**
             * Title is an H2 element
             * Content is within a paragraph element
             */
            //echo "test ting '$a'";
            echo "<h3>" . $a->getTitle() . "</h3>\n";
            echo "<p>" . $a->getContent() . "</p>\n";
            //echo $a->getTitle() . "</br>";
            //echo $a->getContent() . "</br>";
        }
        ?>
    </div>
</div>

<!--<div class="w3-display-middle">
    <div class="w3-container w3-white w3-cell">

        <p> Drop-In Tutoring Services offers academic<br>
            support in a variety of subjects from different<br>
            departments in order to improve educational<br>
            achievement. Tutoring is available free of charge<br>
            to all Rowan University undergraduate students.<br>
            Drop-in tutoring is available in most subject<br>
            areas. Students can login to see the session available.<br>
        </p>
    </div>

    middle col
    <div class="w3-container w3-light-grey w3-cell">

        add nav bar
        <div class="w3-container w3-light-grey w3-cell">

            <a class="w3-bar-item w3-button w3-yellow " href="https://www.facebook.com/RowanUniversity/">Facebook</a>
            <a class="w3-bar-item w3-button w3-yellow" href="https://twitter.com/RowanUniversity">Twitter</a>
            
            //<?php
//              $announcements = APIClient::getAnnouncements(10);
//              foreach($announcements as $a){
//                  /**
//                   * Title is an H2 element
//                   * Content is within a paragraph element
//                   */
//                  //echo "test ting '$a'";
//                  echo "<h3>" . $a->getTitle() . "</h3>\n";
//                  echo "<p>" . $a->getContent() . "</p>\n";
//                //echo $a->getTitle() . "</br>";
//                //echo $a->getContent() . "</br>";
//              }
//            
?>
        </div>
    </div>
</div>-->

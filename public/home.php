<div class="w3-display-middle">
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

    <!--middle col-->
    <div class="w3-container w3-light-grey w3-cell">

        <!--add nav bar-->
        <div class="w3-container w3-light-grey w3-cell">

            <a class="w3-bar-item w3-button w3-yellow " href="https://www.facebook.com/RowanUniversity/">Facebook</a>
            <a class="w3-bar-item w3-button w3-yellow" href="https://twitter.com/RowanUniversity">Twitter</a>
            
            <?php
              $announcements = APIClient::getAnnouncements(10);
              foreach($announcements as $a){
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
</div>

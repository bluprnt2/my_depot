<div class="w3-display-middle">
    <div class="w3-container w3-white w3-cell">

        <p> Drop-In Tutoring Services offers academic <br></br>
            support in a variety of subjects from different<br></br>

            departments in order to improve educational<br></br>
            achievement. Tutoring is available free of charge<br></br>
            to all Rowan University undergraduate students.<br></br>
            Drop-in tutoring is available in most subject<br></br>
            areas. Students can login to see the session available.<br></br></p>
    </div>

    <!--middle col-->
    <div class="w3-container w3-light-grey w3-cell">

        <!--add nav bar-->
        <div class="w3-container w3-light-grey w3-cell">


            <a class="w3-bar-item w3-button w3-yellow" href="#">Twitter</a>
            <a class="w3-bar-item w3-button w3-yellow " href="#">Facebook</a>
            
            <?php
              $announcements = APIClient::getAnnouncements(1);
              foreach($announcements as $a){
                echo $a->getTitle() . "</br>";
                echo $a->getContent() . "</br>";
              }
            ?>
        </div>

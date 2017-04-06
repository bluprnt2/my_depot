<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 3/29/2017
 * Time: 9:39 PM
 */


/**
 * Feedback form structure
 *
 * Navigation Bar (included)
 *
 *
 *
 * 'Drop-in Tutoring Services'      H3 Header
 *
 * Container for Entire Form
 *      'Feedback Form'            H1 Header
 *      Form Element
 *          Input String   - Title
 *          Input Dropdown - Course
 *          Input Dropdown - Tutor
 *
 *          Input block - Comments
 *          Input Radio - Rating
 *
 *          Captcha
 *          Submit / Cancel Button
 *
 *  
 */





$title = "Drop-in Tutoring Feedback Form";
include("header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Subject: " . $_POST['subject'] . "\n";
    echo "Course: " . $_POST['course'] . "\n";
    echo "Tutor: " . $_POST['tutor'] . "\n";
    echo "<p>" . $_POST['comment'] . "</p>";
}

?>

<div class="w3-bar w3-border w3-light-grey">
    <?php
    include("navbar.php");
    ?>
</div>

<div class="w3-container w3-orange">
    <H3>Drop-in Tutoring Services</H3>
</div>
<div id="feedback-form-container" class="w3-container w3-display-middle w3-amber w3-leftbar w3-border w3-border-brown">
    <H1>Feedback Form</H1>
    <form id="feedback-form" action="testpage.php" method="POST">
        <div class="w3-margin-bottom">Subject: <input type="text" name="subject"></div>
        <div class="w3-margin-bottom">Course: 
            <select name="course">
                <?php
                $allcourses = APIClient::getCourses(null, null);
                foreach ($allcourses as $c){
                    $cname = $c->getName();                
                    echo "<option value=\"" . $cname . "\">" . $cname . "</option>";
                }            
                ?>
            </select>
        </div>
        <div class="w3-margin-bottom">Tutor: 
            <select name="tutor">
                <?php
                $allusers = APIClient::getUser(null);
                foreach ($allusers as $u){
                    $username = $u->getFirstName();
                    echo "<option value=\"" . strtolower($username) . "\">" . $username . "</option>";
                }            
                ?>
            </select>
        </div>
        
        <textarea name="comment" rows="20" cols="50">
            Comments
        </textarea>

        <button type="submit" name="submit">Submit</button>
        <button type="reset" name="clear">Clear</button>

        <?php
        /**
         * echo "
         *
         * Title:  <input type=\"text\" name=\"title\"></br>
         * Course: <input type=\"text\" name=\"course\"></br>
         * Tutor:  <input type=\"text\" name=\"tutor\"></br>
         * <textarea name=\"comment\" rows=\"20\" cols=\"50\">
         * Comments
         * </textarea>
         * ";
         */
        ?>

</form>
</div>

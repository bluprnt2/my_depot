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
include("../APIClient.php");

if (isset($_POST['submit'])) {
    //include("../APICLient/Survey.php");
    $id = 0;
    $course_id = $_POST['course'];
    $tutor_id = $_POST['tutor'];
    $rating = $_POST['rating'];
    $title = $_POST['subject'];
    $comment = $_POST['comment'];
    $viewed = 0;
    $survey = new Survey($id, $course_id, $tutor_id, $rating, $title, $comment, $viewed);
    APIClient::addSurvey($survey);
}
?>
<div class="w3-bar w3-border w3-light-grey">
    <?php
    include("navbar.php");
    ?>
</div>


<div class="w3-container" style="background-color: #800000; color: white;">
    <H3>Feedback</H3>
</div>
<div id="feedback-form-container" class="w3-container w3-light-grey w3-leftbar w3-border w3-border-grey">
    <H1>Feedback Form</H1>
    <form id="feedback-form" action="feedbackform.php" method="POST">
        <div class="w3-margin-bottom"><label>Subject: </label><input type="text" name="subject"></div>
        <div class="w3-margin-bottom"><label>Course: </label>
            <select name="course">
                <?php
                $allcourses = APIClient::getCourses(null, null);
                foreach ($allcourses as $c) {
                    $cname = $c->getName();
                    echo "<option value=\"" . $cname . "\">" . $cname . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="w3-margin-bottom"><label>Tutor: </label>
            <select name="tutor">
                <?php
                $allusers = APIClient::getUser(null);
                foreach ($allusers as $u) {
                    $username = $u->getFirstName();
                    echo "<option value=\"" . strtolower($username) . "\">" . $username . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="w3-margin-bottom"><label>Rating: </label>
            <div id="radio-buttons">
                <input type="radio" name="rating" value="5" checked> 5 (Great)
                <input type="radio" name="rating" value="4"> 4 (Good)
                <input type="radio" name="rating" value="3"> 3 (OK)
                <input type="radio" name="rating" value="2"> 2 (Bad)
                <input type="radio" name="rating" value="1"> 1 (Poor)
            </div>        
        </div>

        <textarea onfocus="clearText(this)" name="comment" rows="20" cols="50">     Enter any comments here!</textarea>

        <button type="submit" name="submit" style="background-color: #800000; color: white; font: Arial;">Submit</button>
        <button type="reset" name="clear" style="background-color: #800000; color: white; font: Arial;">Clear</button>

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

    <div id="modal" class="w3-modal">
        <div class="w3-modal-content w3-display-middle">
            <div class="w3-container">
                <span onclick="closeModal()" class="w3-button w3-display-topright">&times;</span>
                <p style="font-size: 3em;">Thank you for sending us feedback!</p>
            </div>
        </div>
    </div>

    <div class="w3-container">
        <?php include("footer.php"); ?>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        echo '<script>'
        . 'openModal()'
        . '</script>';
    } else {
        echo '<script>'
        . 'closeModal()'
        . '</script>';
    }
    ?>
</body>
</html>
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

}

?>


<div class="w3-container w3-red">
    <H3>Drop-in Tutoring Services</H3>
</div>
<div id="form-container" class="w3-container">
    <H1>Feedback Form</H1>
    <form action="" method="">
        <?php
        echo "
        Title:  <input type=\"text\" name=\"title\"></br>
        Course: <input type=\"text\" name=\"course\"></br>
        Tutor:  <input type=\"text\" name=\"tutor\"></br>
        <textarea name=\"comment\" rows=\"20\" cols=\"50\">
            Comments
        </textarea>
        ";
        ?>

    </form>
</div>

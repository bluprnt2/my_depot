<html>
    <head>
        <title>Session Logging</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    </head>
    <body>
           
        <!--Yellow bar -->
    <div class="w3-container w3-yellow">
       <p></p>  
    </div>
        <!--add nav bar -->
    <div class="w3-container">
        
    </div>
     <!-- search box -->   
    <div class="w3-bar w3-border w3-light-grey">
    <div>
    <?php
        
    include("navbar.php"); 
    ?>
    <input class="w3-input w3-border " type="text" placeholder="Search Rowan" style="width:15%" >
    </div>
    <!-- Brown bar with heading-->    
    <div class="w3-container w3-brown">
    <h1></h1>
    <h2>Session Logging - Drop In Tutoring Services</h2>
    </div>
    <img src ="background.jpg" alt = "Background" style="width:100%">
    <!--<div class="w3-display-topright"> <img src="RowanSeal.jpg" style="width:40%"> </div>-->
            
     <div class = "w3-display-container w3-display-middle w3-light-grey" 
          style ="height:400px; width:500px;margin-top:150px;margin:0 auto;text-align: center; border-radius: 10px; border-color: solid brown">
         <form>
             <h2>Tutor Check-In</h2>
        <p>
            <input class="w3-radio" type="radio" name = "tutor">
            <label>Tutor1</label>
            <input class="w3-radio" type="radio" name = "tutor">
            <label>Tutor2</label>
        </p>
        <p>
            Date:
            <input type="date" name="date">
        </p>
        <p>
            Time:
            <input type="time" name="time">
        </p>
        <p> Select a course
            <select name="Course"> 
         /*
                <?php
              $courses = APIClient::getCourses(null,null);
              foreach($courses as $a){
                echo $a->getName() . "</br>";
              }
         ?>*/
         <option value="Physics">Physics</option>
         <option value="Chemistry">Chemistry</option>
         <option value="Mathematics">Mathematics</option>
         <option value="IOOP">IOOP</option>
        </select>
        </p>
        <p> Tutor
            <select name="Tutor"> 
          /* 
         <option value="TutorA">Abcd</option>
         <option value="TutorB">B</option>
         <option value="TutorC">C</option>
         <option value="TutorD">D</option>
        </select>
        </p>
      
        <input type ="submit" value = " Log Session " class = "w3-button w3-brown">
        <input type="reset" value = " Clear Form " class = "w3-button w3-brown">
        </form>      
     </div>
   </body>
    
</html>

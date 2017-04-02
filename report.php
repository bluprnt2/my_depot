

<?php


$servername = "ec2-52-55-181-20.compute-1.amazonaws.com";
$username = "tutoradmin";
$password = "314Pip3R";
$dbname = "tutoroauthapi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Generate to export file TXT

if (isset($_POST['exp']) )
    
    {
 
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=report.txt');

    $output = fopen('php://output', 'w');

  

    $result = mysqli_query($conn, 'SELECT * FROM  Users');
    
echo "<table border='1'>";

$i = 0;
while($row = $result->fetch_assoc())
{
    if ($i == 0) {
      $i++;
      echo "<tr>";
      foreach ($row as $key => $value) {
        echo "<th>" . $key . "</th>";
      }
      echo "</tr>";
    }
    echo "<tr>";
    foreach ($row as $value) {
      echo "<td>" . $value . "</td>";
    }
    echo "</tr>";
}
echo "</table>";



mysqli_close($conn);

  exit();  

 }//end IF 




?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
   

    <head>
        <title>Report</title>
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
<!--<br> skip a line-->
<div class="w3-bar w3-border w3-light-grey">
   
  <a class="w3-bar-item w3-button " href="#">Home</a>
  <a class="w3-bar-item w3-button " href="#">About</a>
  <a class="w3-bar-item w3-button " href="#">Schedule</a>
  <a class="w3-bar-item w3-button" href="#">Feedback</a>
   <a class="w3-bar-item w3-button " href="#">RowanHome</a>
   <a class="w3-bar-item w3-button " href="#">Login</a>
   <input class="w3-input w3-border " type="text" placeholder="Search Rowan" style="width:15%" >
  
</div>

  <!--brown bar -->
        <div class="w3-container w3-brown">
       <h1></h1>
       <h2>Report</h2>
        </div>
  
  
  <div class="w3-panel w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-border-white w3-light-grey">
      
      <h2><strong>Generating a Report</h2> 
      <p>Select the type of report you want to generate and the type of information you want to display,<br></br>
     then click Generate. Afterwards, you can export a copy of the report as a .csv, .txt, or .html file.
       
           <div class="w3-display-topleft">
     
        </div>
  
  </p><!--end papagraph-->
  
  
  
         <div class="w3-container w3-lightgrey w3-cell">
        
        <div class="w3-panel w3-border w3-border-white">
  
          <h3><strong>Graph</h3>
  
         <form>
  
    <input class="w3-radio"  type="radio" name="colors"  id="txt">Pie<br>
    <input class="w3-radio"  type="radio" name="colors" id="csv">Bar<br>
    <input class="w3-radio"  type="radio" name="colors"id="html">Histogram<br>
  
      
        </form>
        <br></br> <!--skip line under histogram box-->
        </div>
       
   <button class="w3-round-large w3-block w3-brown" style="width:100%"  >Generate</button>
  
       
      <br></br>
        </div> <!--end graph box-->


    <div class="w3-container w3-light-grey w3-cell ">
    
    <div class="w3-panel w3-border w3-border-white">
      
        <h3><strong>Export</h3>
   
    <form>
  
    <input class="w3-radio" type="radio" name="colors"  id="txt">.txt<br>
    
    <input class="w3-radio"type="radio" name="colors" id="csv">.csv<br>
    <input class="w3-radio" type="radio" name="colors"id="html">.html<br>
    
    </form>
    <br></br> <!--skip line under html-->
   
    </div>     
    <!--export button to csv-->
 
     <form action="#" method="post">
      
    <input type="submit" class="w3-round-large w3-block w3-brown" style="width:100%"value="Export" name="exp" />
     </form>
     
      <br></br>
    </div><!--end checkedbox generate-->

    <br></br>
    </div><!--end grey panel-->
  
  



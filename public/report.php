	<?php
		require_once("../APIClient.php");
		$title = "Generate Report";
		include("header.php");
	?>
	<div id="kb-yellowbar"></div>
	<?php
		include("navbar.php");
		//only tutors and admins should be able to
		//access and modify the knowledge base.
		//check if the user is logged in,
		//if not, redirect them.
		
		if(!APIClient::isLoggedIn())
		{
			if(APIClient::isLoggedIn()) {
				echo "Logged In!";
			} else {
				echo "Login failed...";
			}
			//make note to update navbar on login
			//admin has option to view knowledge base but can remove files
			header('Location: ./index.php');
			echo '<p><a href="index.php">Only Tutors and Admins have access to the Knowledge Base</a><p>';
			exit();
		}
	?>

<?php

require_once("../APIClient.php");

//Generate to export file TXT

if (isset($_POST['exp']) )

    {

    header('Content-Type: text/csv; charset=utf-8');

    $answer = $_POST['color'];

    if ( $answer=="html")
    {
        header('Content-Disposition: attachment; filename=report.html');

    }

    else if ($answer=="txt")

    {
            header('Content-Disposition: attachment; filename=report.txt');
    }

    else
    {
          header('Content-Disposition: attachment; filename=report.csv');

    }



    $output = fopen('php://output', 'w');



    $announcements = APIClient::getAnnouncements(5);

echo "<table border='1'>";

echo "<tr>";
    echo "<th>Title</th>";
    echo "<th>Content</th>";
    echo "<th>User</th>";
    echo "<th>Time Posted</th>";
echo "</tr>";
foreach($announcements as $a) {
    echo "<tr>";
      echo "<td>" . $a->getTitle() . "</td>";
      echo "<td>" . $a->getContent() . "</td>";
      echo "<td>" . APIClient::getUser($a->getUserID())->getUserName() . "</td>";
      echo "<td>" . $a->getTimeStamp() . "</td>";
    echo "</tr>";
}
echo "</table>";

  exit();

 }//end IF

 if (isset($_POST['gen']) )

    {


    $answer = $_POST['graph'];


 switch($answer)

     {

     case 'pie':
     header("Location:pie.php ");
     break;
     case 'bar':
     header("Location:bar.php ");
     break;
     case 'col':
     header("Location:column.php ");
     break;

     }

 }//end IF


?>


         <!--add nav bar -->

        <div class="w3-container">


</div>

  <!--brown bar -->
        <div class="w3-container" style="background-color: #800000; color: white;">
       <h1></h1>
       <h2>Report</h2>
    </div>


  <div class="w3-panel w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-border-grey w3-light-grey">

      <h2><strong>Generating a Report</h2>
      <p>Select the type of report you want to generate and the type of information you want to display,<br></br>
     then click Generate. Afterwards, you can export a copy of the report as a .csv, .txt, or .html file.

           <div class="w3-display-topleft">

        </div>

  </p><!--end papagraph-->



         <div class="w3-container w3-lightgrey w3-cell">

        <div class="w3-panel w3-border w3-border-black">

          <h3><strong>Graph</h3>

      <form action="#" method="post">

    <input class="w3-radio"  type="radio" name="graph"  value="pie"> Pie<br>
    <input class="w3-radio"  type="radio" name="graph" value="bar" >Bar<br>
    <input class="w3-radio"  type="radio" name="graph" value="col">Column<br>



        <br></br> <!--skip line under histogram box-->
        </div>

   <input type="submit" class="w3-round-large w3-block" style="width:100%; background-color: #800000; color: white;" value="Generate" name="gen" />
     </form>

      <br></br>
        </div> <!--end graph box-->


    <div class="w3-container w3-light-grey w3-cell ">

    <div class="w3-panel w3-border w3-border-black">

        <h3><strong>Export</h3>

    <form action="#" method="post">

    <input class="w3-radio" type="radio" name="color" value="txt">.txt<br>
    <input class="w3-radio" type="radio" name="color" value="csv">.csv<br>
    <input class="w3-radio" type="radio" name="color" value="html">.html<br>

    <br></br> <!--skip line under html-->

    </div>
    <!--export button to csv-->


    <input type="submit" class="w3-round-large w3-block" onclick="text(); move();" style="width:100%; background-color: #800000; color: white;" value="Export"  name="exp" />
     </form>

      <br></br>
    </div><!--end checkedbox generate-->

    <br></br>

<body>

<p id="demo"></p>


 <div class=" w3-grey" style="width:50%">
  <div id="myBar" class="w3-container w3-green w3-center"></div>
</div>

<br>


<script>
function move() {
  var elem = document.getElementById("myBar");
  var width = 10;
  var id = setInterval(frame, 20);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++;
      elem.style.width = width + '%';
      elem.innerHTML = width * 1  + '%';
    }
  }
}

function text() {
    document.getElementById("demo").innerHTML = "Please wait a moment...the file is being exported";
}
</script>

<div id="kb-footer">
    <?php
        include("footer.php");
    ?>
</div>

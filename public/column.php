<!DOCTYPE HTML>
<html>

<head>  
<!-- <title>Rowan University Drop-in Tutor Application</title> -->
    <title>Rowan University Drop-in Tutor Application</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="bin/style.css">
</head>
<body>

<div class="w3-bar w3-border w3-light-grey">
    
        <a class="w3-bar-item w3-button" href="index.php">Home</a>
        <a class="w3-bar-item w3-button" href="#">About</a>
        <a class="w3-bar-item w3-button" href="scheduler.php">Schedule</a>
        <a class="w3-bar-item w3-button" href="feedbackform.php">Feedback</a>
        <a class="w3-bar-item w3-button" href="http://rowan.edu">Rowan Home</a>
    
            <a class="w3-bar-item w3-button" href="login.php">Login</a>            
        </div>

        <div class="w3-container">
    <p>Copyright &copy; 2017-2017 rowan.edu</p></div>
 <title>Basic HTML5 Column Chart </title>
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Tutoring Report Activities"    
      },
      animationEnabled: true,
      axisY: {
        title: "Percents"
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [

      {        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Comparison of Activities",
        dataPoints: [      
        {y: 21, label: "Announcements"},
        {y: 25,  label: "Courses" },
        {y: 33,  label: "TimeSlots"},
        {y: 36,  label: "Departments"},
            
        ]
      }   
      ]
    });

    chart.render();
  }
  </script>
  <script type="text/javascript" src="canvasjs-1.9.8/canvasjs.min.js"></script>
</head>
  <body>
  <div id="chartContainer" style="height: 300px; width: 100%;">
    </div>
  </body>
</html>

<!DOCTYPE html>
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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Announcement',     3],
          ['Courses',      5],
          ['TimeSlot',  6],
          ['Departments', 7],
         
        ]);

        var options = {
          title: 'Tutoring Report Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>

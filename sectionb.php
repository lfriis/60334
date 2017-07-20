<html>
  <head>
    <script src="https://www.gstatic.com/charts/loader.js"></script> <!-- Script source to pull gstatic table from server-->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {                                        //function to grab values from SQL database and present in a chart firmat
        var data = google.visualization.arrayToDataTable([
          ['Category', 'Count']
            <?php
              require_once 'login.php';                             //connecting to sql database
              $conn = new mysqli($hn, $un, $pw, $db);
                if ($conn->connect_error) die($conn->connect_error);

                $query = "SELECT CATEGORY,COUNT(*) AS 'cnt'
                          FROM `Classics`
                          group by CATEGORY";                       //query to pull respective information for graph

                $result = $conn->query($query);

                while ($row = mysqli_fetch_assoc($result)) {        //loop through each row and pull category and store amount of occurences to calculate %
                  echo ",['{$row['CATEGORY']}',{$row['cnt']}]\r\n";
                }
          ?>
        ]);

        var options = {title: 'Percentage of Publications', width:550, height:400};

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <h1>Assignment 4 Chart</h1>
    <div id="piechart"></div>
  </body>
</html>

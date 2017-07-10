<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mobile Survey</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" data-requiremodule="jQuery" type="text/javascript"></script>
    <link href="./css/bootstrap.css" rel="stylesheet">
    
    <link href="./css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src=".js/html5shiv.js"></script>
    <![endif]-->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['gauge','corechart']});

</script>

<script type="text/javascript">

    function drawBarChart(rawdata) {

      var graphdata = [
        ["Element", "Votes", { role: "style" } ]
      ];

      $.each(rawdata, function(i, row) {
        graphdata.push( [teams[row.Team], parseInt(row.VoteCount), "gold"]);
      })

      var data = google.visualization.arrayToDataTable(graphdata);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Hack to the Future Votes",
        width: 1000,
        height: 800,
        bar: {groupWidth: "90%"},
        bars: 'horizontal',
        hAxis: { ticks: [] },
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("DonutChart"));
      chart.draw(view, options);
  }
  </script>

<script>
var lastChecked = "all";

// URL of graph JSON landing page
//var graphURL = "http://pub.s4.exacttarget.com/tss40r4joam";
var graphURL = "http://pub.s4.exacttarget.com/1fpgn10x51m";
// URL of detail list JSON landing page
var detailURL = "http://pub.s4.exacttarget.com/wnar1q2ocnu";
var c = 0;
var t;
var n;

var teams = {1: 'Forty Two',
             2: 'Kakou',
             3: 'Powered By Coffee',
             4: 'Lillie Fro',
             5: 'Foundationeers',
             6: 'Find Give Keep',
             7: '50 Reefs',
             8: 'Cloud Walkers',
             9: 'Eleu'};


function createNotice(t) {

  $.ajax({
     crossDomain:true,
     url:graphURL+"?time="+t,
       dataType: 'jsonp',
       success:function(data){
          lastChecked = data.lastChecked;
          google.charts.setOnLoadCallback(drawBarChart(data.result));
       }
  });

  n = setTimeout("createNotice(lastChecked)", 5000);
}


$(function() {
  n = setTimeout("createNotice(lastChecked)", 5000);
})


</script>

   </head>

  <body>

  
            <div id="DonutChart">
            </div>

  </body>
</html>

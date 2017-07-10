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
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
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
        ["Element", "Density", { role: "style" } ],
        ["Copper", Value1, "#b87333"],
        ["Silver", Value2, "silver"],
        ["Gold", Value3, "gold"]
      ];

      $.each(rawdata, function(i, row) {
        graphdata.push([row.Team, row.VoteCount, "#b87333"]);
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
        title: "Density of Precious Metals, in g/cm^3",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
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
var Supporter = 0;
var Passive = 0;
var Detractor = 0;

function createNotice(t) {

	$.ajax({
		 crossDomain:true,
		 url:graphURL+"?time="+t,
	     dataType: 'jsonp',
	     success:function(data){
	     Supporter = Passive = Detractor = 0;
	         	$.each(data.result, function(i, result) {
            if (result.Response == "1") {
              Detractor++;
            } else if (result.Response == "2") {
              Passive++;
            } else {
              Supporter++;
            }
				})
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

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#">Mobile Survey - Please rate todays water quality at Frankston Beach</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div id="text" class="span4">
    			<div class="well">
    				<h4>text</h4><h2>WATER</h2> <h4>to</h4> <h2>0448 002 002</h2>
    			</div>
        </div>
		    <div id="messageAreaChart" class="span8">
            <center>
            <div id="DonutChart">
            </div>
            </center>
        </div>
      </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div id="text" class="span4">
        </div>
		    <div id="messageArea" class="span8">
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Salesforce Marketing Cloud 2017</p>
      </footer>
    </div>
  </body>
</html>

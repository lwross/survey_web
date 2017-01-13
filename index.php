<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mobile Surveys</title>
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

//Start: ******DONUT Chart***************// 
 function drawDonutChart(Value1, Value2, Value3) {

         // Create the data table for Anthony's pizza.
  var data = google.visualization.arrayToDataTable([
            ['Category', 'Score'],
            ['Below Average',Value1],
            ['Average',Value2],
            ['Crystal Clear',Value3],
          ]);

          var options = {
            pieHole: 0.3,
            pieSliceTextStyle: {
            color: 'black',
            },
            legend: 'none',
            backgroundColor: { fill:'transparent' },
            slices: {
              0: { color: '#66FD77' },
              1: { color: '#FDF565' },
              2: { color: '#FD6764' }
            },
            /*title: 'Survey Results' , */
            width: 350,
            height: 350,
            chartArea: { width: '90%', height: '90%'},
   };

        var chart = new google.visualization.PieChart(document.getElementById('DonutChart'));
        chart.draw(data, options);
      }
//End: ******DONUT Chart***************//
         
</script>

<script>
var lastChecked = "all";

var urlJSON = "http://pub.s4.exacttarget.com/tss40r4joam";
var c = 0;
var t;
var n;
var Supporter = 0;
var Passive = 0;
var Detractor = 0;

function createNotice(t) {
console.log(t);
	$.ajax({
		 crossDomain:true,
		 url:urlJSON+"?time="+t,
	     dataType: 'jsonp', 
	     success:function(data){
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

        /* debug */
        /*
        $('<div>'+Detractor+'</div>').hide().prependTo('#messageArea').slideDown("slow");
        $('<div>'+Passive+'</div>').hide().prependTo('#messageArea').slideDown("slow");
        $('<div>'+Supporter+'</div>').hide().prependTo('#messageArea').slideDown("slow");
        */

        /* draw chart */
        if ((Detractor != 0) || (Passive != 0) || (Supporter != 0)) {
          google.charts.setOnLoadCallback(drawDonutChart(Supporter,Passive,Detractor));
        }
		}
	});
	
	n = setTimeout("createNotice(lastChecked)", 5000);
}

$(function() {
	n = setTimeout("createNotice(lastChecked)", 5000);
	/*$("#messageArea").attr({
		scrollTop: $("#messageArea").attr("scrollHeight")
	}); */
})
	
</script>

   </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="brand" href="#">Mobile Survey</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div id="text" class="span4">
    			<div class="well">
    				<h4>text</h4><h2>CSAT</h2> <h4>to</h4> <h2>+61 448 002 002</h2>
    			</div>
        </div>
		    <div id="messageArea" class="span8">
            <center>
            <div id="DonutChart">
            </div>
            </center>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Salesforce Marketing Cloud 2017</p>
      </footer>
    </div>
  </body>
</html>



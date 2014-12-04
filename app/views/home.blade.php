
{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')
<?php

 $t= file_get_contents("http://forum.chandaya.info/discussion/poll/results/1");
 $start = strpos($t, "<span class=\"Number DP_VoteCount\">");
 $end = strpos($t, " votes", $start);
 $votes = intval(substr($t, $start+34, $end- $start - 34));

 $start = strpos($t, "DP_Bar DP_Bar-1");
 $start = strpos($t, ">", $start) + 1;
 $end = strpos($t, "%", $start);
 $mahinda = doubleval(substr($t, $start, $end- $start));

 $start = strpos($t, "DP_Bar DP_Bar-2");
 $start = strpos($t, ">", $start) + 1;
 $end = strpos($t, "%", $start);
 $my3 = doubleval(substr($t, $start, $end- $start));

?>
<input class="hidden" id="votes" value="<?php echo $votes?>">
<input class="hidden" id="mahinda" value="<?php echo $mahinda?>">
<input class="hidden" id="my3" value="<?php echo $my3?>">

    <div class="col-lg-12">

        <h1 class="page-header">
          <img src="../resources/logo.png" style="height: 100px">  Online Election Portal
        </h1>
    </div>
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default">
        <div class="panel-heading">Total Summary of past years</div>
        <div class="panel-body">
            <div id="overall_line_chart"></div>
        </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-info">
                <div class="panel-heading">Online election result</div>
                <div class="panel-body">
                    <div clas="row"><div id="piechart" class="panel-default panel-body" ></div></div>
                    <p>Total Votes: <?php echo $votes?></p>
                <a href="http://forum.chandaya.info/discussion/2/online-election-2015" class="btn btn-info btn-block">Vote Now</a>
                </div>
                </div>
    </div>
</div>
<div class="row">
<div class="col-lg-12">

<a href="http://forum.chandaya.info"> <img src="../resources/banner.png" ></a>

</div>
</div>
<script type="text/javascript">
    var MR = document.getElementById("mahinda");
    var MY3= document.getElementById("my3");
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {

        var data = google.visualization.arrayToDataTable([
                         ['Party', 'Votes'],
                         ['Mahinda Rajapaksha',     parseFloat(MR.value)],
                         ['Mithreepala Sirisena',     parseFloat(MY3.value)]
        ]);

               var options = {
                is3D: true,
                colors: ['blue', 'green'],
                backgroundColor: 'transparent',
                legend: {position: 'none'}
               };

               var chart = new google.visualization.PieChart(document.getElementById('piechart'));

               chart.draw(data, options);
             }
           </script>
@stop

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawDistrictChart);
      function drawDistrictChart() {
        var data = new google.visualization.DataTable();
                data.addColumn('string', 'Year');
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addRows(<?php echo(json_encode($chartData)); ?>);

        var options = {
          pointSize: 5,
          colors:['green', 'blue', 'orange'],
          annotation: {3: {style: 'line'}, 5: {style: 'line'}, 7: {style: 'line'}},
          legend:'none'
        };

        var chart = new google.visualization.LineChart(document.getElementById('overall_line_chart'));

        chart.draw(data, options);
      }
</script>
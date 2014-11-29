{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')

    <h2>Summary results for {{$district[0]->name}} district</h2>

    <div class="container">
        <div class="row">
            <div id="district_summary_line" class="panel-body"></div>
        </div>
    </div>
@endsection

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance'
        };

        var chart = new google.visualization.LineChart(document.getElementById('district_summary_line'));

        chart.draw(data, options);
      }
</script>
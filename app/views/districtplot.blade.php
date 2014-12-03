{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')

<?php echo (json_encode($seatChartData[0])) ?>
    <div class="page-header">
        <h2> {{$district[0]->name}} District</h2>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <!--<img src="http://srilankatravelnotes.com/BADULLA/images/BadullaDistrictMap.JPG">-->
            </div>
            <div class="col-md-10">
                <div id="district_summary_line" style="min-height: 400" class="panel-default panel-body"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <h4>Seat Statistics</h4>
                @foreach($seats as $seat)

                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne_{{$seat->id}}">
                      <h4 class="panel-title">
                        {{$seat->name}}
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{$seat->id}}" aria-expanded="false" aria-controls="collapseOne_{{$seat->id}}">
                          <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne_{{$seat->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_{{$seat->id}}">
                      <div class="panel-body">
                        <div id="linechart_{{$seat->id}}"></div>
                      </div>
                    </div>
                  </div>

                  @endforeach

                </div>
            </div>
        </div>

    </div>
@endsection

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawDistrictChart);
      google.setOnLoadCallback(drawChart);
      function drawDistrictChart() {
        var data = new google.visualization.DataTable();
                data.addColumn('string', 'Year');
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addRows(<?php echo(json_encode($distChartData)); ?>);

        var options = {
          pointSize: 5,
          colors:['green', 'blue', 'orange'],
          annotation: {3: {style: 'line'}, 5: {style: 'line'}, 7: {style: 'line'}},
          legend:'none'
        };

        var chart = new google.visualization.LineChart(document.getElementById('district_summary_line'));

        chart.draw(data, options);
      }

      function drawChart() {

      var options = {
        pointSize: 5,
        colors:['green', 'blue', 'orange'],
        annotation: {3: {style: 'line'}, 5: {style: 'line'}, 7: {style: 'line'}},
        legend:'none'
      };

      @foreach($seats as $seat)
            var data = google.visualization.DataTable();

            data.addColumn('string', 'Year');
            data.addColumn('number', 'Votes');
            data.addColumn({type: 'string', role: 'annotation'});
            data.addColumn('number', 'Votes');
            data.addColumn({type: 'string', role: 'annotation'});
            data.addColumn('number', 'Votes');
            data.addColumn({type: 'string', role: 'annotation'});


            @foreach($seatChartData as $data)

            @if($data['seat'] == $seat->id)
                data.addRows(<?php echo(json_encode($data['arr'])); ?>);
            @endif

            @endforeach

            var chart = new google.visualization.LineChart(document.getElementById('linechart_{{$seat->id}}'));

            chart.draw(data, options);

        @endforeach
      }


</script>
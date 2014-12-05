{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')
    <br>
    <div class="row">

    </div>
    <nav class="navbar navbar-default">
          <div class="container-fluid">
        {{ Form::open(array('url'=>'districtplot','name'=>'changeresult','class'=>'navbar-form navbar-left')) }}

                District&nbsp;

                 {{Form::select('district_id',$districts,$district[0]->id,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}


    </div></nav>
    <div class="page-header">
        <h2> {{$district[0]->name}} District</h2>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div style="margin-top: 6.5%; padding-right: 0;"class="col-md-2">
                <img src="../district.svg" usemap="#map" id="myImage" name="myImage">
                <map id="map" name="map">
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
                        <a style="display: block; width: 100%" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{$seat->id}}" aria-expanded="false" aria-controls="collapseOne_{{$seat->id}}">
                          {{$seat->name}} <i class="fa fa-bar-chart-o fa-fw pull-right"></i>
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne_{{$seat->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_{{$seat->id}}">
                      <div class="panel-body">
                        <div align="center" id="linechart_{{$seat->id}}"></div>
                      </div>
                    </div>
                  </div>

                  @endforeach

                </div>
            </div>
        </div>

    </div>
<script src="../js/jquery.maphilight.js" ></script>
<script>
      jQuery(function()
      {
          $('#map').load('../map.html', function(responseData){
          //After the map is loaded
              $("area").each(function(){
                  //give the href to a district.
                  this.href=""+this.alt;
                  //give an always on color to one district.
                  if(this.alt=="{{$district[0]->name}}"){
                      $(this).attr("data-maphilight","{\"fillColor\": \"ff0000\", \"alwaysOn\": true}");
                  }
              });
              
              $('#myImage').maphilight({
                  fade: false,
                  groupBy: 'alt',
                  fillColor: 'aabb00',
                  alwaysOn: false,
                  strokeColor: 'ffffff',
                  strokeWidth: 0
              });
          })

          
        })
</script>
@endsection

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
</script>

@foreach($seats as $seat)
<script type="text/javascript">
      //google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawSeatCharts);
      function drawSeatCharts() {
        var data = new google.visualization.DataTable();
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
                      @break
                  @endif
              @endforeach

        var options = {
            pointSize: 5,
            colors:['green', 'blue', 'orange'],
            annotation: {3: {style: 'line'}, 5: {style: 'line'}, 7: {style: 'line'}},
            legend:'none',
            width: 900,
            height: 300
        };


        new google.visualization.LineChart(document.getElementById('linechart_{{$seat->id}}')).draw(data, options);
      }
</script>
@endforeach


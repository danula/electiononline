{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')


<nav style="margin-top: 20px; padding-left: 30px" class="navbar navbar-default">
      <div class="row">
            {{ Form::open(array('url'=>'districtplot','name'=>'changeresult','class'=>'navbar-form navbar-left')) }}

            District&nbsp;

            {{Form::select('district_id',$districts,$district[0]->id,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}
    </div>
</nav>
<div class="page-header">
    <h2> {{$district[0]->name}} District</h2>
</div>
<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div style="margin-top: 6.5%; padding-right: 0;">
            <img src="../district2.png" width=230 usemap="#map" id="myImage" name="myImage"></img>
            <map id="map" name="map"></map>
        </div>

    </div>
    <div style="height: 50%" class="col-md-9 col-sm-12 col-xs-12">
        <div id="district_summary_line" style="width: 100%; height: 100%" class="panel-default panel-body"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
        <h4>Seat Statistics</h4>
        @foreach($seats as $seat)

          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne_{{$seat->id}}">
              <h4 class="panel-title">
                <a style="display: block; width: 100%" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne_{{$seat->id}}" aria-expanded="false" aria-controls="collapseOne_{{$seat->id}}">
                  {{$seat->name}} <i class="fa fa-bar-chart-o fa-fw pull-right"></i>
                </a>
              </h4>
            </div>
            <div id="collapseOne_{{$seat->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_{{$seat->id}}">
              <div class="panel-body">
                <div style="width:100%" align="center" id="linechart_{{$seat->id}}"></div>
              </div>
            </div>
          </div>

          @endforeach

        </div>
    </div>
</div>


<script src="../js/jquery.imagemapster.min.js" ></script>
<script>
      jQuery(function()
      {
          $('#map').load('../map.html', function(responseData){
          //After the map is loaded
              $("area").each(function(index){
                  var coords = $(this).attr("coords");
                  var width = $('#myImage').attr("width");
                  var height = 792.0*width/612.0;
                  var res = coords.split(",");
                  var s = "";
                  var num;
                  for(var i = 0; i < res.length; i++ ){
                    if(i!=0)
                        s = s +",";
                    num = parseFloat(res[i])*width/612.0;
                    s=s+num.toString();
                    
                  }
                  $(this).attr("coords",  s);
                  //give the href to a district.
                  this.href=""+this.alt;
              });
              $('#myImage').mapster({
                    //scaleMap: true,
                    clickNavigate: true,
                    isSelectable: false,
                    mapKey: 'alt',
                    fillColor: 'CC0099',
                    fillOpacity: 0.3,
                    showToolTip:true,
                    toolTipContainer: '<div> </div>',
                    areas: [
                        @foreach($districts as $d)
                        {
                            key: '{{$d}}',
                            toolTip:'<b>{{$d}} District</b><br><p style="font-size: 60%;">Click to navigate</p>'
                            @if ($d === $district[0]->name)
                            ,
                            selected: true,
                            @endif
                        },
                        @endforeach
                        {}
                    ]
              });
              $('#myImage').mapster('tooltip','alt');
              
          })
          
        });
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
          //chartArea: {width: '80%', height: '30%'}
        };
        var chart = new google.visualization.LineChart(document.getElementById('district_summary_line'));
        chart.draw(data, options);
      }
</script>


<script type="text/javascript">
      //google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawSeatCharts);
      function drawSeatCharts() {
        var options = {
            pointSize: 5,
            colors:['green', 'blue', 'orange'],
            annotation: {3: {style: 'line'}, 5: {style: 'line'}, 7: {style: 'line'}},
            legend:'none',
            width: '900'
        };
        var seatChartData = JSON.parse('{{json_encode($seatChartData)}}');
        for (var key in seatChartData) {
              var data = new google.visualization.DataTable();
              data.addColumn('string', 'Year');
              data.addColumn('number', 'Votes');
              data.addColumn({type: 'string', role: 'annotation'});
              data.addColumn('number', 'Votes');
              data.addColumn({type: 'string', role: 'annotation'});
              data.addColumn('number', 'Votes');
              data.addColumn({type: 'string', role: 'annotation'});
              data.addRows(seatChartData[key]);

              new google.visualization.LineChart(document.getElementById('linechart_'+key)).draw(data, options);
        }
      }
</script>

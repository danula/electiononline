@extends('master')
@section('content')
<nav style="margin-top: 20px; padding-left: 30px; background-color: transparent" class="navbar navbar-default" >
    <div class="row">
        {{ Form::open(array('url'=>'districtplot','name'=>'changeresult','class'=>'navbar-form navbar-left')) }}
        District&nbsp;
        {{Form::select('district_id',$districts,$district[0]->id,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}
    </div>
</nav>
<div class="page-header">
    <h2> {{$district[0]->name}} District</h2>
</div>
<!-- Top Row -->
<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div style="margin-top: 6.5%; padding-right: 0;">
            <img src="../district2.png" width=230 usemap="#map" id="myImage" name="myImage"></img>
            <map id="map" name="map"></map>
        </div>
    </div>
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="box box-primary">
            <div class="box-body chart-responsive">
                <div class="chart" id="district_summary_line" style="height: 325px"></div>
            </div>
        </div>
    </div>
</div>

{{HTML::script("../js/jquery.imagemapster.min.js");}}
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

<!-- Morris.js charts -->
{{HTML::script("//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js");}}
{{HTML::script("/js/plugins/morris/morris.min.js");}}
<script type="text/javascript">
    Morris.Line({
        element: 'district_summary_line',
        resize: true,
        data: [
            @foreach($distChartData as $row)
                {{$row}},
            @endforeach
        ],
        xkey: 'year',
        ykeys: ['win','sec','oth'],
        lineColors: ['#53A336','#0070D1', '#FF8000'],
        parseTime: false,
        labels: ['Series A', 'Series B','Series C'],
        hoverCallback: function (index, options, content) {
            var row = options.data[index];
            return '<div class="hover-title">' + row.year + '</div>'+
                   '<span>' + row.winP + ': </span><b style="color: ' + options.lineColors[0] + '">' + row.win.toLocaleString() + '</b><br/>'+
                   '<span>' + row.secP + ': </span><b style="color: ' + options.lineColors[1] + '">' + row.sec.toLocaleString() + '</b><br/>'+
                   '<span> Others: </span><b style="color: ' + options.lineColors[2] + '">' + row.oth.toLocaleString() + '</b>';
        }
    });
</script>


<!-- Jquery UI -->
{{HTML::script("//code.jquery.com/ui/1.11.1/jquery-ui.min.js");}}
<!-- AdminLTE dashboard demo -->
{{HTML::script("/js/AdminLTE/dashboard.js");}}

<!-- Seat Statistics -->
<div class="row">
    <h2 class="page-header">Seat Statistics</h2>
    <!-- Left col -->
    <section class="col-lg-6 col-md-6 col-sm-12 connectedSortable" id="leftColumn"></section>
    <!-- right col -->
    <section class="col-lg-6 col-md-6 col-sm-12 connectedSortable" id="rightColumn"></section>
</div>

<script type="text/javascript">
@foreach($seats as $seat)
    var left = document.getElementById("leftColumn").innerHTML;
    var right = document.getElementById("rightColumn").innerHTML;
    @if(intval($seat->id) % 2 != 0)
    document.getElementById("leftColumn").innerHTML = left +
    '<div class=\"box box-default\">'+
        '<div class=\"box-header\">'+
            '<h3 class=\"box-title\">{{$seat->name}}</h3>'+
        '</div>'+
        '<div class=\"box-body chart-responsive\">' +
        '<div class=\"chart\" id=\"seat_line_chart_{{$seat->id}}\" style=\"height: 200px\"></div>'+
        '</div>'+
    '</div>';
    @else
    document.getElementById("rightColumn").innerHTML = right +
    '<div class=\"box box-default\">'+
        '<div class=\"box-header\">'+
            '<h3 class=\"box-title\">{{$seat->name}}</h3>'+
        '</div>'+
        '<div class=\"box-body chart-responsive\">' +
        '<div class=\"chart\" id=\"seat_line_chart_{{$seat->id}}\" style=\"height: 200px\"></div>'+
        '</div>'+
    '</div>';
    @endif
@endforeach
</script>
@endsection

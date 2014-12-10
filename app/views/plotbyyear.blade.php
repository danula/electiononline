
{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')

<script type="text/javascript">
jQuery(document).ready(function($) {
      $("tr").click(function() {
            window.location = $(this).attr("href");
      });
      $("tr").css({"cursor":"pointer"});
});

window.onload = function() {
  document.getElementById('collapseThree').className = 'panel-collapse';
};
</script>
<div class="container">
        <div class="row"><h1>Summary Results:  {{$year}}</h1><br></div>
        <img src="" id="candidate_1" class="img-thumbnail" style="width: 140px; float: right; ">
        <img src="" id="candidate_2"  class="img-thumbnail" style="width: 140px; float: left; ">
        <input class="hidden" id="yearHidden" value="{{$year}}" />
       <div clas="row"><div id="piechart" class="panel-default panel-body" style="width: 100%; height: 62%;"></div></div>


        <div class="row">
          <div class="col-md-4">
            <img src="../district4.png" width=400 usemap="#map" id="myImage" name="myImage" style="color: white"></img>
            <map id="map" name="map" ></map>
          </div>

          <div class="col-md-8" id="tablesdiv">
          <h3 id="distHead">Colombo District Results</h3>

           @foreach($districts as $d)
            <table id="{{$d->name}}" class="table table-striped table-bordered table-hover table-hide" 
            @if($d->name != 'Colombo')
            style="display:none"
            @endif
            >
                <thead>
                <tr href="#">
                    <th>Candidate</th>
                    <th>Votes</th>
                    <th>Percentage</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                @foreach($results[$d->id] as $candidate_id=>$r)
                <?php
                    $i = $i + 1;
                    if ($i == 6)
                        break;
                    $c = $candidatesById[$candidate_id];
                ?>
                <tr href="{{URL::to('candidate/'.$year.'/'.$c->name)}}">
                    <td>{{{$c->name}}}</td>
                    <td>{{{$r->number_of_votes}}}</td>
                    <td>{{number_format($r->number_of_votes/$distResult[$d->id]->polled_votes*100,2)}}%</td>
                </tr>
                @endforeach
                <b>
                <tr class="info" href="#">
                    <td>Polled Votes</td>
                    <td>{{{$distResult[$d->id]->polled_votes}}}</td>
                    <td>{{number_format($distResult[$d->id]->polled_votes/$distResult[$d->id]->registered_votes*100,2)}}%</td>
                </tr>
                <tr class="info" href="#">
                    <td>Rejected Votes</td>
                    <td>{{{$distResult[$d->id]->rejected_votes}}}</td>
                    <td></td>
                </tr>
                <tr class="info" href="#">
                    <td>Registered Votes</td>
                    <td>{{{$distResult[$d->id]->registered_votes}}}</td>
                    <td></td>
                </tr>
                <tr class="info" href="#">
                    <td>Valid Votes</td>
                    <td>{{{$distResult[$d->id]->valid_votes}}}</td>
                    <td></td>
                </tr>

                </b>
                </tbody>

            </table>
            @endforeach
            
          <a id="distLink" href="../districtresult/Colombo/{{$year}}">Click here for full results</a>
            </div>
            </div>
       <div class="container">
        <p>Select district for detailed summary</p>
        <br>
            
           </div>
           </div>

        <script type="text/javascript">
             google.load("visualization", "1", {packages:["corechart"]});
             google.setOnLoadCallback(drawChart);
             function drawChart() {
                var _year = document.getElementById("yearHidden");
                var year = _year.value;
                var data = google.visualization.arrayToDataTable([]);
                
                data = google.visualization.arrayToDataTable([
                         ['Party', 'Votes'],
                         ['{{$candidates[0]->name}}',     {{$candidates[0]->number_of_votes}}],
                         ['{{$candidates[1]->name}}',     {{$candidates[1]->number_of_votes}}],
                         ['Other',  {{$all[$year]-$candidates[0]->number_of_votes-$candidates[1]->number_of_votes}}],
                         ]);
                         document.getElementById("candidate_1").src = "../resources/candidates/{{$candidates[0]->id}}.jpg";
                         document.getElementById("candidate_2").src = "../resources/candidates/{{$candidates[1]->id}}.jpg";
                    
               var options = {
                is3D: true,
                colors: ['#{{$candidates[0]->logo}}', '#{{$candidates[1]->logo}}', '#c4c4c4', '#f3b49f', '#f6c7b6'],
                backgroundColor: 'transparent',
                legend: { position: 'labeled' }
               };

               var chart = new google.visualization.PieChart(document.getElementById('piechart'));

               chart.draw(data, options);
             }
           </script>

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
                  this.href="#";
              });

              $('#myImage').mapster({
                    //scaleMap: true,
                    clickNavigate: true,
                    isSelectable: false,
                    mapKey: 'alt',
                    fillColor: 'ffffff',
                    fillOpacity: 0.7,
                    showToolTip:true,
                    strokeColor: 'ffffff',
                    stroke: true,
                    strokeWidth:0.8,
                    toolTipContainer: '<div style="background-color:White"> </div>',
                    onClick: function clickHandler(data) {
                        $(".table-hide").each(function(index){
                            $(this).attr('style', 'display:none');
                        })
                        $('#distHead').html(data.key + ' District Results');
                        $('#distLink').attr('href', '../districtresult/'+(data.key)+'/{{$year}}');
                        $('#'+data.key).attr('style', 'display:block');
                    },
                    areas: [
                        <?php
                        
                        foreach($districts as $d){
                            $total = 0;
                            reset($results[$d->id]);
                            $i = 0;
                            $color = 'ffffff';
                            $opacity = 0.5;
                            $text = '';
                            foreach($results[$d->id] as $candidate_id => $c) {
                                $c = $candidatesById[$candidate_id];
                                //echo $c->name.' ';
                                $percentage =  ($results[$d->id][$candidate_id]->number_of_votes*100.0/$distResult[$d->id]->valid_votes);
                                //echo $percentage;
                                $text = $text.'<li type="square" style="color:#'.$c->logo.'">'.
                                    $c->party.' - '.round($percentage, 2).'% </li>';
                                if($i == 0) {
                                    $color = $c->logo;
                                    $opacity = 0.5+ ($percentage-50)/30;
                                    if($opacity < 0.4)
                                        $opacity = 0.4;
                                }
                                else if($i == 1)
                                    break;
                                $i = $i+1;
                            }
                            //$win = [key($results[$d->id])]->candidate_id;
                            
                            
                            //echo $win;
                        
                        ?>
                            {
                                key: '{{$d->name}}',
                                toolTip:'<b>{{$d->name}} District</b><br>{{$text}}',
                                fillColor:'{{$color}}',
                                fillOpacity:'{{$opacity}}',
                                selected: true
                            },
                        <?php
                        }
                        ?>
                        {}
                    ]
              });
              $('#myImage').mapster('tooltip','alt');
              
          })
          
        });
</script>
@stop

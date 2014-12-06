
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
        <div class="row"><h1>Summary Results:  {{$year}}</h1><br></div>
        <img src="" id="candidate_1" class="img-thumbnail" style="width: 140px; float: right; ">
        <img src="" id="candidate_2"  class="img-thumbnail" style="width: 140px; float: left; ">
        <input class="hidden" id="yearHidden" value="{{$year}}" />
       <div clas="row"><div id="piechart" class="panel-default panel-body" style="width: 100%; height: 62%;"></div></div>
<img src="../district2.png" width=230 usemap="#map" id="myImage" name="myImage"></img>
                <map id="map" name="map" ></map>

       <div class="container">
        <p>Select district for detailed summary</p>
        <br>
            <table class="table table-hover">

                <tr>
                    <th>District</th>
                     @foreach($candidates as $d)

                       <th>{{substr($d->name, 0, 18)}}</th>
                     @endforeach
                </tr>
                @foreach($districts as $d)

                    <tr href='{{url("/districtresult/".$d->name."/".$year,"")}}'> <th scope="row" >{{$d->name}}</th>
                    @foreach($candidates as $cd)
                             <td>{{$results[$d->id][$cd->id]->number_of_votes}}</td>
                    @endforeach

                    </tr>

                @endforeach
            </table>
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
                colors: ['blue', 'green', 'orange', '#f3b49f', '#f6c7b6'],
                backgroundColor: 'transparent',
                legend: { position: 'labeled' }
               };

               var chart = new google.visualization.PieChart(document.getElementById('piechart'));

               chart.draw(data, options);
             }
           </script>

<script src="../js/jquery.imagemapster.js" ></script>
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
                    fillOpacity: 0.7,
                    showToolTip:true,
                    toolTipContainer: '<div style="background-color:White"> </div>',
                    areas: [
                        <?php
                        $UNP = array(1982=>70, 1988=> 60, 1994=> 53, 1999=>88, 2005=>10, 2010=>20);
                        $SLFP = array(1982=>71, 1988=> 61, 1994=> 51, 1999=>85, 2005=>9, 2010=>21);
                       
                        
                        foreach($districts as $d){
                            $total = 0;
                            reset($results[$d->id]);
                            $i = 0;
                            $color = '000000';
                            $text = '';
                            foreach($results[$d->id] as $candidate_id => $c) {
                                $c = $candidatesById[$candidate_id];
                                //echo $c->name.' ';
                                $percentage =  ($results[$d->id][$candidate_id]->number_of_votes*100.0/$distResult[$d->id]->polled_votes);
                                //echo $percentage;
                                $text = $text.'<li type="square" style="color:#'.$c->flag.'">'.
                                    $c->party.' - '.round($percentage, 2).'% </li>';
                                if($i == 0)
                                    $color = $c->flag;
                                else if($i == 2)
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

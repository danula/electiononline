
{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')

@section('scripts')
<script src="../js/jquery-ui.min.js"></script>
<script src="../js/jquery-ui-slider-pips.min.js"></script>
<script src="../js/jquery.imagemapster.min.js" ></script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui-slider-pips.css">
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
@endsection

@section('content')
    <br/>
        <div class="row">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                
                <select  class="form-control" id="yearValue" >
                  <option value="2010">2010</option>
                  <option value="2005">2005</option>
                  <option value="1999">1999</option>
                  <option value="1994">1994</option>
                  <option value="1988">1988</option>
                  <option value="1982">1982</option>
                </select>
              </div>
            </nav>
        </div>
        
        <div class="row"><h1 id="summary">Summary Results: 2010</h1><br></div>
        <img src="" id="candidate_1" class="img-thumbnail" style="width: 140px; float: right; ">
        <img src="" id="candidate_2"  class="img-thumbnail" style="width: 140px; float: left; ">
        
       <div clas="row"><div id="piechart" class="panel-default panel-body" style="width: 100%; height: 62%;"></div></div>


        <div class="row">
          <div class="col-md-4">
            <img src="../district4.png" width=400 usemap="#map" id="myImage" name="myImage" style="color: white"></img>
            <map id="map" name="map" ></map>
          </div>

          <div class="col-md-8" id="tablesdiv">
          <h3 id="distHead">Colombo District Results</h3>
          @foreach($years as $year)
           @foreach($districts as $d)
            <table id="{{$year.$d->name}}" class="table table-striped table-bordered table-hover table-hide" 
            @if($d->name != 'Colombo' || $year != 2010)
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
                @foreach($results[$year][$d->id] as $candidate_id=>$r)
                <?php
                    $i = $i + 1;
                    if ($i == 6)
                        break;
                    $c = $candidatesById[$candidate_id];
                ?>
                <tr href="{{URL::to('candidate/'.$year.'/'.$c->name)}}">
                    <td>{{{$c->name}}}</td>
                    <td>{{{$r->number_of_votes}}}</td>
                    <td>{{number_format($r->number_of_votes/$distResult[$year][$d->id]->polled_votes*100,2)}}%</td>
                </tr>
                @endforeach
                <b>
                <tr class="info" href="#">
                    <td>Polled Votes</td>
                    <td>{{{$distResult[$year][$d->id]->polled_votes}}}</td>
                    <td>{{number_format($distResult[$year][$d->id]->polled_votes/$distResult[$year][$d->id]->registered_votes*100,2)}}%</td>
                </tr>
                <tr class="info" href="#">
                    <td>Rejected Votes</td>
                    <td>{{{$distResult[$year][$d->id]->rejected_votes}}}</td>
                    <td></td>
                </tr>
                <tr class="info" href="#">
                    <td>Registered Votes</td>
                    <td>{{{$distResult[$year][$d->id]->registered_votes}}}</td>
                    <td></td>
                </tr>
                <tr class="info" href="#">
                    <td>Valid Votes</td>
                    <td>{{{$distResult[$year][$d->id]->valid_votes}}}</td>
                    <td></td>
                </tr>

                </b>
                </tbody>

            </table>
            @endforeach
            @endforeach
          <a id="distLink" href="../districtresult/Colombo/{{$year}}">Click here for full results</a>
            </div>
            </div>
       <div class="container">
        <p>Select district for detailed summary</p>
        <br>
            
           </div>

        <script type="text/javascript">
             google.load("visualization", "1", {packages:["corechart"]});
             google.setOnLoadCallback(drawChart);
             function drawChart() {
                drawChartYear(2010);
             }
             function drawChartYear(year) {
                switch(year) {
                @foreach($years as $year)
                    case {{$year}}:
                    var data = google.visualization.arrayToDataTable([]);
                    
                    data = google.visualization.arrayToDataTable([
                             ['Party', 'Votes'],
                             ['{{$candidates[$year][0]->name}}',     {{$candidates[$year][0]->number_of_votes}}],
                             ['{{$candidates[$year][1]->name}}',     {{$candidates[$year][1]->number_of_votes}}],
                             ['Other',  {{$all[$year]-$candidates[$year][0]->number_of_votes-$candidates[$year][1]->number_of_votes}}],
                             ]);
                             document.getElementById("candidate_1").src = "../resources/candidates/{{$candidates[$year][0]->id}}.jpg";
                             document.getElementById("candidate_2").src = "../resources/candidates/{{$candidates[$year][1]->id}}.jpg";
                        
                   var options = {
                    is3D: true,
                    colors: ['#{{$candidates[$year][0]->logo}}', '#{{$candidates[$year][1]->logo}}', '#c4c4c4', '#f3b49f', '#f6c7b6'],
                    backgroundColor: 'transparent',
                    legend: { position: 'labeled' }
                   };

                   var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                   chart.draw(data, options);
                   break;
                @endforeach
               }//end switch
             }
           </script>
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
          mapplot(2010);
      });
      
    function mapplot(year) {
        switch (year) {
            @foreach($years as $year)
            case {{$year}}:
             $('#myImage').mapster();
            $('#myImage').mapster('rebind', {
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
                    updateTable(data.key, {{$year}});
                },
                areas: [
                    <?php
                    
                    foreach($districts as $d){
                        $total = 0;
                        reset($results[$year][$d->id]);
                        $i = 0;
                        $color = 'ffffff';
                        $opacity = 0.5;
                        $text = '';
                        foreach($results[$year][$d->id] as $candidate_id => $c) {
                            $c = $candidatesById[$candidate_id];
                            $percentage =  ($results[$year][$d->id][$candidate_id]->number_of_votes*100.0/
                                                $distResult[$year][$d->id]->valid_votes);
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
          }).mapster('tooltip','alt');
          break;
          @endforeach
          } //end switch
          
        } // end function
      

    function updateTable(district, year) {
        //Hide all tables
        $(".table-hide").each(function(index){
            $(this).attr('style', 'display:none');
        })
        // Update district name
        $('#distHead').html(district + ' District Results');
        // Update link for full results
        $('#distLink').attr('href', '../districtresult/'+district+'/'+year);
        // Show relevant table
        $('#'+year+district).attr('style', 'display:block');
    }
    $('#yearValue').change(
        function() {
            var year = parseInt($(this).val());

            // Update header
            $('#summary').html('Summary Results: '+year);
            drawChartYear(year);
            mapplot(year);
            updateTable('Colombo', year);
        }
    );
       
});

    
</script>
@stop

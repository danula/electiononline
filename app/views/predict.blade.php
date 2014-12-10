
{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')
<link href="../css/slider.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.1/modernizr.min.js"></script>
<script src="https://strukturedkaos.github.io/kickdrop-drops/drops/sliders/js/plugin.js"></script>
<script href="js/bootstrap-slider.js" type="text/javascript"></script>
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
<div class="row"><h1>My Predictions for 2015</h1><br></div>
    <div class="row">
    
    </div>
    <div class="row">
        <div class="col-lg-3">

        {{HTML::image('/resources/candidates/MR.jpg','photo',array('name'=>'photo','height'=>'220px'))}}
        </div>
        
        <div class="col-lg-3 col-md-6">  
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <div id="totalUPFA"  class="huge">1231231</div>
                            <div id="percentageUPFA" >65% Votes</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">

                        </div>
                        <div class="col-xs-9 text-right">
                            <div id="totalNDF" class="huge">1231231 </div>
                            <div id="percentageNDF">75% Votes</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">

        {{HTML::image('/resources/candidates/SF.jpg','photo',array('name'=>'photo','height'=>'220px'))}}
        </div>
     </div>
        <div class="row">
          <div class="col-md-4">
            <img src="../district4.png" width=400 usemap="#map" id="myImage" name="myImage" style="color: white"></img>
            <map id="map" name="map" ></map>
          </div>

          <div class="col-md-8" id="tablesdiv">
          @for($i=0; $i<22; $i++)
        {{$districts[$i]->name}}
        <input class = "slider slider-polled"
            id="slider{{$i}}"
            data-slider-step="0.01"
            data-slider-max="100" data-slider-min="0"
            data-slider-value="{{round(100*$resultsUPFA[$i]['number_of_votes']/($resultsUPFA[$i]['number_of_votes']+$resultsNDF[$i]['number_of_votes']),2)}}"
            value="{{round(100*$resultsUPFA[$i]['number_of_votes']/($resultsUPFA[$i]['number_of_votes']+$resultsNDF[$i]['number_of_votes']),2)}}"
            type="text"
            onchange="updateVal()">
        Polled percentage
        <input class = "slider slider-polled"
            id="sliderPolled{{$i}}"
            data-slider-step="0.01"
            data-slider-max="100"
            data-slider-min="0"
            registered="{{$distResult[$i]->registered_votes}}"
            data-slider-value="{{round(100*($resultsUPFA[$i]['number_of_votes']+$resultsNDF[$i]['number_of_votes'])/$distResult[$i]->registered_votes,2)}}"
            value="{{round(100*($resultsUPFA[$i]['number_of_votes']+$resultsNDF[$i]['number_of_votes'])/$distResult[$i]->registered_votes,2)}}"><br/>
    @endfor
            </div>
            </div>
       <div class="container">
        <p>Select district for detailed summary</p>
        <br>
            
           </div>
<script src="../js/jquery.imagemapster.min.js" ></script>
<script>


      jQuery(function()
      {
         $('.slider').on('slideStop', function (ev) {
                updateAll();
         });

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
              updateAll();
            });
            
        
        function drawMap() {
                var districts = {{json_encode($districts)}}; 
            
                var areas = [];

    
                for (var i=0; i<22;i++){
                    var text = '';
                    var percentage = document.getElementById('slider'+i).value;
                    var opacity = percentage/100.0;
                    var colour = '3333FF';
                    if (percentage <50) {
                        colour = '339933';
                        opacity = 1 - opacity;
                    }

                    text = text+'<li type="square" style="color:#3333FF"> UPFA - '+percentage+'% </li>';
                    text = text+'<li type="square" style="color:#339933"> NDF - '+(100-percentage)+'% </li>';
                    areas.push({key: districts[i]["name"],
                                toolTip:'<b> '+districts[i]["name"]+'District</b>'+text+'<br>',
                                fillColor:colour,
                                fillOpacity:opacity,
                                selected: true});
                }
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
                        $(".table-hide").each(function(index){
                            $(this).attr('style', 'display:none');
                        })
                        $('#distHead').html(data.key + ' District Results');
                        $('#'+data.key).attr('style', 'display:block');
                    },
                    areas: areas
              });
              $('#myImage').mapster('tooltip','alt');
            }
                function updateAll(){
                    var sumNDF = 0, sumUPFA = 0;
                    var count = 0;
                    var registered, polled, prefer;         
                    for(var i = 0; i< 22;i++){
                        registered = document.getElementById('sliderPolled'+i).getAttribute("registered");
                        polled = document.getElementById('sliderPolled'+i).value;
                        prefer = document.getElementById('slider'+i).value;
                        sumUPFA += registered*polled*prefer/10000.0;
                        sumNDF += registered*polled*(100-prefer)/10000.0;
                    }
                    sumNDF = Math.round(sumNDF);
                    sumUPFA = Math.round(sumUPFA);
                    var sum = sumNDF+sumUPFA;
                    $('#totalUPFA').html(sumUPFA);
                    $('#totalNDF').html(sumNDF);
                    $('#percentageUPFA').html((Math.round(10000*sumUPFA/sum)/100) + " Votes");
                    $('#percentageNDF').html((Math.round(10000*sumNDF/sum)/100)+" Votes");
                    drawMap();
                };
          
        });
</script>
<script>
$( document ).ready(function() {
  $('.slider').slider();
});
</script>
@stop

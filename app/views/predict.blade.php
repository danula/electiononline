
{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')
<link href="../css/slider.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.1/modernizr.min.js"></script>
<script src="https://strukturedkaos.github.io/kickdrop-drops/drops/sliders/js/plugin.js"></script>
<script href="js/bootstrap-slider.js" type="text/javascript"></script>


<div class="page-header">
    <h1>My Predictions for 2015</h1>
</div>
    <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-3">
                        {{HTML::image('/resources/candidates/MR.jpg','photo',array('name'=>'photo','height'=>'220px'))}}
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="small-box bg-blue-gradient">
                            <div class="inner">
                                <h3 id="totalUPFA" style="text-align: right">1231231</h3>
                                <p id="percentageUPFA" style="text-align: right">Votes</p>
                            </div>
                        </div>
                        <div class="small-box bg-green-gradient">
                            <div class="inner">
                                <h3 id="totalNDF" style="text-align: right">1231231</h3>
                                <p id="percentageNDF" style="text-align: right">Votes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        {{HTML::image('/resources/candidates/SF.jpg','photo',array('name'=>'photo','height'=>'220px'))}}
                    </div>
                </div>
     </div>
     <div class="row">
        <div class="col-md-4">
            <img src="../district4.png" width=400 usemap="#map" id="myImage" name="myImage" style="color: white"></img>
            <map id="map" name="map" ></map>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Share Prediction
            </button>
        </div>

        <div class="col-md-8" id="tablesdiv">
                        <div class="bs-example bs-example-tabs" role="tabpanel">
                            <ul id="myTab" class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Percentage</a></li>
                              <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Polled Percentage</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                              <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledBy="home-tab">
                                <br>
                                <table>
                                <p>Percentage votes for each candidate/party. Change the default values from 2010 election to your prediction.</p>
                                @for($i=0; $i<22; $i++)
                                       @if($i%2==0)
                                       <tr>
                                       @endif
                                        <td style="padding-bottom: 10px">  {{$districts[$i]->name}}</td>
                                        <td style="padding-right: 50px"><input class = "slider slider-colord"
                                           id="slider{{$i}}"
                                           data-slider-step="0.01"
                                           data-slider-max="100" data-slider-min="0"
                                           data-slider-value="{{round($distResult[$i]['UPFA_percentage'],2)}}"
                                           value="{{round($distResult[$i]['UPFA_percentage'],2)}}"
                                           type="text"
                                           onchange="updateVal()">
                                        </td>
                                        <td>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </td>
                                       @if($i%2==1)
                                       </tr>
                                       @endif


                                @endfor
                                </table>
                              </div>
                              <div role="tabpanel" class="tab-pane fade active" id="profile" aria-labelledBy="profile-tab">
                                <table>
                                <br>
                                <p>Percentage of valid votes from total registered votes. Change the default values from 2010 election to your prediction.</p>
                                @for($i=0; $i<22; $i++)
                                       @if($i%2==0)
                                       <tr>
                                       @endif
                                            <td style="padding-bottom: 10px">  {{$districts[$i]->name}}</td>
                                            <td style="padding-right: 50px"><input class = "slider slider-polled slider-nocolor"
                                                id="sliderPolled{{$i}}"
                                                data-slider-step="0.01"
                                                data-slider-max="100"
                                                data-slider-min="0"
                                                registered="{{$distResult[$i]['registered_votes']}}"
                                                data-slider-value="{{round($distResult[$i]['polled_percentage'],2)}}"
                                                value="{{round($distResult[$i]['polled_percentage'],2)}}"
                                                type="text">
                                            </td>
                                       @if($i%2==1)
                                       </tr>
                                       @endif
                                  @endfor
                                </table>

                              </div>
                            </div>
                          </div>
                        </div>
        <!--div class="col-md-2 col-md-offset-5">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                Share Prediction
            </button>
        </div-->
     </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Save and Share</h4>
      </div>
      <div class="modal-body">
        <form id="addPredictionForm">
            <div class="alert alert-danger" id="alert_warning" style="display:none">
                <h4>Name already exists</h4>
                <p>please use another name</p>
            </div>
            <div class="alert alert-success" id="alert_success" style="display:none">
                <h4>Successfuly Saved</h4>
            </div>
            <div class="input-group input-group-sm">
                <input type="hidden" id="tUPFA" />
                <input type="hidden" id="tNDF" />
                <input id="predictionName" type="text" class="form-control" required="required" placeholder="Enter Name...">
                <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" type="submit">Go!</button>
                </span>
            </div>
            <a style="margin-top: 3%" class="btn btn-block btn-social btn-facebook" href="" id="fblink" target="_blank">
                <i class="fa fa-facebook"></i> Share in Facebook
            </a>
        </form>
      </div>
    </div>
  </div>
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
                    var percentage = Math.round(100*document.getElementById('slider'+i).value)/100;
                    var percentage2 = Math.round(10000-100*percentage)/100;
                    var opacity = percentage;
                    var colour = '3333FF';
                    if (percentage <50) {
                        colour = '339933';
                        opacity = 100 - opacity;
                    }
                    opacity = 0.5 + (opacity-50)/30;
                    if (opacity < 0.4)
                        opacity = 0.4;
                    text = text+'<li type="square" style="color:#3333FF"> UPFA - '+percentage+'% </li>';
                    text = text+'<li type="square" style="color:#339933"> NDF - '+percentage2+'% </li>';
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
                    $('#tUPFA').val(sumUPFA);
                    $('#tNDF').val(sumNDF);
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

$('#addPredictionForm').submit(function(){
    var list = [];
    for(var i=0; i<22; i++) {
        var item = {
        id : i,
        UPFA_percentage : $("#slider"+i).val(),
        polled_percentage : $("#sliderPolled"+i).val(),
        }
        list.push(item);
    }

    var data = JSON.stringify(list);

    var response = $.ajax({
                type: 'POST',
                url: '{{URL::to('/predict')}}',
                data: { name: $('#predictionName').val(),
                        data: data}
    });

    response.done(
        function(r){
            if(r.name==-1){
                document.getElementById('alert_warning').style.display='block';
                document.getElementById('alert_success').style.display='none';
            }
            else{
                document.getElementById('alert_warning').style.display='none';
                document.getElementById('alert_success').style.display='block';
                var tUPFA = parseFloat(document.getElementById('tUPFA').value);
                var tNDF = parseFloat(document.getElementById('tNDF').value);
                var win = 'MR';
                var name = 'Mahinda Rajapaksa';
                var votes = tUPFA;
                if(tNDF>tUPFA){
                    win = 'MS';
                    votes = tNDF;
                    name = 'Maithripala Sirisena'
                }
                var percentage = Math.round(10000.0*votes/(tNDF+tUPFA))/100.0;
                document.getElementById('fblink').href=
                    "https://www.facebook.com/dialog/feed?app_id="+
                    "358727977621649&link="+
                    encodeURIComponent("http://chandaya.info/predict/"+r.name)+
                    "&picture="+encodeURIComponent("http://chandaya.info/resources/"+win+"Victory.png")+
                    "&name="+encodeURIComponent("I'm predicting that "+name+" will win the Presidential Election 2015 with "+
                        votes+" number of votes ("+percentage+"%)"
                    )+
                    "&description="+encodeURIComponent("Click here for my detailed prediction for districts or make a prediction yourself.")+
                    "&redirect_uri="+encodeURIComponent("https://facebook.com");
                document.getElementById('sitelink').href="http://chandaya.info/predict/"+r.name;
            }
        }
    );
    return false;
});



</script>
@endsection

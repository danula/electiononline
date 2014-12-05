
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
                        @foreach($resultsd as $rd)
                            @if($rd->district_id == $d->id)
                            @if($rd->candidate_id == $cd->id)
                             <td>{{$rd->number_of_votes}}</td>
                            @endif
                            @endif
                        @endforeach
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

                switch (year.toString()){
                    case "2005":
                        data = google.visualization.arrayToDataTable([
                         ['Party', 'Votes'],
                         ['Mahinda Rajapaksha',     50.29],
                         ['Ranil Wickramasinghe',      48.43],
                         ['Other',  1.28],
                         ]);
                         document.getElementById("candidate_1").src = "../resources/candidates/MR.jpg";
                         document.getElementById("candidate_2").src = "../resources/candidates/RW.jpg";
                        break;

                    case "2010" :
                        data = google.visualization.arrayToDataTable([
                                                 ['Party', 'Votes'],
                                                 ['MahindaRajapaksha',     57.88],
                                                 ['SarathFonseka',      40.15],
                                                 ['Other',  1.97],
                                                 ]);
                         document.getElementById("candidate_1").src = "../resources/candidates/MR.jpg";
                         document.getElementById("candidate_2").src = "../resources/candidates/SF.jpg";
                        break;

                    case "1999" :
                        data = google.visualization.arrayToDataTable([
                                                 ['Party', 'Votes'],
                                                 ['Chandrika Bandaranaike Kumarathunga',     4312157],
                                                 ['Ranil Wickremasinghe',      3602748],
                                                 ['Other',  520849],
                                                 ]);
                         document.getElementById("candidate_1").src = "../resources/candidates/CB.jpg";
                         document.getElementById("candidate_2").src = "../resources/candidates/RW.jpg";
                        break;

                    case "1994" :
                        data = google.visualization.arrayToDataTable([
                                                 ['Party', 'Votes'],
                                                 ['Chandrika Bandaranaike Kumarathunga ',     4709205],
                                                 ['Vajira Srimathi Dissanayake',      2715285],
                                                 ['Other',  137036],
                                                 ]);
                         document.getElementById("candidate_1").src = "../resources/candidates/CB.jpg";
                         document.getElementById("candidate_2").src = "../resources/candidates/UNP.jpg";
                        break;

                    case "1988" :
                        data = google.visualization.arrayToDataTable([
                                                 ['Party', 'Votes'],
                                                 ['Sirimavo Bandaranaike',      2289960],
                                                 ['Ranasinghe Premadasa ',     2569199],
                                                 ['Osvin Abeygunasekara',  235719],
                                                 ]);
                         document.getElementById("candidate_1").src = "../resources/candidates/SB.jpg";
                         document.getElementById("candidate_2").src = "../resources/candidates/RP.jpg";
                        break;

                    case "1982" :
                        data = google.visualization.arrayToDataTable([
                                                 ['Party', 'Votes'],
                                                 [' H.S.R.B. Kobbekaduwa',     2548438],
                                                 ['J.R. Jayawardene',      3450811],
                                                 ['Other',  522898],
                                                 ]);
                         document.getElementById("candidate_1").src = "../resources/candidates/KO.jpg";
                         document.getElementById("candidate_2").src = "../resources/candidates/JR.jpg";
                        break;

                    default :
                        break;

                }

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

@stop
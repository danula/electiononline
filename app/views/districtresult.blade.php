{{HTML::script("https://www.google.com/jsapi");}}
@extends('master')
@section('content')

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


    </div>
@endsection

<?php
    $winUNP = array('1982'=>70, '1988'=> 60, '1994'=> 53, '1999'=>88, '2005'=>10, '2010'=>20);
    $nameUNP = array('1982'=>'UNP', '1988'=> 'UNP', '1994'=> 'UNP', '1999'=>'UNP', '2005'=>'UNP', '2010'=>'NDF');
    $winSLFP = array('1982'=>71, '1988'=> 61, '1994'=> 51, '1999'=>85, '2005'=>9, '2010'=>21);
    $nameSLFP = array('1982'=>'SLFP', '1988'=> 'SLFP', '1994'=> 'PA', '1999'=>'PA', '2005'=>'UPFA', '2010'=>'UPFA');
    $data = array();
    foreach($years as $year){
        $others=0;
        $f = false;$s = false;

        foreach($result_d as $result){
            if($result->candidate_id == $winUNP[$year]){
               $first = $result->number_of_votes;
               $firstParty = $nameUNP[$year];
               $f = true;
            }else if($result->candidate_id == $winSLFP[$year]){
               $second = $result->number_of_votes;
               $secondParty = $nameSLFP[$year];
               $s = true;
            }else{
                if($result->year == $year)
                    $others += intval($result->number_of_votes);
            }
        }

        if($f && $s){
            array_push($data,array($year,intval($first), $firstParty, intval($second), $secondParty, intval($others), 'Others'));
            continue;
        }

    }
?>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
                data.addColumn('string', 'Year');
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addColumn('number', 'Votes');
                data.addColumn({type: 'string', role: 'annotation'});
                data.addRows(<?php echo(json_encode($data)); ?>);

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
@extends('master')
@section('content')
<?php

 $t= file_get_contents("http://forum.chandaya.info/discussion/poll/results/1");
 $start = strpos($t, "<span class=\"Number DP_VoteCount\">");
 $end = strpos($t, " votes", $start);
 $votes = intval(substr($t, $start+34, $end- $start - 34));

 $start = strpos($t, "DP_Bar DP_Bar-1");
 $start = strpos($t, ">", $start) + 1;
 $end = strpos($t, "%", $start);
 $mahinda = doubleval(substr($t, $start, $end- $start));

 $start = strpos($t, "DP_Bar DP_Bar-2");
 $start = strpos($t, ">", $start) + 1;
 $end = strpos($t, "%", $start);
 $my3 = doubleval(substr($t, $start, $end- $start));

?>
<input class="hidden" id="votes" value="<?php echo $votes?>">
<input class="hidden" id="mahinda" value="<?php echo $mahinda?>">
<input class="hidden" id="my3" value="<?php echo $my3?>">

    <div class="col-lg-12">

        <h1 class="page-header">
          <img src="../resources/logo.png" style="height: 100px">  Online Election Portal
        </h1>
    </div>
<div class="row">
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header">
                <a class="box-title" href="{{URL::to('districtplot/Colombo')}}">Total Summary of Past Years</a>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="overall_line_chart" style="height: 325px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Online Election Result</h3>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" style="height: 258px" id="online_election_piechart"></div>
                <h4>Total Votes: <?php echo $votes?></h4>
                <a href="http://forum.chandaya.info/discussion/2/online-election-2015" class="btn btn-danger btn-block">Vote Now</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <a href="http://forum.chandaya.info"> <img class="img-responsive" src="../resources/banner.png" ></a>
    </div>
</div>
<!-- Morris.js charts -->
{{HTML::script("//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js");}}
{{HTML::script("../../js/plugins/morris/morris.min.js");}}
<script type="text/javascript">

    var MR = document.getElementById("mahinda");
    var MY3= document.getElementById("my3");
    $(function() {
        "use strict";
        new Morris.Line({
            element: 'overall_line_chart',
            resize: true,
            data: [
                {"year":"1982","win":3450813,"winP":"UNP","sec":2546438,"secP":"SLFP","oth":522675},
                {"year":"1988","win":2569199,"winP":"UNP","sec":2289857,"secP":"SLFP","oth":235701},
                {"year":"1994","win":2715283,"winP":"UNP","sec":4709205,"secP":"PA","oth":137039},
                {"year":"1999","win":3602748,"winP":"UNP","sec":4312157,"secP":"PA","oth":520849},
                {"year":"2005","win":4706366,"winP":"UNP","sec":4887152,"secP":"UPFA","oth":124241},
                {"year":"2010","win":4173185,"winP":"NDF","sec":6015934,"secP":"UPFA","oth":204494}
            ],
            xkey: 'year',
            ykeys: ['win','sec','oth'],
            lineColors: ['#53A336','#0070D1', '#FF8000'],
            hideHover: 'false'
        });

        new Morris.Donut({
            element: 'online_election_piechart',
            resize: true,
            colors: ["#0070D1", "#53A336"],
            data: [
                {label: "Mahinda Rajapaksha", value: parseFloat(MR.value)},
                {label: "Maithripala Sirisena", value: parseFloat(MY3.value)}
            ],
            hideHover: 'false'
        });
    });
</script>

@endsection
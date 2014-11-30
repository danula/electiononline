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
                <div id="district_summary_line" class="panel-default panel-body"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="panel-default panel-body">
                    <div class="form-group">
                        <div style="width:100%" class="panel panel-default">
                            <div style="width:100%"  class="panel-body">
                                <p>Filter By Year</p>
                                <select id="year_filter" class="form-control">

                                    @foreach($years as $year)
                                        <option value="{{$year}}">{{$year}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <<div class="col-md-10">

                @foreach($years as $year)
                <div class="panel-group" id="accordion_{{$year}}" role="tablist" aria-multiselectable="true">

                @foreach($seats as $seat)

                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne_{{$seat->id}}_{{$year}}">
                      <h4 class="panel-title">
                        {{$seat->name}}
                        <a data-toggle="collapse" data-parent="#accordion_{{$year}}" href="#collapseOne_{{$seat->id}}_{{$year}}" aria-expanded="false" aria-controls="collapseOne_{{$seat->id}}_{{$year}}">
                          <span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
                        </a>
                      </h4>
                      <table class="table table-condensed">
                        <thead>
                            <th scope="row"></th>
                            @foreach($results as $r)
                                @foreach($r as $s)
                                    @if($s->seat_id == $seat->id && $s->year == $year)
                                        <th scope="row">{{$s->candidate_id}}</th>
                                    @endif
                                @endforeach
                            @endforeach
                        </thead>
                        <tbody>
                            <tr>
                            <td>Votes</td>
                            @foreach($results as $r)
                                @foreach($r as $s)
                                    @if($s->seat_id == $seat->id && $s->year == $year)
                                        <td scope="row">{{$s->number_of_votes}}</td>
                                    @endif
                                @endforeach
                            @endforeach
                            </tr>
                        </tbody>
                      </table>
                    </div>
                    <div id="collapseOne_{{$seat->id}}_{{$year}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne_{{$seat->id}}_{{$year}}">
                      <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                      </div>
                    </div>
                  </div>

                  @endforeach

                </div>
                @endforeach
            </div>
        </div>
    </div>
<?php

    $resultsArr = json_decode($result_d,true);

    $sort = array();
    foreach($resultsArr as $k=>$v) {
        $sort['year'][$k] = $v['year'];
        $sort['number_of_votes'][$k] = $v['number_of_votes'];
    }

    array_multisort($sort['year'], SORT_ASC, $sort['number_of_votes'], SORT_DESC,$resultsArr);

    //var_dump($results);
?>

@endsection

<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'UNP',    'SLP', 'Other'],
          ['1982',  436290, 274476, 43265],
          ['1988',  361337, 339958, 34020],
          ['1994',  288741, 557708, 13937],
          ['1999',  425185, 474310, 65039],
          ['2005',  569627, 534431, 10192],
          ['2010',  533022, 614740, 12541],
        ]);

        var options = {
          title: 'Election Result Summary',
          curveType: 'function',
          colors:['green','blue','black']
        };

        var chart = new google.visualization.LineChart(document.getElementById('district_summary_line'));

        chart.draw(data, options);
      }
</script>
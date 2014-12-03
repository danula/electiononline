@extends('master')

@section('content')
<div class="row"><h3></h3></div>

<div class="row">
    <div id="piechart" class="panel-default panel-body" style="width: 100%; height: 62%;">
    </div>
</div>

<div class="row">
    <h4>{{$district->name}} District : Year {{$year}}</h4><br>
    <div class="progress">
      @foreach($candidates as $c)
      @if($c->resultsd[0]->number_of_votes/$districtresult->valid_votes>0.1)

      <div class="progress-bar progress-bar-{{$c->colour}}" style="width:{{$c->resultsd[0]->number_of_votes/$districtresult->valid_votes*100}}%" >
            {{$c->name}} - {{number_format($c->resultsd[0]->number_of_votes/$districtresult->valid_votes*100,2)}}%
      </div>
      @endif
      @endforeach

    </div>
</div>
<div class="row">

<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Candidate</th>
        <th>Votes</th>
        <th>Percentage</th>
    </tr>
    </thead>
    <tbody>
    @foreach($candidates as $c)
    <tr>
        <td>{{{$c->name}}}</td>
        <td>{{{$c->resultsd[0]->number_of_votes}}}</td>
        <td>{{number_format($c->resultsd[0]->number_of_votes/$districtresult->valid_votes*100,2)}}%</td>
    </tr>
    @endforeach
    <b>
    <tr class="info">
        <td>Polled Votes</td>
        <td>{{{$districtresult->polled_votes}}}</td>
        <td>{{number_format($districtresult->polled_votes/$districtresult->registered_votes*100,2)}}%</td>
    </tr>
    <tr class="info">
        <td>Rejected Votes</td>
        <td>{{{$districtresult->rejected_votes}}}</td>
        <td></td>
    </tr>
    <tr class="info">
        <td>Registered Votes</td>
        <td>{{{$districtresult->registered_votes}}}</td>
        <td></td>
    </tr>
    <tr class="info">
        <td>Valid Votes</td>
        <td>{{{$districtresult->valid_votes}}}</td>
        <td></td>
    </tr>

    </b>
    </tbody>

</table>
</div>

@endsection
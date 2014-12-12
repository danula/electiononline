@extends('master')

@section('meta')
<title>Add result to database | Chandaya | Online Portal</title>
@endsection

@section('scripts')
<script language=JavaScript>
function reload()
{
    var val= document.getElementsByName("district_id")[0].selectedIndex+1;
    var seatdists =[];
    var seatnames = [];
    @foreach($seats as $s)
        seatnames['{{$s->id}}'] = '{{$s->name}}';
        seatdists['{{$s->id}}'] = '{{$s->district_id}}'
    @endforeach
    var s = document.getElementsByName("seat_id")[0];
    s.options.length = 0;
    for(var i=1;i<=seatdists.length;i++){
    if(seatdists[i]==val){
    var o = document.createElement("option");
    o.value = i;
    o.text = seatnames[i];
    s.appendChild(o);
    }
    }

}
</script>

@endsection

@section('content')
<div>
{{ Form::open(array('action'=>array('ResultController@addSeatResult',$candidates),'name'=>'addresultform')) }}
{{Form::hidden('year',$year)}}
{{Form::hidden('numberofcandidates',sizeof($candidates))}}
{{Form::hidden('candidates',$candidates)}}
<br>
<div class="row">
<div class="col-lg-4">
<div class="well well-sm">
District {{Form::select('district_id',$districts,$districts[1],array('class'=>'form-control','onchange'=>"reload()"))}}
<br>
Seat {{Form::select('seat_id',$seats1,$seats1[1],array('class'=>'form-control'))}}
<br>
</div></div></div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th>Candidate</th>
<th>Votes</th>
</tr>
</thead>
<tbody>
@foreach($candidates as $c)
<tr>
<td>{{$c->name}}</td>
<td>{{Form::text($c->id.'number_of_votes',null,array('class'=>'form-control'))}}</td>
</tr>
@endforeach
<tr>
<td>Polled Votes</td>
<td>{{Form::text('polled_votes',null,array('class'=>'form-control'))}}</td>
</tr>
<tr>
<td>Rejected Votes</td>
<td>{{Form::text('rejected_votes',null,array('class'=>'form-control'))}}</td>
</tr>
<tr>
<td>Registered Votes</td>
<td>{{Form::text('registered_votes',null,array('class'=>'form-control'))}}</td>
</tr>
<tr>
<td>Valid Votes</td>
<td>{{Form::text('valid_votes',null,array('class'=>'form-control'))}}</td>
</tr>


</tbody>



</table></div>
&nbsp;
{{Form::submit('Submit',array('class'=>'btn btn-success'))}}
{{ Form::close() }}



</div>
<br>
@endsection

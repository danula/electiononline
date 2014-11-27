@extends('master')
@section('content')
<div>

{{ Form::open(array('url' => 'add/'.$year)) }}


District
{{Form::select('district_id',$districts)}}

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
<td>{{Form::text($c->id.'number_of_votes')}}</td>
</tr>
@endforeach
</tbody>



</table></div>
&nbsp;
{{Form::button('Submit')}}
{{ Form::close() }}


</div>

@endsection
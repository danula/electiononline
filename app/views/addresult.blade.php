@extends('master')
@section('content')
<div>

{{ Form::open(array('url' => 'foo/bar')) }}


District
{{Form::select('district_id',$districts)}}

<table
Candidate
{{Form::select('candidate_id',$candidates)}}
Votes
{{Form::text('number_of_votes')}}
&nbsp;
{{Form::button('Submit')}}

{{ Form::close() }}
</div>

@endsection
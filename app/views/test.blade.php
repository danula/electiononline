@extends('master')
@section('content')
		<div>
			@foreach($districts as $d)
			<p>{{$d->name}}</p>
			@endforeach
		</div>
@stop
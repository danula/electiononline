@extends('master')

@section('scripts')

@endsection

@section('content')
<div class="row">
    {{$candidate[0]->name}}

    @foreach($results as $r)
        {{$r->seat->name}} - {{$r->number_of_votes}} - {{$seatresults[$r->seat->id-1]->Polled_votes}} <br>

    @endforeach

</div>
@endsection
@extends('master')

@section('scripts')

@endsection

@section('content')
<div class="row"><h3>{{$candidate[0]->name}}</h3></div>

<div class="row">

    <div class="col-lg-4">
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>Seat</th>
            <th>Percentage</th>
        </tr>
        </thead>
        <tbody>
        @foreach($percentages as $id=>$p)
        @if(!str_contains($seatnames[$id],'Postal'))
        <tr>
            <td>{{$seatnames[$id]}}</td>
            <td>{{number_format($p,2)}}</td>
        </tr>
    @endif
    @endforeach
    </tbody>
    </table>
    </div>

</div>
@endsection
@extends('master')

@section('scripts')

@endsection

@section('content')
<br>
<div class="row">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
    {{ Form::open(array('url'=>'candidate','name'=>'changeresult','class'=>'navbar-form navbar-left')) }}

            Year&nbsp;
            {{Form::select('year_select',$years,$year,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}
            &nbsp;&nbsp; &nbsp;&nbsp;Candidate&nbsp;

             {{Form::select('candidate_id',$candidates,$candidate[0]->id,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}

</div></nav>
</div>



<div class="row">
<div class="col-lg-12">
<h3 class="page-header">{{$candidate[0]->name}}</h3></div>
</div>
<div class="row">
    <div class="col-lg-4">
    Photo
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
    <h4>Seats with highest vote percentage</h4>
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

    <div class="col-lg-4">
    <h4>Districts with highest vote percentage</h4>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>District</th>
            <th>Percentage</th>
        </tr>
        </thead>
        <tbody>
        @foreach($percentagesd as $id=>$p)

        <tr>
            <td>{{$districtnames[$id]}}</td>
            <td>{{number_format($p,2)}}</td>
        </tr>
    @endforeach
    </tbody>
    </table>

    </div>

</div>
@endsection
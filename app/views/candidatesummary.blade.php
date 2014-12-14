@extends('master')

@section('meta')
<title>Results of {{$candidate[0]->name}} in the Presidential Election {{$year}} | Chandaya.info</title>
<meta name="description" content="Overall results of {{$candidate[0]->name}} in the Presidential Election {{$year}} with seats and district arranged according to the vote percentage. Chandaya.info is your guide to the Presidential Elections of Sri Lanka. ">
@endsection

@section('scripts')
<script type="text/javascript">
    function checkimg(){
        var img = document.getElementsByName('photo');
        img[0].src = "{{URL::to('/resources/candidates/face.jpg')}}";
    }

    jQuery(document).ready(function($) {
          $("tr").click(function() {
                window.location = $(this).attr("href");
          });
          $("tr").css({"cursor":"pointer"});
    });
</script>
@endsection

@section('content')
<br>

<div class="row">
    <nav class="navbar navbar-default" style="background-color: transparent">
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
    <div class="col-lg-3">
    {{HTML::image('/resources/candidates/'.$candidate[0]->id.'.jpg','photo',array('name'=>'photo','height'=>'220px','onerror'=>'checkimg();'))}}
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="small-box bg-{{$colour[$candidate[0]->colour]}}">
            <div class="inner">
                <h3 style="text-align: right">{{number_format($candidate[0]->number_of_votes)}}</h3>
                <p style="text-align: right">Votes</p>
            </div>
        </div>
        <div class="small-box bg-{{$colour[$candidate[0]->colour]}}">
            <div class="inner">
                <h3 style="text-align: right">{{number_format($candidate[0]->number_of_votes/$totalvotes[$year]*100,2)}}%</h3>
                <p style="text-align: right">of total valid votes</p>
            </div>
        </div>
    </div>

</div>
<br>
<div class="row">
    <div class="col-lg-4">
    <h4>Seats with highest vote percentage</h4>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr href="#">
            <th>Seat</th>
            <th>Percentage</th>
        </tr>
        </thead>
        <tbody>
        @foreach($percentages as $id=>$p)
        @if(!str_contains($seatnames[$id],'Postal'))
        <tr href="{{URL::to('seatresult/'.$seatnames[$id].'/'.$year)}}">
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
        <tr href="#">
            <th>District</th>
            <th>Percentage</th>
        </tr>
        </thead>
        <tbody>
        @foreach($percentagesd as $id=>$p)

        <tr href="{{URL::to('districtresult/'.$districtnames[$id].'/'.$year)}}">
            <td>{{$districtnames[$id]}}</td>
            <td>{{number_format($p,2)}}</td>
        </tr>
    @endforeach
    </tbody>
    </table>

    </div>

</div>
@endsection

@extends('master')

@section('scripts')
<script type="text/javascript">
 jQuery(document).ready(function($) {
          $("tr").click(function() {
                window.location = $(this).attr("href");
          });
          $("tr").css({"cursor":"pointer"});
    });

window.onload = function() {
  document.getElementById('collapseTwo').className = 'panel-collapse';
};
</script>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <nav style="margin-top: 20px; padding-left: 30px" class="navbar navbar-default">
                {{ Form::open(array('url'=>'districtresult','name'=>'changeresult','class'=>'navbar-form navbar-left')) }}

                Year&nbsp;
                {{Form::select('year_select',$years,$year,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}
                &nbsp;&nbsp; &nbsp;&nbsp;District&nbsp;

                 {{Form::select('district_id',$districts,$district->id,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}


        </nav>
    </div>

    <div class="row">
        <h4>{{$district->name}} District - {{$year}} | <a href="{{URL::to('districtplot/'.$district->name)}}">See Yearly Analytics</a></h4><br>
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
        <tr href="#">
            <th>Candidate</th>
            <th>Votes</th>
            <th>Percentage</th>
        </tr>
        </thead>
        <tbody>
        @foreach($candidates as $c)
        <tr href="{{URL::to('candidate/'.$year.'/'.$c->name)}}">
            <td>{{{$c->name}}}</td>
            <td>{{{$c->resultsd[0]->number_of_votes}}}</td>
            <td>{{number_format($c->resultsd[0]->number_of_votes/$districtresult->valid_votes*100,2)}}%</td>
        </tr>
        @endforeach
        <b>
        <tr class="info" href="#">
            <td>Polled Votes</td>
            <td>{{{$districtresult->polled_votes}}}</td>
            <td>{{number_format($districtresult->polled_votes/$districtresult->registered_votes*100,2)}}%</td>
        </tr>
        <tr class="info" href="#">
            <td>Rejected Votes</td>
            <td>{{{$districtresult->rejected_votes}}}</td>
            <td></td>
        </tr>
        <tr class="info" href="#">
            <td>Registered Votes</td>
            <td>{{{$districtresult->registered_votes}}}</td>
            <td></td>
        </tr>
        <tr class="info" href="#">
            <td>Valid Votes</td>
            <td>{{{$districtresult->valid_votes}}}</td>
            <td></td>
        </tr>

        </b>
        </tbody>

    </table>
    </div>
</div>

@endsection
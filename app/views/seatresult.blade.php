@extends('master')

@section('scripts')
<script language=JavaScript>

    function reload()
    {
        console.log('reload')
        var val= document.getElementsByName("district_id")[0].selectedIndex+1;
        var seatdists =[];
        seatnames = [];
    @foreach($seats as $s)
        seatnames['{{$s->id}}'] = '{{$s->name}}';
        seatdists['{{$s->id}}'] = '{{$s->district_id}}';
    @endforeach
        var s = document.getElementsByName("seat_id")[0];
        var selectedSeat = s.value;
        s.options.length = 0;
        for(var i=1;i<=seatdists.length;i++){
            if(seatdists[i]==val){
                var o = document.createElement("option");
                o.value = i;
                o.text = seatnames[i];
                if(selectedSeat ==i) o.selected = "selected";
                s.appendChild(o);
            }
        }


    }
    jQuery(document).ready(function($) {
              $("tr").click(function() {
                    window.location = $(this).attr("href");
              });
              $("tr").css({"cursor":"pointer"});
        });
    window.onload = reload;
</script>


@endsection

@section('content')
<br>
<div class="row">
    <nav class="navbar navbar-default" style="background-color: transparent">
      <div class="container-fluid">
    {{ Form::open(array('url'=>'seatresult','name'=>'changeresult','class'=>'navbar-form navbar-left')) }}

            Year&nbsp;
            {{Form::select('year_select',$years,$year,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}
            &nbsp;&nbsp; &nbsp;&nbsp;District&nbsp;

             {{Form::select('district_id',$districts,$seat->district->id,array('class'=>'form-control','onchange'=>"reload();this.form.submit()"))}}
           &nbsp;&nbsp;&nbsp;&nbsp;Seat

            {{Form::select('seat_id',$seats1,$seat->id,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}

</div></nav>
</div>
@if(!$error)
<div class="row">
    <h4>{{{$seat->district->name}}} District - {{{$seat->name}}} Seat - {{{$year}}}</h4><br>
    <div class="progress">
      @foreach($candidates as $c)
      @if($c->results[0]->number_of_votes/$seatresult->valid_votes>0.1)

      <div class="progress-bar progress-bar-{{$c->colour}}" style="width:{{$c->results[0]->number_of_votes/$seatresult->valid_votes*100}}%" >
            {{$c->name}} - {{number_format($c->results[0]->number_of_votes/$seatresult->valid_votes*100,2)}}%
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
        <td>{{{$c->results[0]->number_of_votes}}}</td>
        <td>{{number_format($c->results[0]->number_of_votes/$seatresult->valid_votes*100,2)}}%</td>
    </tr>
    @endforeach
    <b>
    <tr class="info" href="#">
        <td>Polled Votes</td>
        <td>{{{$seatresult->polled_votes}}}</td>
        <td>{{number_format($seatresult->polled_votes/$seatresult->registered_votes*100,2)}}%</td>
    </tr>
    <tr class="info" href="#">
        <td>Rejected Votes</td>
        <td>{{{$seatresult->rejected_votes}}}</td>
        <td></td>
    </tr>
    <tr class="info" href="#">
        <td>Registered Votes</td>
        <td>{{{$seatresult->registered_votes}}}</td>
        <td></td>
    </tr>
    <tr class="info" href="#">
        <td>Valid Votes</td>
        <td>{{{$seatresult->valid_votes}}}</td>
        <td></td>
    </tr>

    </b>
    </tbody>

</table>
</div>
@else
<div class="row">
    <div class="alert alert-danger" role="alert">
      Seat not applicable for {{$year}} election.
    </div>
</div>
@endif
@endsection
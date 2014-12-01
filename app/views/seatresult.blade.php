@extends('master')

@section('scripts')
<script language=JavaScript>
    function reloadpage(){
        var seatid= document.getElementsByName("seat_id")[0].selectedIndex+1;
        var seatname = seatnames[seatid];
        $.get("seatresult/"+seatname+"/{{$year}}");
    }

    function reload()
    {
        var val= document.getElementsByName("district_id")[0].selectedIndex+1;
        var seatdists =[];
        seatnames = [];
    @foreach($seats as $s)
        seatnames['{{$s->id}}'] = '{{$s->name}}';
        seatdists['{{$s->id}}'] = '{{$s->district_id}}';
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
<br>
<div class="row">
    {{ Form::open(array('url'=>'seatresult','name'=>'changeresult')) }}
    {{ Form::hidden('year',$year)}}
    <div class="col-lg-12">
    <div class="well">
        <div class="row">
            <div class="col-lg-4">
            District {{Form::select('district_id',$districts,$seat->district->id,array('class'=>'form-control','onchange'=>"reload()"))}}
            <br>
            </div>
            <div class="col-lg-4">
            Seat {{Form::select('seat_id',$seats1,$seat->id,array('class'=>'form-control','onchange'=>"this.form.submit()"))}}
            <br>
            </div>
        </div>
    </div>
    </div>
</div>
<div class="row">
 <h4>{{{$seat->district->name}}} District - {{{$seat->name}}} Seat - {{{$year}}}</h4><br>
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>Candidate</th>
        <th>Votes</th>
        <th>Percentage</th>
    </tr>
    </thead>
    <tbody>
    @foreach($candidates as $c)
    <tr>
        <td>{{{$c->name}}}</td>
        <td>{{{$results[$c->id]->number_of_votes}}}</td>
        <td></td>
    </tr>
    @endforeach
    <b>
    <tr class="info">
        <td>Polled Votes</td>
        <td>{{{$seatresult->polled_votes}}}</td>
        <td></td>
    </tr>
    <tr class="info">
        <td>Rejected Votes</td>
        <td>{{{$seatresult->rejected_votes}}}</td>
        <td></td>
    </tr>
    <tr class="info">
        <td>Registered Votes</td>
        <td>{{{$seatresult->registered_votes}}}</td>
        <td></td>
    </tr>
    <tr class="info">
        <td>Valid Votes</td>
        <td>{{{$seatresult->valid_votes}}}</td>
        <td></td>
    </tr>

    </b>
    </tbody>

</table>
</div>
@endsection
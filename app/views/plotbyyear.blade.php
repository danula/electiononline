@extends('master')
@section('content')
        <h1>Summary Results for year: {{$year}}</h1>

       <div class="container">

            <table class="table table-striped">

                <tr>
                    <th>District</th>
                    <th>Seat</th>
                     @foreach($candidates as $d)

                       <th>{{substr(strtok($d->name, " "), 0, 9)}}</th>
                     @endforeach
                </tr>
                @foreach($districts as $d)
                    <tr><th scope="row" >{{$d->name}}</th><td></td>
                    @foreach($candidates as $cd)
                        @foreach($resultsd as $rd)
                            @if($rd->district_id == $d->id)
                            @if($rd->candidate_id == $cd->id)
                                <th scope="row" style="text-align: center">{{$rd->number_of_votes}}</th>
                            @endif
                            @endif
                        @endforeach
                    @endforeach

                    </tr>
                    @foreach($seats as $s)
                        @if($d->id == $s->district_id)
                            <tr><td></td><td>{{$s->name}}</td>
                                @foreach($results as $sr)
                                    @if($sr->seat_id == $s->id)
                                        <td style="text-align: center">{{$sr->number_of_votes}}</td>
                                    @endif
                                @endforeach

                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </table>
               </div>
    	<div>
    		    <h1>Candidates</h1>
                @foreach($candidates as $d)
                <p>{{$d->id}}:
                {{$d->name}}

                </p>
                @endforeach
            </div>

    		<div>
    		    <h2>Districts</h2>
    			@foreach($districts as $d)
    			<h3>{{$d->id}}: {{$d->name}}</h3>
    			    @foreach($seats as $s)
    			        @if($d->id == $s->district_id)
    			            <p>{{$s->name}}</p>
    			        @endif
    			    @endforeach
    			@endforeach
    		</div>

            <div>
                <h2>Results</h2>
                @foreach($results as $d)
                    <p>{{$d->number_of_votes}}</p>
                @endforeach
            </div>
@stop
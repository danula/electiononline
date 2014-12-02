@extends('master')
@section('content')
<script type="text/javascript">
jQuery(document).ready(function($) {
      $("tr").click(function() {
            window.location = $(this).attr("href");
      });
      $("tr").css({"cursor":"pointer"});
});
</script>
        <h1>Summary Results for year: {{$year}}</h1>

       <div class="container">

            <table class="table table-hover">

                <tr>
                    <th>District</th>
                     @foreach($candidates as $d)

                       <th>{{substr(strtok($d->name, " "), 0, 9)}}</th>
                     @endforeach
                </tr>
                @foreach($districts as $d)

                    <tr href='{{url("/districtresult/".$d->name."/".$year,"")}}'> <th scope="row" >{{$d->name}}</th><td></td>
                    @foreach($candidates as $cd)
                        @foreach($resultsd as $rd)
                            @if($rd->district_id == $d->id)
                            @if($rd->candidate_id == $cd->id)
                             <td>{{$rd->number_of_votes}}</td>
                            @endif
                            @endif
                        @endforeach
                    @endforeach

                    </tr>

                @endforeach
            </table>
           </div>
@stop
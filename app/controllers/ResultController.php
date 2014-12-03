<?php
/**
 * Created by PhpStorm.
 * User: danula
 * Date: 11/27/14
 * Time: 1:26 PM
 */

class ResultController extends BaseController {
    public function addSeatResult(){

        $data = Input::all();

        $candidates = json_decode($data['candidates']);

        foreach($candidates as $c){
            $result = new Result;
            $result->year = $data['year'];
            $result->candidate_id = $c->id;
            $result->seat_id = $data['seat_id'];
            $result->number_of_votes = $data[$c->id.'number_of_votes'];
            $result->save();
        }

        $seatresult = new SeatResult;
        $seatresult->year = $data['year'];
        $seatresult->seat_id = $data['seat_id'];
        $seatresult->polled_votes = $data['polled_votes'];
        $seatresult->rejected_votes = $data['rejected_votes'];
        $seatresult->registered_votes = $data['registered_votes'];
        $seatresult->valid_votes = $data['valid_votes'];
        $seatresult->save();


        return Response::json($data);
    }

    public function addDistrictResult(){

    }

    public function showSeatResult($seatname,$year){
        $error = false;
        $seat = Seat::where('name','=',$seatname)->first() ;
        $seatresult = SeatResult::where('seat_id','=',$seat->id)->where('year','=',$year)->first();

        //$candidates = Candidate::where('year','=',$year)->get();

        $candidates = Candidate::where('year','=',$year)->with(array('results' => function($query) use(&$seat)
        {
            $query->where('seat_id', '=',$seat->id);

        }))->get();

       // $candidates = $candidates->sortByDesc('number_of_votes');
        try {
            $candidates->sort(function ($a, $b) {
                $a = $a->results[0]->number_of_votes;
                $b = $b->results[0]->number_of_votes;
                if ($a === $b) {
                    return 0;
                }
                return ($a < $b) ? 1 : -1;
            });
        }catch(Exception $e){
            $error = true;
        }
        //data for drop down select
        $seats = Seat::all();
        $districts1 = District::all();
        foreach ($districts1 as $d) {
            $districts[$d->id]=$d->name;
        }
        foreach($seats as $s){
            $seats1[$s->id]=$s->name;
        }

        $data = array(
            'seatresult'=>$seatresult,
            'seats'=>$seats,
            'seats1'=>$seats1,
            'districts'=>$districts,
            'candidates' => $candidates,
            'year'=>$year,
            'seat'=> $seat,
            'years'=>array('1982'=>'1982','1994'=>'1994','1999'=>'1999','2005'=>'2005','2010'=>'2010'),
            'error'=> $error
        );
        return View::make('seatresult',$data);
}

    public function changeSeatResult(){
        $data = Input::all();
        $seatname = Seat::find($data['seat_id'])->name;
        return Redirect::to("seatresult/".$seatname."/".$data['year_select']);
    }

    public function showCandidateSummary($candidatename)
    {
        $candidate = Candidate::where('name', '=', $candidatename)->get();
        $seatresults = SeatResult::where('year', '=', $candidate[0]->year)->get();
        $districtresults = DistResult::where('year', '=', $candidate[0]->year)->get();

        $results = Result::where('candidate_id', '=', $candidate[0]->id)->with('seat')->get();

        foreach ($results as $r){
            $percentages[$r->seat->id] = $r->number_of_votes / $r->seat->seatresults[0]->polled_votes * 100;
            $seatnames[$r->seat->id] = $r->seat->name;
            }
        arsort($percentages);
        $data = array(
            'results'=>$results,
            'candidate'=>$candidate,
            'seatresults'=> $seatresults,
            'distresults'=>$districtresults,
            'percentages'=>$percentages,
            'seatnames'=>$seatnames,
        );
        return View::make('candidatesummary',$data);

    }

    public function showDistrictResult($districtname,$year){
        $district = District::where('name','=',$districtname)->first();
        $districts1 = District::all();
        foreach ($districts1 as $d) {
            $districts[$d->id]=$d->name;
        }

        $candidates = Candidate::where('year','=',$year)->with(array('resultsd' => function($query) use(&$district)
        {
            $query->where('district_id', '=',$district->id);

        }))->get();

        try {
            $candidates->sort(function ($a, $b) {
                $a = $a->resultsd[0]->number_of_votes;
                $b = $b->resultsd[0]->number_of_votes;
                if ($a === $b) {
                    return 0;
                }
                return ($a < $b) ? 1 : -1;
            });
        }catch(Exception $e){
            $error = true;
        }

        $districtresult = DistResult::where('district_id','=',$district->id)->where('year','=',$year)->first();

        $data = array(
            'district'=>$district,
            'districts'=>$districts,
            'candidates'=>$candidates,
            'districtresult'=>$districtresult,
            'year'=>$year,
            'years'=>array('1982'=>'1982','1994'=>'1994','1999'=>'1999','2005'=>'2005','2010'=>'2010'),
        );
        return View::make('districtresult',$data);

    }

    public function changeDistrictResult(){
        $data = Input::all();
        $districtname = District::find($data['district_id'])->name;
        return Redirect::to("districtresult/".$districtname."/".$data['year_select']);
    }
}
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

	$candidate = Candidate::where('id','=',$c->id)->first();
	$candidate->number_of_votes = $candidate->number_of_votes + $data[$c->id.'number_of_votes'];
	$candidate->save();
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
            'years'=>array('1982'=>'1982','1994'=>'1994','1999'=>'1999','2005'=>'2005','2010'=>'2010', '2015'=>'2015'),
            'error'=> $error
        );
        return View::make('seatresult',$data);
}

    public function changeSeatResult(){
        $data = Input::all();
        $seatname = Seat::find($data['seat_id'])->name;
        return Redirect::to("seatresult/".$seatname."/".$data['year_select']);
    }

    public function showCandidateSummary($year,$candidatename)
    {
        $candidate = Candidate::where('name', '=', $candidatename)->where('year','=',$year)->get();
        $seatresults1 = SeatResult::where('year', '=', $year)->get();
        foreach($seatresults1 as $s){
            $seatresults[$s->seat_id] = $s;
        }

        $districtresults1 = DistResult::where('year', '=', $year)->get();
        foreach($districtresults1 as $d){
            $districtresults[$d->district_id] = $d;
        }

        $results = Result::where('candidate_id', '=', $candidate[0]->id)->with('seat')->get();
        $resultsd = ResultD::where('candidate_id', '=', $candidate[0]->id)->with('district')->get();
        foreach ($results as $r) {
            if ($seatresults[$r->seat->id]->valid_votes == 0){
                $percentages[$r->seat->id] = 0;
            }else {
                $percentages[$r->seat->id] = $r->number_of_votes / $seatresults[$r->seat->id]->valid_votes * 100;
            }
            $seatnames[$r->seat->id] = $r->seat->name;
            }
        foreach ($resultsd as $r){
            $percentagesd[$r->district->id] = $r->number_of_votes / $districtresults[$r->district->id]->valid_votes * 100;
            $districtnames[$r->district->id] = $r->district->name;
        }
        arsort($percentages);
        arsort($percentagesd);

        //data for dropdown
        $candidates1 = Candidate::where('year','=',$year)->get();
        $candidates1->sortByDesc('number_of_votes');
        foreach($candidates1 as $c){
            $candidates[$c->id] = $c->name;
        }


        $data = array(
            'year'=>$year,
            'results'=>$results,
            'candidate'=>$candidate,
            'candidates'=>$candidates,
            'seatresults'=> $seatresults,
            'distresults'=>$districtresults,
            'percentages'=>$percentages,
            'seatnames'=>$seatnames,
            'percentagesd'=>$percentagesd,
            'districtnames'=>$districtnames,
            'years'=>array('1982'=>'1982','1988'=>'1988','1994'=>'1994','1999'=>'1999','2005'=>'2005','2010'=>'2010', '2015'=>'2015'),
            'totalvotes'=>array('1982'=>6522147,'1988'=>5094778,'1994'=>7561526,'1999'=>8435754,'2005'=>9717039,'2010'=>10393613),
            'colour'=>array('active'=>'primary','success'=>'green','warning'=>'yellow','danger'=>'red','info'=>'info')
        );
        return View::make('candidatesummary',$data);

    }

    public function changeCandidateSummary(){
        $data = Input::all();
        $candidatename = Candidate::find($data['candidate_id'])->name;
        $candidate = Candidate::where('year','=',$data['year_select'])->where('name','=',$candidatename)->first();
        if($candidate==null){
            $candidate = Candidate::where('year','=',$data['year_select'])->first();
            return Redirect::to("candidate/" . $data['year_select'] . "/" . $candidate->name);
        }else {

            return Redirect::to("candidate/" . $data['year_select'] . "/" . $candidatename);
        }
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
            'years'=>array('1982'=>'1982','1994'=>'1994','1999'=>'1999','2005'=>'2005','2010'=>'2010', '2015'=>'2015'),
        );
        return View::make('districtresult',$data);

    }

    public function changeDistrictResult(){
        $data = Input::all();
        $districtname = District::find($data['district_id'])->name;
        return Redirect::to("districtresult/".$districtname."/".$data['year_select']);
    }
}

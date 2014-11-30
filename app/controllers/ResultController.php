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
        $candidates = Candidate::where('year','=',$year)->get();
        $seat = Seat::where('name','=',$seatname)->first() ;
        $seatresult = SeatResult::where('seat_id','=',$seat->id)->where('year','=',$year)->first();
        foreach($candidates as $c){
            $results[$c->id] = Result::where('candidate_id','=',$c->id)->where('seat_id','=',$seat->id)->first();
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
            'results'=> $results
        );
        return View::make('seatresult',$data);
}

    public function changeSeatResult(){
        $data = Input::all();
        $seatname = Seat::find($data['seat_id'])->name;
        return $this->showSeatResult($seatname,$data['year']);
    }
}
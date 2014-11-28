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

}
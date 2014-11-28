<?php
/**
 * Created by PhpStorm.
 * User: danula
 * Date: 11/27/14
 * Time: 1:26 PM
 */

class ResultController extends BaseController {
    public function addSeatResult($candidates){
        return View::make('test');

        $data = Input::all();


        $result = new Result();
        $result->district_id = $data['district_id'];
        $result->seat_id = $data['seat_id'];
        $result->number_of_votes = $data['number_of_votes'];
        $result->save();
    }

    public function addDistrictResult(){

    }

}
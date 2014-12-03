<?php
/**
 * Created by PhpStorm.
 * User: madawa
 * Date: 12/2/14
 * Time: 9:13 AM
 */

class DistrictResultController extends BaseController {

    public function showDistrictResult($name){

        $district = District::where('name','=',$name)->get();
        $districtId = $district[0]->id;
        $result_d = ResultD::where('district_id','=',$districtId)->get();
        $seats = Seat::where('district_id','=',$districtId)->get();

        $years = array();

        foreach($result_d as $r){
            array_push($years,$r->year);
        }
        $years = array_unique($years);
        sort($years);
        /*$candidates = Candidate::select('year','id','number_of_votes')
                                ->orderBy('year','ASC')
                                ->orderBy('number_of_votes','DESC')
                                ->get();
        */

        $winners = DB::select(DB::raw("select * from candidates
                                where (
                                    select count(*) from candidates as v
                                    where v.year = candidates.year and v.number_of_votes >= candidates.number_of_votes
                                ) <= 2"));

        usort($winners, function($a, $b){
            $y = strcmp($a->year, $b->year);

            if($y == 0){
                return -1 * strcmp($a->number_of_votes, $b->number_of_votes);
            }

            return $y;
        });

        $data = array(
            'district'=>$district,
            'result_d'=>$result_d,
            'seats'=>$seats,
            'winners'=>$winners,
            'years'=>$years
        );
        return View::make('districtresult',$data);
    }


}
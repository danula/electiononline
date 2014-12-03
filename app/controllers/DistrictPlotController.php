<?php
/**
 * Created by PhpStorm.
 * User: madawa
 * Date: 12/2/14
 * Time: 9:13 AM
 */

class DistrictPlotController extends BaseController {

    public function showDistrictResult($name){

        $district = District::where('name','=',$name)->get();
        $districtId = $district[0]->id;
        $result_d = ResultD::where('district_id','=',$districtId)->get();
        $seats = Seat::where('district_id','=',$districtId)->get();
        $seatresults = array();
        $results = array();

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

        foreach($years as $year) {
            foreach ($seats as $seat) {
                $temp = DB::table('seats')
                    ->join('seat_results', 'seat_results.seat_id', '=', 'seats.id')
                    ->where('seats.district_id', '=', $districtId)
                    ->where('seat_results.seat_id', '=', $seat->id)
                    ->where('seat_results.year', '=', $year)
                    ->get();
                array_push($seatresults, $temp);
            }
        }

        foreach($years as $year) {
            foreach ($seats as $seat) {
                $temp = DB::table('results')
                    ->join('seats', 'seats.id', '=', 'results.seat_id')
                    ->where('seats.district_id', '=', $districtId)
                    ->where('results.seat_id', '=', $seat->id)
                    ->where('results.year', '=', $year)
                    ->get();
                array_push($results, $temp);
            }
        }


        $data = array(
            'district'=>$district,
            'result_d'=>$result_d,
            'seats'=>$seats,
            'winners'=>$winners,
            'years'=>$years,
            'seatresults'=>$seatresults,
            'results'=>$results
        );
        return View::make('districtplot',$data);
    }


}
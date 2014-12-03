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
        $winners = $this->getWinners();


        $years = array();

        foreach($result_d as $r){
            array_push($years,$r->year);
        }
        $years = array_unique($years);
        sort($years);

        $distChartData = $this->generateDistrictChartData($years, $result_d);
        $seatresults = $this->getSeatResults($seats, $years, $districtId);
        $data = array(
            'district'=>$district,
            'result_d'=>$result_d,
            'seats'=>$seats,
            'winners'=>$winners,
            'years'=>$years,
            'seatresults'=>$seatresults,
            'distChartData'=>$distChartData
        );
        return View::make('districtplot',$data);
    }


    private function getSeatResults($seats, $years, $districtId){
        $seatresults = array();

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

        return $seatresults;
    }

    private function getWinners(){
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

        return $winners;
    }

    private function generateDistrictChartData($years, $result_d){
        $winUNP = array('1982'=>70, '1988'=> 60, '1994'=> 53, '1999'=>88, '2005'=>10, '2010'=>20);
        $nameUNP = array('1982'=>'UNP', '1988'=> 'UNP', '1994'=> 'UNP', '1999'=>'UNP', '2005'=>'UNP', '2010'=>'NDF');
        $winSLFP = array('1982'=>71, '1988'=> 61, '1994'=> 51, '1999'=>85, '2005'=>9, '2010'=>21);
        $nameSLFP = array('1982'=>'SLFP', '1988'=> 'SLFP', '1994'=> 'PA', '1999'=>'PA', '2005'=>'UPFA', '2010'=>'UPFA');
        $data = array();
        foreach($years as $year){
            $others=0;
            $f = false;$s = false;

            foreach($result_d as $result){
                if($result->candidate_id == $winUNP[$year]){
                    $first = $result->number_of_votes;
                    $firstParty = $nameUNP[$year];
                    $f = true;
                }else if($result->candidate_id == $winSLFP[$year]){
                    $second = $result->number_of_votes;
                    $secondParty = $nameSLFP[$year];
                    $s = true;
                }else{
                    if($result->year == $year)
                        $others += intval($result->number_of_votes);
                }
            }

            if($f && $s){
                array_push($data,array($year,intval($first), $firstParty, intval($second), $secondParty, intval($others), 'Others'));
                continue;
            }

        }

        return $data;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: madawa
 * Date: 12/2/14
 * Time: 9:13 AM
 */

class DistrictPlotController extends BaseController {
    private $winUNP;
    private $winSLFP;
    private $nameUNP;
    private $nameSLFP;

    public function __construct() {
        $this->winUNP = array('1982'=>70, '1988'=> 60, '1994'=> 53, '1999'=>88, '2005'=>10, '2010'=>20);
        $this->winSLFP = array('1982'=>71, '1988'=> 61, '1994'=> 51, '1999'=>85, '2005'=>9, '2010'=>21);
        $this->nameUNP = array('1982'=>'UNP', '1988'=> 'UNP', '1994'=> 'UNP', '1999'=>'UNP', '2005'=>'UNP', '2010'=>'NDF');
        $this->nameSLFP = array('1982'=>'SLFP', '1988'=> 'SLFP', '1994'=> 'PA', '1999'=>'PA', '2005'=>'UPFA', '2010'=>'UPFA');
    }

    public function showDistrictResult($name){

        $district = District::where('name','=',$name)->get();
        $districtId = $district[0]->id;
        $result_d = ResultD::where('district_id','=',$districtId)->get();
        $seats = Seat::where('district_id','=',$districtId)->get();
        //$winners = $this->getWinners();

        $years = array();

        foreach($result_d as $r){
            array_push($years,$r->year);
        }
        $years = array_unique($years);
        sort($years);

        $distChartData = $this->generateDistrictChartData($years, $result_d);
        $seatresults = $this->getSeatResults($seats, $years, $districtId);
        $seatChartData = $this->generateSeatChartData($years,$seatresults,$seats);

        //data for drop down
        $districts1 = District::all();
        foreach ($districts1 as $d) {
            $districts[$d->id]=$d->name;
        }

        $data = array(
            'district'=>$district,
            'seats'=>$seats,
            'distChartData'=>$distChartData,
            'seatChartData'=>$seatChartData,
            'years'=>array('1982'=>'1982','1994'=>'1994','1999'=>'1999','2005'=>'2005','2010'=>'2010'),
            'districts'=>$districts
        );
        return View::make('districtplot',$data);
    }

    public function changeDistrictResult(){
        $data = Input::all();
        $districtname = District::find($data['district_id'])->name;
        return Redirect::to("districtplot/".$districtname);
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
                array_push($seatresults, $temp);
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

        $data = array();
        foreach($years as $year){
            $others=0;
            $f = false;$s = false;

            foreach($result_d as $result){
                if($result->candidate_id == $this->winUNP[$year]){
                    $first = $result->number_of_votes;
                    $firstParty = $this->nameUNP[$year];
                    $f = true;
                }else if($result->candidate_id == $this->winSLFP[$year]){
                    $second = $result->number_of_votes;
                    $secondParty = $this->nameSLFP[$year];
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

    private function generateSeatChartData($years, $seatresults, $seats){

        $data = array();
        $rows = array();
        foreach($years as $year){
            $others=0;
            $f = false;$s = false;
            foreach($seats as $seat){
                foreach($seatresults as $r){
                    foreach($r as $result) {
                        if ($result->year == $year) {
                            if ($result->seat_id == $seat->id) {
                                if ($result->candidate_id == $this->winUNP[$year]) {
                                    $first = $result->number_of_votes;
                                    $firstParty = $this->nameUNP[$year];
                                    $f = true;
                                } else if ($result->candidate_id == $this->winSLFP[$year]) {
                                    $second = $result->number_of_votes;
                                    $secondParty = $this->nameSLFP[$year];
                                    $s = true;
                                } else {
                                    if ($result->year == $year)
                                        $others += intval($result->number_of_votes);
                                }
                            }
                        }
                    }
                }

                if($f && $s){
                    array_push($data,array('seat'=>$seat->id, 'arr'=>array($year,intval($first), $firstParty, intval($second), $secondParty, intval($others), 'Others')));
                    continue;
                }
            }
        }

        foreach($seats as $seat){
            $t = array();
            foreach($data as $d){
                if($d['seat'] == $seat->id){
                    array_push($t,$d['arr']);
                }
            }

            array_push($rows, array('seat'=>$seat->id, 'arr'=>$t));
        }

        return $rows;
    }

}
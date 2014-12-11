<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome() {

        $chartData = $this->generateChartData();

        $data = array(
            'chartData'=>$chartData
        );

		return View::make('home',$data);
	}

    public function generateChartData(){

        $years = array('1982','1988','1994','1999','2005','2010');
        $winUNP = array('1982'=>70, '1988'=> 60, '1994'=> 53, '1999'=>88, '2005'=>10, '2010'=>20);
        $winSLFP = array('1982'=>71, '1988'=> 61, '1994'=> 51, '1999'=>85, '2005'=>9, '2010'=>21);
        $nameUNP = array('1982'=>'UNP', '1988'=> 'UNP', '1994'=> 'UNP', '1999'=>'UNP', '2005'=>'UNP', '2010'=>'NDF');
        $nameSLFP = array('1982'=>'SLFP', '1988'=> 'SLFP', '1994'=> 'PA', '1999'=>'PA', '2005'=>'UPFA', '2010'=>'UPFA');

        $data = array();

        foreach($years as $year){
            $candidates = Candidate::where('year','=',$year)->get();
            $f = false; $s = false;
            $others = 0;
            foreach($candidates as $candidate){
                if($candidate->id == $winUNP[$year]){
                    $first = $candidate->number_of_votes;
                    $firstParty = $nameUNP[$year];
                    $f = true;
                }else if($candidate->id == $winSLFP[$year]){
                    $second = $candidate->number_of_votes;
                    $secondParty = $nameSLFP[$year];
                    $s = true;
                }else{
                    if($candidate->year == $year)
                        $others += intval($candidate->number_of_votes);
                }
            }

            $obj = array('year'=>$year,
                         'win'=>intval($first),
                         'winP'=> $firstParty,
                         'sec'=>intval($second),
                         'secP'=>$secondParty,
                         'oth'=>intval($others)
                        );

            if($f && $s){
                array_push($data,json_encode($obj));
                continue;
            }
        }

        return $data;
    }

}

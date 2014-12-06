<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

Blade::extend(function($value)
{
    return preg_replace('/(\s*)@break(\s*)/', '$1<?php break; ?>$2', $value);
});

Route::get('test', function()
{
    $dist = District::all();
    return View::make('test')->with('districts',$dist);
});


//set the route for the login
Route::get('login','UserController@viewlogin');
Route::post('login','UserController@login');
//set the route for the register
Route::get('register','UserController@viewregister');
Route::post('register','UserController@register');

Route::get('map',function(){
    return View::make('map');
});
Route::get('add/{year}',function($year){
    $seats = Seat::all();
    $candidates = Candidate::where('year','=',$year)->get();
    $districts1 = District::all();
    foreach ($districts1 as $d) {
        $districts[$d->id]=$d->name;
    }
    foreach($seats as $s){
        $seats1[$s->id]=$s->name;
    }
    $data = array(
        'seats'=>$seats,
        'seats1'=> $seats1,
        'candidates' => $candidates,
        'districts' => $districts,
        'year'=> $year
    );
    return View::make('addresult',$data);
});
Route::post('add','ResultController@addSeatResult');

Route::get('plotbyyear/{year}',function($year){
    $districts = District::all();
    $candidates = Candidate::where('year','=',$year)->orderBy('number_of_votes', 'desc')->get();
    $resultsd = ResultD::where('year','=',$year)->orderBy('number_of_votes', 'desc')->get();
    $distResult_ = DistResult::where('year','=',$year)->get();
    foreach($candidates as $c) {
        $candidatesById[$c->id] = $c; 
    }
    foreach($resultsd as $r) {
        $results[$r->district_id][$r->candidate_id] = $r; 
    }
    foreach($distResult_ as $d) {
        $distResult[$d->district_id]= $d; 
    }
    $all = array(1982=>6522147, 1988=>5094775, 1994 => 7561526, 1999 => 8435762, 2005 => 9717039, 2010 => 10393613);
    $data = array(
        'candidates' => $candidates,
        'candidatesById' => $candidatesById,
        'districts' => $districts,
        'year'=> $year,
        'results'=>$results,
        'distResult'=>$distResult,
        'all' =>$all
    );
    
    
    return View::make('plotbyyear',$data);
});


Route::get('districtplot/{name}','DistrictPlotController@showDistrictResult');
Route::post('districtplot','DistrictPlotController@changeDistrictResult');

Route::get('seatresult/{seatname}/{year}','ResultController@showSeatResult');
Route::post('seatresult','ResultController@changeSeatResult');

Route::get('candidate/{year}/{candidatename}','ResultController@showCandidateSummary');
Route::post('candidate','ResultController@changeCandidateSummary');

Route::get('districtresult/{districtname}/{year}','ResultController@showDistrictResult');
Route::post('districtresult','ResultController@changeDistrictResult');

Route::get('predict','PredictController@showPredict');

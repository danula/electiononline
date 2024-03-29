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

Route::get('plotbyyear/{year}','MapPlotController@plotByYear');
Route::get('plotallyears','MapPlotController@plotAllYears');


Route::get('districtplot/{name}','DistrictPlotController@showDistrictResult');
Route::post('districtplot','DistrictPlotController@changeDistrictResult');

Route::get('seatresult/{seatname}/{year}','ResultController@showSeatResult');
Route::post('seatresult','ResultController@changeSeatResult');

Route::get('candidate/{year}/{candidatename}','ResultController@showCandidateSummary');
Route::post('candidate','ResultController@changeCandidateSummary');

Route::get('districtresult/{districtname}/{year}','ResultController@showDistrictResult');
Route::post('districtresult','ResultController@changeDistrictResult');

Route::get('predict/{id}','PredictController@showPredict');
Route::post('predict','PredictController@savePrediction');


Route::get('predict',function(){
    return Redirect::to('/predict/1');
});
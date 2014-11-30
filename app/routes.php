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

Route::get('/', function()
{
	return View::make('hello');
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
    $seats = Seat::all();

    $results = Result::where('year','=',$year)->get();
    $seatresults = SeatResult::where('year','=',$year)->get();
    $distresults = DistResult::where('year','=',$year)->get();
    $resultsd = ResultD::where('year','=',$year)->get();

    $data = array(
        'seats'=>$seats,
        'candidates' => $candidates,
        'districts' => $districts,
        'year'=> $year,
        'results'=>$results,
        'seatresults'=>$seatresults,
        'distresults'=>$distresults,
        'resultsd'=>$resultsd
    );
    return View::make('plotbyyear',$data);
});

Route::get('plotbylocation/{name}',function($name){
    $district = District::where('name','=',$name)->get();
    $districtId = $district[0]->id;
    $result_d = ResultD::where('district_id','=',$districtId)->get();
    $seats = Seat::where('district_id','=',$districtId)->get();
    $years = array();
    $results = array();

    foreach($result_d as $r){
        array_push($years,$r->year);
    }
    $years = array_unique($years);
    arsort($years);
    foreach($years as $year)
    foreach($seats as $seat){
        $temp = DB::table('results')
            ->join('seats','seats.id', '=', 'results.seat_id')
            ->where('seats.district_id', '=', $districtId)
            ->where('results.seat_id', '=', $seat->id)
            ->where('results.year', '=', $year)
            ->get();
        array_push($results,$temp);
    }

    $data = array(
        'district'=>$district,
        'result_d'=>$result_d,
        'seats'=>$seats,
        'results'=>$results,
        'years'=>$years
    );
    return View::make('plotbylocation',$data);
});

Route::get('seatresult/{seatname}/{year}','ResultController@showSeatResult');
Route::post('seatresult','ResultController@changeSeatResult');

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

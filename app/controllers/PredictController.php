<?php
/**
 * Created by PhpStorm.
 * User: danula
 * Date: 12/5/14
 * Time: 7:54 PM
 */

class PredictController extends BaseController{
    public function showPredict(){

        //data for district selection
        $districts1 = District::all();
        foreach ($districts1 as $d) {
            $districts[$d->id]=$d->name;
        }

        $data = array(
            'districts'=>$districts
        );
        return View::make('predict',$data);
    }
} 
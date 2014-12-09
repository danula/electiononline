<?php

class PredictController extends BaseController {

    public function showPredict($id) {
        $districts = District::all();
        $results1 = ResultD::where('year','=','2010')->where('candidate_id','=','20')->orderBy('district_id', 'asc')->get();
        $results2 = ResultD::where('year','=','2010')->where('candidate_id','=','21')->orderBy('district_id', 'asc')->get();
        $distResult = DistResult::where('year','=','2010')->orderBy('district_id', 'asc')->get();

        $data = array(
            'resultsNDF' => $results1,
            'resultsUPFA' => $results2,
            'districts' => $districts,
            'distResult'=>$distResult
        );
        return View::make('predict',$data);
    }
}

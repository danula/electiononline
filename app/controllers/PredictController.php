<?php
class PredictController extends BaseController {
    public function showPredict($id) {
        $districts = District::all();
        if($id == 1) {
            $results1 = ResultD::where('year', '=', '2010')->where('candidate_id', '=', '20')->orderBy('district_id', 'asc')->get();
            $results2 = ResultD::where('year', '=', '2010')->where('candidate_id', '=', '21')->orderBy('district_id', 'asc')->get();
        }
        else{
            $prediction = Prediction::where('name','=',$id)->first();
            $savedData = json_decode($prediction->data);

        }
        $distResult_ = DistResult::where('year','=','2010')->orderBy('district_id', 'asc')->get();
        $distResult = array();
        $i=0;
        foreach($distResult_ as $d){
            if($id == 1) {
                $polled = 100.0 * ($results1[$i]->number_of_votes + $results2[$i]->number_of_votes) / $d->registered_votes;
                $percentage = 100.0 * $results2[$i]->number_of_votes / ($results1[$i]->number_of_votes + $results2[$i]->number_of_votes);
            }
            else {
                $polled = $savedData[$i]->polled_percentage;
                $percentage = $savedData[$i]->UPFA_percentage;
            }
            array_push($distResult,
                array(
                    'registered_votes'=>$d->registered_votes,
                    'polled_percentage'=>$polled,
                    'UPFA_percentage' => $percentage
                ));
            $i = $i + 1;
        }
        $data = array(
            'districts' => $districts,
            'distResult'=>$distResult
        );
        return View::make('predict',$data);
    }

    public function savePrediction(){
        $res = Input::all();


            $prediction = new Prediction;
            $prediction->name = $res['name'];
            $prediction->data = $res['data'];

        try{
            $prediction->save();
            return Response::json($res);
        }catch(Exception $e){
            $s = array('name'=>-1);
            return Response::json($s);
        }




    }
}
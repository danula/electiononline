<?php
class PredictController extends BaseController {
    public function showPredict($id) {
        $districts = District::all();
        if($id == 1) {
            $results1 = ResultD::where('year', '=', '2010')->where('candidate_id', '=', '20')->orderBy('district_id', 'asc')->get();
            $results2 = ResultD::where('year', '=', '2010')->where('candidate_id', '=', '21')->orderBy('district_id', 'asc')->get();
        }
        else{

        }
        $distResult_ = DistResult::where('year','=','2010')->orderBy('district_id', 'asc')->get();
        $distResult = array();
        $i=0;
        foreach($distResult_ as $d){
            if($id == 1) {
                $polled = 100.0 * ($results1[$i]->number_of_votes + $results2[$i]->number_of_votes) / $d->registered_votes;
                $percentage = 100.0 * $results1[$i]->number_of_votes / ($results1[$i]->number_of_votes + $results2[$i]->number_of_votes);
            }
            else {

            }
            array_push($distResult,
                array(
                    'id' => $d->id,
                    'name' => $d->district->name,
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
        $data = Input::all();

            $prediction = new Prediction;
            $prediction->name = $data['name'];
            $prediction->data = $data['data'];

        try{
            $prediction->save();
            return Response::json($data);
        }catch(Exception $e){
           // return Response::json($e);
        }




    }
}
<?php
class PredictController extends BaseController {
    private $winUNP;
    private $winSLFP;
    private $nameUNP;
    private $nameSLFP;
    private $reg2015;

    public function __construct() {
        $this->winUNP = array('1982'=>70, '1988'=> 60, '1994'=> 53, '1999'=>88, '2005'=>10, '2010'=>20);
        $this->winSLFP = array('1982'=>71, '1988'=> 61, '1994'=> 51, '1999'=>85, '2005'=>9, '2010'=>21);
        $this->nameUNP = array('1982'=>'UNP', '1988'=> 'UNP', '1994'=> 'UNP', '1999'=>'UNP', '2005'=>'UNP', '2010'=>'NDF');
        $this->nameSLFP = array('1982'=>'SLFP', '1988'=> 'SLFP', '1994'=> 'PA', '1999'=>'PA', '2005'=>'UPFA', '2010'=>'UPFA');
        $this->reg2015 = array(1586598, 1637537, 897349, 1049160, 379675, 534150, 819666, 623818, 462911, 529239, 253058, 365167, 465757, 256852, 1266443, 553009, 636733, 307125, 620486, 339797, 810082, 649878);
    }
    public function showPredict($id) {
        $districts = District::all();
        if($id == 1 || $id == 2015) {
            $results1 = ResultD::where('year', '=', '2010')->where('candidate_id', '=', '20')->orderBy('district_id', 'asc')->get();
            $results2 = ResultD::where('year', '=', '2010')->where('candidate_id', '=', '21')->orderBy('district_id', 'asc')->get();
            $distYear = DistResult::where('year','=','2010')->orderBy('district_id', 'asc')->get();
        }
        else if($id == 1982 || $id == 1988 || $id == 1994 || $id == 1999 || $id == 2005 || $id == 2010){
            $results1 = ResultD::where('year', '=', ''.$id)
                            ->where('candidate_id', '=', ''.$this->winUNP[''.$id])
                            ->orderBy('district_id', 'asc')->get();
            $results2 = ResultD::where('year', '=', ''.$id)
                            ->where('candidate_id', '=', ''.$this->winSLFP[''.$id])
                            ->orderBy('district_id', 'asc')->get();
            $distYear = DistResult::where('year','=',''.$id)->orderBy('district_id', 'asc')->get();
        }
        else{
            $prediction = Prediction::where('name','=',$id)->first();
            $prediction->increment('views');
            $savedData = json_decode($prediction->data);
        }

        $distResult = array();
        for($i = 0; $i <22; $i++){
            if($id == 1 || $id  == 2015) {
                $polled = $polled = 100.0 * ($results1[$i]->number_of_votes + $results2[$i]->number_of_votes) / $distYear[$i]->registered_votes;
                $percentage = 50.0;
            }else if($id == 1982 || $id == 1988 || $id == 1994 || $id == 1999 || $id == 2005 || $id == 2010){
                $polled = 100.0 * ($results1[$i]->number_of_votes + $results2[$i]->number_of_votes) / $distYear[$i]->registered_votes;
                $percentage = 100.0 * $results2[$i]->number_of_votes / ($results1[$i]->number_of_votes + $results2[$i]->number_of_votes);
            }
            else {
                $polled = $savedData[$i]->polled_percentage;
                $percentage = $savedData[$i]->UPFA_percentage;
            }
            array_push($distResult,
                array(
                    'registered_votes'=>$this->reg2015[$i],
                    'polled_percentage'=>$polled,
                    'UPFA_percentage' => $percentage
                ));
        }
        $data = array(
            'districts' => $districts,
            'distResult'=>$distResult,
            'urlId'=>$id
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

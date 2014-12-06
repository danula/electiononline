<?php

class MapPlotController extends BaseController {
    

    public function plotByYear($year){
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
    }
    public function plotAllYears(){
        $districts = District::all();
        $candidates_ = Candidate::orderBy('number_of_votes', 'desc')->get();
        $resultsd = ResultD::orderBy('number_of_votes', 'desc')->get();
        $distResult_ = DistResult::all();
        $years = array(1982, 1988, 1994, 1999, 2005, 2010);
        foreach($years as $year) {
            $candidates[$year] = array();
        }
        foreach($candidates_ as $c) {
            array_push($candidates[$c->year], $c); 
        }
        foreach($candidates_ as $c) {
            $candidatesById[$c->id] = $c; 
        }
        foreach($resultsd as $r) {
            $results[$r->year][$r->district_id][$r->candidate_id] = $r; 
        }
        foreach($distResult_ as $d) {
            $distResult[$d->year][$d->district_id]= $d; 
        }
        
        $all = array(1982=>6522147, 1988=>5094775, 1994 => 7561526, 1999 => 8435762, 2005 => 9717039, 2010 => 10393613);
        $data = array(
            'candidates' => $candidates,
            'candidatesById' => $candidatesById,
            'districts' => $districts,
            'results'=>$results,
            'distResult'=>$distResult,
            'all' =>$all,
            'years' => $years
        );
        
        
        return View::make('plotallyears',$data);
    }
}

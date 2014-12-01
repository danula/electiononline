<?php
/**
 * Created by PhpStorm.
 * User: danula
 * Date: 11/28/14
 * Time: 1:49 PM
 */

class ResultD extends Eloquent{
    protected $table = 'results_d';
    public function candidate(){
        $this->belongsTo('Candidate');
    }
    public function district(){
        $this->belongsTo('District');
    }
} 
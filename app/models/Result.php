<?php
/**
 * Created by PhpStorm.
 * User: danula
 * Date: 11/27/14
 * Time: 1:39 PM
 */

class Result extends Eloquent {
    public function candidate(){
        return $this->belongsTo('Candidate');
    }
    public function seat(){
        return $this->belongsTo('Seat');
    }
} 
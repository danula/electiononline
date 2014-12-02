<?php

class District extends Eloquent{
    public function seats(){
        return $this->hasMany('Seat');
    }
    public function results_d(){
        return $this->hasMany('ResultD');
    }
    public function districtresults(){
        return $this->hasMany('DistResult');
    }
}
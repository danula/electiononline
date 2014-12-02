<?php

class Seat extends Eloquent{
    public function district(){
        return $this->belongsTo('District');
    }
    public function results(){
        return $this->hasMany('Result');
    }
    public function seatresults(){
        return $this->hasMany('SeatResult');
    }

}
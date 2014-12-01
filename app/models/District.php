<?php

class District extends Eloquent{
    public function seats(){
        return $this->hasMany('Seat');
    }

}
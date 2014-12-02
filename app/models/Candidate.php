<?php
/**
 * Created by PhpStorm.
 * User: danula
 * Date: 11/27/14
 * Time: 2:20 PM
 */

class Candidate extends Eloquent {
    public function results(){
        return $this->hasMany('Result');
    }
    public function resultsd(){
        return $this->hasMany('ResultD');
    }
} 
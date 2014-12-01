<?php
/**
 * Created by PhpStorm.
 * User: danula
 * Date: 11/27/14
 * Time: 2:20 PM
 */

class Candidate extends Eloquent {
    public function results(){
        $this->hasMany('Result');
    }
    public function resultsd(){
        $this->hasMany('ResultD');
    }
} 
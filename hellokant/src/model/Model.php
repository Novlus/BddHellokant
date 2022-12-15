<?php

namespace hellokant\model;

abstract class Model {

    private $attributes = array();

    function __construct($attrs=array()){
        $this->attributes = $attrs;
    }

    public function __get($name){
        return $this->attributes[$name];
    }

    public function __set($name, $value){
        $this->attributes[$name] = $value;
    }


}
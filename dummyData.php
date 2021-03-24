<?php

class dummyData{
  private $ten_Array;
  private $ten_thous_Array;
  private $hun_thous_Array;
  private $mill_Array;
  private $ten_mill_Array;

  function __construct(){
    $this->set_ten_Array($this->genNumber(10));
    $this->set_ten_thous_Array($this->genNumber(10000));
    $this->set_hun_thous_Array($this->genNumber(100000));
    $this->set_mill_Array($this->genNumber(1000000));
    $this->set_ten_mill_Array($this->genNumber(10000000));
  }

  public function genNumber($count){
    $fourRandomDigit = array();
    for($index = 0; $index <= $count; $count--){
      array_push($fourRandomDigit, mt_rand(1000,9999));
    }
    return $fourRandomDigit;
  }

  public function set_ten_Array($array){
    $this->ten_Array = $array;
  }

  public function get_ten_Array(){
    return $this->ten_Array;
  }

  ////////////////////////////////////////////////

  public function set_ten_thous_Array($array){
    $this->ten_thous_Array = $array;
  }

  public function get_ten_thous_Array(){
    return $this->ten_thous_Array;
  }

  ////////////////////////////////////////////////
  public function set_hun_thous_Array($array){
    $this->hun_thous_Array = $array;
  }

  public function get_hun_thous_Array(){
    return $this->hun_thous_Array;
  }

  ////////////////////////////////////////////////

  public function set_mill_Array($array){
    $this->mill_Array = $array;
  }

  public function get_mill_Array(){
    return $this->mill_Array;
  }
  ////////////////////////////////////////////////

  public function set_ten_mill_Array($array){
    $this->ten_mill_Array = $array;
  }

  public function get_ten_mill_Array(){
    return $this->ten_mill_Array;
  }
  ////////////////////////////////////////////////
}

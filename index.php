<?php
ini_set('memory_limit', '128G');
ini_set('max_execution_time', '0'); // for infinite time of execution
require_once('dummyData.php');
require_once('config.php');

class sortThis{
  //type of sort method
  private $sortType;
  //number of numbers in array
  private $num;
  //random numbers generated array
  private $unshorted_list;
  //sorted numbers generated array
  private $shorted;
  //app start time
  private $startTime;
  //app end time
  private $endTime;

  // hold largest number in array
  public $largestNumber;

  function __construct($type, $num ){
    $this->sortType = $type;
    $this->num = $num;
    $this->set_unshorted_list($this->num);

  }

  public function get_sort_type(){
    return $this->sortType;
  }

  public function set_unshorted_list($array){
    $this->unshorted_list = $array;
  }

  public function get_unshorted_list(){
    return $this->unshorted_list;
  }

  public function get_shorted_list(){
    return $this->shorted;
  }

  public function get_execution(){
    $exec_time = ($this->get_endTime() - $this->get_startTime());
    return $exec_time;
  }

  public function get_startTime(){
    return $this->startTime;
  }

  public function get_endTime(){
    return $this->endTime;
  }

  public function set_startTime(){
    $this->startTime = microtime(true);
  }

  public function set_endTime(){
    $this->endTime = microtime(true);
  }

  public function topText_general($type = "", $gen_array = "", $sort_array = "", $time="" ){
    $gen_array = is_array($gen_array)? implode(', ', $gen_array) : 'error';
    $sort_array = is_array($sort_array)? implode(', ', $sort_array) : 'error';


    $output  = '<table>';
      $output  .= '<tbody>';
        $output  .= '<tr>';
          $output  .= '<th>Sort Type</th>';
          $output  .= '<th>'.$type.'</th>';
        $output  .= '</tr>';
        $output  .= '<tr>';
          $output  .= '<td>Data Generated</td>';
          $output  .= '<td>'.$gen_array.'</td>';
        $output  .= '</tr>';
        $output  .= '<tr>';
          $output  .= '<td>Sorted Data</td>';
          $output  .= '<td>'.$sort_array.'</td>';
        $output  .= '</tr>';
        $output  .= '<tr>';
          $output  .= '<td>Time</td>';
          $output  .= '<td>'.$time.'</td>';
        $output  .= '</tr>';
      $output  .= '</tbody>';
    $output  .= '</table>';

    echo $output;
  }

  public function bottomText_general($num){
    $output = $num .'numbers, time: '. $this->get_execution();

    $output  = '<table>';
      $output  .= '<tbody>';
        $output  .= '<tr>';
          $output  .= '<td>'.$num.' numbers</td>';
          $output  .= '<td>Time:'.$this->get_execution().'</td>';
        $output  .= '</tr>';
      $output  .= '</tbody>';
    $output  .= '</table>';
    return $output;
  }

  public function blockText_counting($type = "", $gen_array = "", $sort_array = "", $largest_number ="" ,$time="" ){
    $output = $num .'numbers, time: '. $this->get_execution();

    $output  = '<table>';
      $output  .= '<tbody>';
        $output  .= '<tr>';
          $output  .= '<td>'.$num.' numbers</td>';
          $output  .= '<td>Time:'.$this->get_execution().'</td>';
        $output  .= '</tr>';
        $output  .= '<tr>';
          $output  .= '<td>Largest Number</td>';
          $output  .= '<td>Time:'.$this->get_execution().'</td>';
        $output  .= '</tr>';
      $output  .= '</tbody>';
    $output  .= '</table>';
    return $output;
  }

  public function get_sorted_array(){
    return $this->shorted;
  }

  public function insertion_Sort($array){

   $this->set_startTime();

   for($i=0; $i<count($array); $i++){
     $val = $array[$i];
     $j = $i-1;
     while($j>=0 && $array[$j] > $val){
       $array[$j+1] = $array[$j];
       $j--;
     }
     $array[$j+1] = $val;
   }
    $this->shorted = $array;

    $this->set_endTime();
  }

  function heapsort(&$Array, $n) {

    $this->set_startTime();

    for($i = (int)($n/2); $i >= 0; $i--) {
      $this-> heapify($Array, $n-1, $i);
    }

    for($i = $n - 1; $i >= 0; $i--) {
      //swap last element of the max-heap with the first element
      $temp = $Array[$i];
      $Array[$i] = $Array[0];
      $Array[0] = $temp;

      //exclude the last element from the heap and rebuild the heap
      $this->heapify($Array, $i-1, 0);
    }
    $this->shorted = $Array;

    $this->set_endTime();
  }

  // heapify function is used to build the max heap
  // max heap has maximum element at the root which means
  // first element of the array will be maximum in max heap
  function heapify(&$Array, $n, $i) {
    $max = $i;
    $left = 2*$i + 1;
    $right = 2*$i + 2;

    //if the left element is greater than root
    if($left <= $n && $Array[$left] > $Array[$max]) {
      $max = $left;
    }

    //if the right element is greater than root
    if($right <= $n && $Array[$right] > $Array[$max]) {
      $max = $right;
    }

    //if the max is not i
    if($max != $i) {
      $temp = $Array[$i];
      $Array[$i] = $Array[$max];
      $Array[$max] = $temp;
      //Recursively heapify the affected sub-tree
      $this->heapify($Array, $n, $max);
    }
  }

}

echo file_get_contents("styles.css");

//dummy dataClass
$dummyData = new dummyData();
//
// instace of number
$insertion_sort_t = new sortThis("Insertion Sort", $dummyData->get_ten_Array());
// sort number
$insertion_sort_t->insertion_Sort($insertion_sort_t->get_unshorted_list());
// markup build
$insertion_sort_t->topText_general( $insertion_sort_t->get_sort_type(), $insertion_sort_t->get_unshorted_list(), $insertion_sort_t->get_shorted_list(), $insertion_sort_t->get_execution() );

$insertion_sort_t_thousand = new sortThis("Insertion Sort", $dummyData->get_ten_thous_Array());
$insertion_sort_t_thousand->insertion_Sort($insertion_sort_t_thousand->get_unshorted_list());
echo $insertion_sort_t_thousand->bottomText_general( '10,000' );

$insertion_sort_h_thousand = new sortThis("Insertion Sort", $dummyData->get_hun_thous_Array());
$insertion_sort_h_thousand->insertion_Sort($insertion_sort_h_thousand->get_unshorted_list());
echo $insertion_sort_h_thousand->bottomText_general( '100,000' );

// $insertion_sort_mill = new sortThis("Insertion Sort", $dummyData->get_mill_Array());
// $insertion_sort_mill->insertion_Sort($insertion_sort_mill->get_unshorted_list());
// echo $insertion_sort_mill->bottomText_general( '1,000,000' );

// $insertion_sort_t_mill = new sortThis("Insertion Sort", $dummyData->get_ten_mill_Array());
// $insertion_sort_t_mill->insertion_Sort($insertion_sort_t_mill->get_unshorted_list());
// echo $insertion_sort_t_mill->bottomText_general( '10,000,000' );

echo '<hr>';

//instace of number
$heap_sort_t = new sortThis("Heap Sort", $dummyData->get_ten_Array());
//init size of heap
$n = sizeof($heap_sort_t->get_unshorted_list());
$heap_sort_t->heapSort($heap_sort_t->get_unshorted_list(), $n);
//markup build
$heap_sort_t->topText_general( $heap_sort_t->get_sort_type(), $heap_sort_t->get_unshorted_list(), $heap_sort_t->get_shorted_list(), $heap_sort_t->get_execution() );
//
$heap_sort_t_thousand = new sortThis("Heap Sort", $dummyData->get_ten_thous_Array());
$n = sizeof($heap_sort_t_thousand->get_unshorted_list())/sizeof($heap_sort_t_thousand->get_unshorted_list()[0]);
$heap_sort_t_thousand->heapSort($heap_sort_t_thousand->get_unshorted_list(), $n);
echo $heap_sort_t_thousand->bottomText_general( '10,000' );

$heap_sort_hun_thousand = new sortThis("Heap Sort", $dummyData->get_hun_thous_Array());
$n = sizeof($heap_sort_hun_thousand->get_unshorted_list())/sizeof($heap_sort_hun_thousand->get_unshorted_list()[0]);
$heap_sort_hun_thousand->heapSort($heap_sort_hun_thousand->get_unshorted_list(), $n);
echo $heap_sort_hun_thousand->bottomText_general( '100,000' );

$heap_sort_mill = new sortThis("Heap Sort", $dummyData->get_mill_Array());
$n = sizeof($heap_sort_mill->get_unshorted_list())/sizeof($heap_sort_mill->get_unshorted_list()[0]);
$heap_sort_mill->heapSort($heap_sort_mill->get_unshorted_list(), $n);
echo $heap_sort_mill->bottomText_general( '1,000,000' );

$heap_sort_t_mill = new sortThis("Heap Sort", $dummyData->get_ten_mill_Array());
$n = sizeof($heap_sort_t_mill->get_unshorted_list())/sizeof($heap_sort_t_mill->get_unshorted_list()[0]);
$heap_sort_t_mill->heapSort($heap_sort_t_mill->get_unshorted_list(), $n);
echo $heap_sort_t_mill->bottomText_general( '10,000,000' );

echo '<hr>';


$result1 = !is_null($insertion_sort_t)  ? $insertion_sort_t->get_execution() : '-NOT PERFORMED-';
$result2 = !is_null($heap_sort_t) ? $heap_sort_t->get_execution() : '-NOT PERFORMED-';
// $result3 = is_null('yrdy') ? 'foo' : '-NOT PERFORMED-';

$result4 = !is_null($insertion_sort_t_thousand) ? $insertion_sort_t_thousand->get_execution() : '-NOT PERFORMED-';
$result5 = !is_null($heap_sort_t_thousand) ? $heap_sort_t_thousand->get_execution() : '-NOT PERFORMED-';
// $result6 = !is_null() ? 'foo' : '-NOT PERFORMED-';

$result7 = !is_null($insertion_sort_h_thousand) ? $insertion_sort_h_thousand->get_execution() : '-NOT PERFORMED-';
$result8 = !is_null($heap_sort_hun_thousand) ? $heap_sort_hun_thousand->get_execution() : '-NOT PERFORMED-';
// $result9 = !is_null() ? 'foo' : '-NOT PERFORMED-';

$result10 = !is_null($insertion_sort_mill) ? $insertion_sort_mill->get_execution() : '-NOT PERFORMED-';
$result11 = !is_null($heap_sort_mill) ? $heap_sort_mill->get_execution() : '-NOT PERFORMED-';
// $result12 = !is_null() ? 'foo' : '-NOT PERFORMED-';

$result13 = !is_null($insertion_sort_t_mill) ? $insertion_sort_t_mill->get_execution() : '-NOT PERFORMED-';
$result14 = !is_null($heap_sort_t_mill) ? $heap_sort_t_mill->get_execution() : '-NOT PERFORMED-';
// $result15 = !is_null() ? 'foo' : '-NOT PERFORMED-';

$output ='<h1>FINAL RESULTS</h1>';
$output .='<table id="final">';
$output .='<tbody>';
$output .='<tr>';
$output .='<th>&nbsp;</th>';
$output .='<th>Insertion Sort</th>';
$output .='<th>Heap Sort</th>';
$output .='<th>Counting Sort</th>';
$output .='</tr>';
$output .='<tr>';
$output .='<td>10</td>';
$output .='<td>'.$result1.'</td>';
$output .='<td>'.$result2.'</td>';
$output .='<td>&nbsp;</td>';
$output .='</tr>';
$output .='<tr>';
$output .='<td>10,000</td>';
$output .='<td>'.$result4.'</td>';
$output .='<td>'.$result5.'</td>';
$output .='<td>&nbsp;</td>';
$output .='</tr>';
$output .='<tr>';
$output .='<td>100,000</td>';
$output .='<td>'.$result7.'</td>';
$output .='<td>'.$result8.'</td>';
$output .='<td>&nbsp;</td>';
$output .='</tr>';
$output .='<tr>';
$output .='<td>1,000,000</td>';
$output .='<td>'.$result10.'</td>';
$output .='<td>'.$result11.'</td>';
$output .='<td>&nbsp;</td>';
$output .='</tr>';
$output .='<tr>';
$output .='<td>10,000,000</td>';
$output .='<td>'.$result13.'</td>';
$output .='<td>'.$result14.'</td>';
$output .='<td>&nbsp;</td>';
$output .='</tr>';
$output .='</tbody>';
$output .='</table>';


echo $output;

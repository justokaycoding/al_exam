<?php
ini_set('memory_limit', '128G');
ini_set('max_execution_time', '0'); // for infinite time of execution
require_once('dummyData.php');

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

  public function genNumber($count){
    $fourRandomDigit = array();
    for($index = 0; $index <= $count; $count--){
      array_push($fourRandomDigit, mt_rand(1000,9999));
    }
    return $fourRandomDigit;
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

  public function heapify($arr, $n, $i){
      $largest = $i; // Initialize largest as root
      $l = 2*$i + 1; // left = 2*i + 1
      $r = 2*$i + 2; // right = 2*i + 2

      // If left child is larger than root
      if ($l < $n && $arr[$l] > $arr[$largest]){
          $largest = $l;
        }

      // If right child is larger than largest so far
      if ($r < $n && $arr[$r] > $arr[$largest]){
          $largest = $r;
      }

      // If largest is not root
      if ($largest != $i){
          $swap = $arr[$i];
          $arr[$i] = $arr[$largest];
          $arr[$largest] = $swap;
        }
          // Recursively heapify the affected sub-tree
          $this->heapify($arr, $n, $largest);
      }

  // main function to do heap sort
  function heap_Sort($arr, $n){
      // Build heap (rearrange array)
      for ($i = $n / 2 - 1; $i >= 0; $i--){
          $this->heapify($arr, $n, $i);
        }

      // One by one extract an element from heap
      for ($i = $n-1; $i > 0; $i--){
          // Move current root to end
          $temp = $arr[0];
              $arr[0] = $arr[$i];
              $arr[$i] = $temp;

          // call max heapify on the reduced heap
          $this->heapify($arr, $i, 0);
      }
  }
}

echo file_get_contents("styles.css");

//dummy dataClass
$dummyData = new dummyData();

//instace of number
//$insertion_sort_t = new sortThis("Insertion Sort", $dummyData->get_ten_Array());
//sort number
//$insertion_sort_t->insertion_Sort($insertion_sort_t->get_unshorted_list());
//markup build
//$insertion_sort_t->topText_general( $insertion_sort_t->get_sort_type(), $insertion_sort_t->get_unshorted_list(), $insertion_sort_t->get_shorted_list(), $insertion_sort_t->get_execution() );


// $insertion_sort_t_thousand = new sortThis("Insertion Sort", $dummyData->get_ten_thous_Array());
// $insertion_sort_t_thousand->insertion_Sort($insertion_sort_t_thousand->get_unshorted_list());
// echo $insertion_sort_t_thousand->bottomText_general( '10,000' );
//
// $insertion_sort_t_h_thousand = new sortThis("Insertion Sort", $dummyData->get_hun_thous_Array());
// $insertion_sort_t_h_thousand->insertion_Sort($insertion_sort_t_h_thousand->get_unshorted_list());
// echo $insertion_sort_t_h_thousand->bottomText_general( '100,000' );
//
// $insertion_sort_mill = new sortThis("Insertion Sort", $dummyData->get_mill_Array());
// $insertion_sort_mill->insertion_Sort($insertion_sort_mill->get_unshorted_list());
// echo $insertion_sort_mill->bottomText_general( '1,000,000' );
//
// $insertion_sort_t_mill = new sortThis("Insertion Sort", $dummyData->get_ten_mill_Array());
// $insertion_sort_t_mill->insertion_Sort($insertion_sort_t_mill->get_unshorted_list());
// echo $insertion_sort_t_mill->bottomText_general( '10,000,000' );

//instace of number
$heap_sort_t = new sortThis("Heap Sort", $dummyData->get_ten_Array());
//sort number
$n = sizeof($heap_sort_t->get_unshorted_list())/sizeof($heap_sort_t->get_unshorted_list()[0]);
$heap_sort_t->heap_Sort($heap_sort_t->get_unshorted_list(), $n);
//markup build
$heap_sort_t->topText_general( $heap_sort_t->get_sort_type(), $heap_sort_t->get_unshorted_list(), $heap_sort_t->get_shorted_list(), $heap_sort_t->get_execution() );

<?php
ini_set('memory_limit', '1G');
ini_set('max_execution_time', '0'); // for infinite time of execution

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
  // hold those instance variables
  public static $masterArray = array();

  // hold largest number in array
  public $largestNumber;

  function __construct($type, $num ){
    $this->sortType = $type;
    $this->num = $num;
    $this->set_unshorted_list($this->genNumber($this->num));

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

  public function insertion_Sort($my_array){

   $this->set_startTime();

   for($i=0; $i<count($my_array); $i++){
     $val = $my_array[$i];
     $j = $i-1;
     while($j>=0 && $my_array[$j] > $val){
       $my_array[$j+1] = $my_array[$j];
       $j--;
     }
     $my_array[$j+1] = $val;
   }
    $this->shorted = $my_array;
    $this->set_endTime();
  }
}

echo file_get_contents("styles.css");

//instace of number
$insertion_sort_t = new sortThis("Insertion Sort", 10);
//sort number
$insertion_sort_t->insertion_Sort($insertion_sort_t->get_unshorted_list());
//markup build
$insertion_sort_t->topText_general( $insertion_sort_t->get_sort_type(), $insertion_sort_t->get_unshorted_list(), $insertion_sort_t->get_shorted_list(), $insertion_sort_t->get_execution() );

$insertion_sort_t_thousand = new sortThis("Insertion Sort", 10000);
$insertion_sort_t_thousand->insertion_Sort($insertion_sort_t_thousand->get_unshorted_list());
echo $insertion_sort_t_thousand->bottomText_general( '10,000' );

$insertion_sort_t_h_thousand = new sortThis("Insertion Sort", 100000);
$insertion_sort_t_h_thousand->insertion_Sort($insertion_sort_t_h_thousand->get_unshorted_list());
echo $insertion_sort_t_h_thousand->bottomText_general( '10,0000' );

$insertion_sort_t_h_thousand = new sortThis("Insertion Sort", 1000000);
$insertion_sort_t_h_thousand->insertion_Sort($insertion_sort_t_h_thousand->get_unshorted_list());
echo $insertion_sort_t_h_thousand->bottomText_general( '10,0000' );

$insertion_sort_t_h_thousand = new sortThis("Insertion Sort", 10000000);
$insertion_sort_t_h_thousand->insertion_Sort($insertion_sort_t_h_thousand->get_unshorted_list());
echo $insertion_sort_t_h_thousand->bottomText_general( '10,0000' );

<?php
namespace PDate;

use PDate\Shamsi;
use PhpParser\Node\Expr\Throw_;

class PDate extends Shamsi
{

  private $_timestamp = 0;
  private string $_format = 'Y-m-d H:i:s';

  private array $_time = [0,0,0];

  private const day_sec = 86400;
  private const week_sec = 604800;


  public static function check(int|string $day, int|string $month, int|string $year):bool{
    return self::new()->jcheckdate($month, $day, $year);
  }

  public static function checkStr(string $date, string $separator='-'):bool{
      $arr = explode($separator, $date);

      if(count($arr)!=3){
        return false;
      }

    return self::check($arr[2], $arr[1], $arr[0]);
  }



  public static function new()
  {
    return (new PDate);
  }


  public function format(string $format)
  {
    $this->_format = $format;
    return $this;
  }

  public function timestamp($value = false): PDate|string
  {

    if ($value !== false) {
      if ($this->_timestamp!==0) {
        throw new \Exception("You have not set the timestamp in the right place.", 1);
      } else {
        $this->_timestamp = $value;
      }
      return $this;
    } else {
      return $this->_timestamp;
    }
  }

  public function now()
  {
    $this->_timestamp = time();
    return $this;
  }

  public function addDay($day)
  {
    $this->_timestamp = $this->_timestamp +
     (self::day_sec * $day);
    return $this;
  }

  public function addWeek($week)
  {
    $this->_timestamp = $this->_timestamp + (self::week_sec * $week);
    return $this;
  }

  public function addMonth($month)
  {
    $current_month = $this->month();
    $this->_timestamp = $this->jmktime($this->hour(), $this->minutes(), $this->second(), ($current_month + $month), $this->day(), $this->year());
    return $this;
  }

  public function monthDays($timestamp = false): int
  {
    return intval($this->jdate('t', $timestamp ? $timestamp : $this->_timestamp));
  }




  public function year(): int
  {
    return intval($this->jdate('Y', $this->_timestamp));
  }

  public function month(): int
  {
    return intval($this->jdate('m', $this->_timestamp));
  }

  public function day(): int
  {
    return intval($this->jdate('d', $this->_timestamp));
  }

  public function hour(): int
  {
    return intval($this->jdate('H', $this->_timestamp));
  }

  public function minutes(): int
  {
    return intval($this->jdate('i', $this->_timestamp));
  }

  public function second(): int
  {
    return intval($this->jdate('s', $this->_timestamp));
  }

  public function clock(): string
  {
    return $this->jdate('H:i:s', $this->_timestamp);
  }

  public function monthName(): string
  {
    return $this->jdate('F', $this->_timestamp);
  }



  private function detectTimeFromString(&$str){

    $ex_date_and_time = explode(' ' , $str);

    if(in_array(count($ex_date_and_time),[2,3]) && strpos($ex_date_and_time[1], ':')>0){
      $str = $ex_date_and_time[0];
      $this->_time =explode(':',  $ex_date_and_time[1]);
    }

  }

  private function detectTimeFromArray($array){
    $ex_date_and_time = explode(' ' , $array[count($array)-1]);

    if(in_array(count($ex_date_and_time),[2,3]) && strpos($ex_date_and_time[1], ':')>0){
      $array[count($array)-1] = $ex_date_and_time[0];
      $this->_time =explode(':',  $ex_date_and_time[1]);
    }
  }


  public function fromGregorian(array|string $gregorian_date, $separator = '-')
  {
    if(is_string($gregorian_date)){

      $this->detectTimeFromString($gregorian_date);

      $array = explode($separator, $gregorian_date);
    }
    else{

      $this->detectTimeFromArray($gregorian_date);

      $array = $gregorian_date;
    }

    if(count($array)!=3){
      throw new \Exception("gregorian_date format is not valid", 1);
    }

    $result = $this->gregorian_to_jalali(intval($array[0]), intval($array[1]), intval($array[2]));
    $this->_timestamp = $this->jmktime($this->_time[0]??0,$this->_time[1]??0, $this->_time[2]??0, $result[1], $result[2], $result[0]);
    return $this;
  }

  public function fromShamsi(array|string $shamsi_date, $separator = '-')
  {
    if(is_string($shamsi_date)){

      $this->detectTimeFromString($shamsi_date);

      $array = explode($separator, $shamsi_date);
    }
    else{

      $this->detectTimeFromArray($shamsi_date);

      $array = $shamsi_date;
    }

    if(count($array)!=3){
      throw new \Exception("shamsi_date format is not valid", 1);
    }

    $result = $this->jalali_to_gregorian(intval($array[0]), intval($array[1]), intval($array[2]));
    $this->_timestamp = mktime($this->_time[0]??0,$this->_time[1]??0, $this->_time[2]??0, $result[1], $result[2], $result[0]);
    return $this;
  }
  


  public function get()
  {
    $this->initTimestamp();
    return $this->jdate($this->_format, $this->_timestamp);
  }

  public function getGregorian()
  {
    $this->initTimestamp();
    return date($this->_format, $this->_timestamp);
  }


  private function initTimestamp(){
    if($this->_timestamp === 0){
      $this->_timestamp = time();
    }
  }

}

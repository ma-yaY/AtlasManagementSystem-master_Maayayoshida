<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center table m-auto border ">';
    $html[] = '<table class="table m-auto border adjust-table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';
      /*$html[] = '<tr class="'.$week->pastClassName().'">';*/

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        /**今日より以前の日にち */
        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="past-day border" >';
          /*$html[] = '<td class="calendar-td">';*/
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().' border ">';
        }
        $html[] = $day->render();

        /**登録ユーザーが予約していた場合 */
        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "1";
          }else if($reservePart == 2){
            $reservePart = "2";
          }else if($reservePart == 3){
            $reservePart = "3";
          }
          /**今日より以前の日にち */
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'. $reservePart .'部参加</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';


          }else{/*class="'.$week->getClassName().'"
            /**予約をキャンセルする場合。
               first()＝単一のレコード取得*/
            $html[] = '<button type="submit" class="danger-modal-open btn btn-danger p-0 w-75"  delete_part="'.$reservePart.'" style="font-size:12px" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">リモ'. $reservePart .'部</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts" >';

          }
          }else {/*予約してない*/
            /*予約してなくて日付が今日以前*/
            if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">受付終了</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';

            }else {
              /*予約してなくて日付が今日以降*/
              $html[] =$day->selectPart($day->everyDay());
            }



          }

        $html[] = $day->getDate();
        $html[] = '</p>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}

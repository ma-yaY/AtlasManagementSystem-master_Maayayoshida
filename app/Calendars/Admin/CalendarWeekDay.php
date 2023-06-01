<?php
namespace App\Calendars\Admin;

use Carbon\Carbon;
use App\Models\Calendars\ReserveSettings;

class CalendarWeekDay{
  protected $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  /*クラス名の取得*/
  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

  /*日付をテンプレートを表示すること（＝レンダリングすること）*/
  function render(){
    return '<p class="day">' . $this->carbon->format("j") . '日</p>';
  }
  /*毎日の配列方法*/
  function everyDay(){
    return $this->carbon->format("Y-m-d");
  }
  /*その日の中身*/
  function dayPartCounts($ymd){
    $html = [];
    /*ReserveSettings Modelを使用して、リレーションしたusersを使用。*/
    $one_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
    $two_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
    $three_part = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();

    $html[] = '<div class="text-left">';
    if($one_part){

      /*上記で定義したpart（部）より、usersにある予約情報をカウント*/
      /*web.phpにnameがあるのでリンクはroute*/
      $html[] = '<p class="day_part m-0 pt-1" href= "'.route('calendar.admin.detail',['reservePersons'=>$one_part->users, 'date'=>$one_part->setting_reserve, 'part'->$one_part->setting_part, 'created_at'=>$one_part->render()]).'">1部'.$one_part->users->count().'</p>';
      /*パラメータの受け渡しができていない*/


      /*<a href= "'.route('calendar.admin.detail',['reservePersons'=>'人数']).'"></a>*/
    }
    if($two_part){
      $html[] = '<p class="day_part m-0 pt-1">2部'.$two_part->users->count().'</p>';


    }
    if($three_part){
      $html[] = '<p class="day_part m-0 pt-1">3部'.$three_part->users->count().'</p>';
    }
    $html[] = '</div>';

    return implode("", $html);
  }


  function onePartFrame($day){
    $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first();
    if($one_part_frame){
      $one_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '1')->first()->limit_users;
    }else{
      $one_part_frame = "20";
    }
    return $one_part_frame;
  }
  function twoPartFrame($day){
    $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first();
    if($two_part_frame){
      $two_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '2')->first()->limit_users;
    }else{
      $two_part_frame = "20";
    }
    return $two_part_frame;
  }
  function threePartFrame($day){
    $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first();
    if($three_part_frame){
      $three_part_frame = ReserveSettings::where('setting_reserve', $day)->where('setting_part', '3')->first()->limit_users;
    }else{
      $three_part_frame = "20";
    }
    return $three_part_frame;
  }

  //調整？
  function dayNumberAdjustment(){
    $html = [];
    $html[] = '<div class="adjust-area">';
    $html[] = '<p class="d-flex m-0 p-0">1部<input class="w-25" style="height:20px;" name="1" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">2部<input class="w-25" style="height:20px;" name="2" type="text" form="reserveSetting"></p>';
    $html[] = '<p class="d-flex m-0 p-0">3部<input class="w-25" style="height:20px;" name="3" type="text" form="reserveSetting"></p>';
    $html[] = '</div>';
    return implode('', $html);
  }
}

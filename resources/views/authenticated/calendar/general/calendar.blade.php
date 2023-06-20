@extends('layouts.sidebar')

@section('content')
<div class="vh-100 p-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-100 m-auto " style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
  <div class="modal js-modal" >
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content" >

    <!--<form>タグはCalendarViewに記述済み-->
      <div class="w-100">
        <div class="modal-inner-part w-50 m-auto">
            <p>予約日：<input type="text" style="border:none" id="delete_date" name="delete_date" value="" readonly form="deleteParts"></p>
            <p>時間：リモ<input type="text" style="border:none" id="delete_part" name="delete_part" value="" readonly form="deleteParts" size="1">部</p>
          <p >上記の予約をキャンセルしてもよろしいですか？</p>
        </div>

        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="submit"  class="btn btn-primary d-block" value="キャンセル" form="deleteParts">
        </div>
      </div>
    </div>
  </div>
@endsection

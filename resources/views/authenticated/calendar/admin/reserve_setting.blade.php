@extends('layouts.sidebar')
@section('content')
<div class="vh-100 p-5" style="align-items:center; justify-content:center; border w-75 m-auto pb-5">
  <div class=" w-75 m-auto border pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection

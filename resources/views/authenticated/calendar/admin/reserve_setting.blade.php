@extends('layouts.sidebar')
@section('content')
<div class="calenders">
  <div class="resarve_settings" >
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="text-right">
      <input type="submit" class="btn btn-primary " value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection

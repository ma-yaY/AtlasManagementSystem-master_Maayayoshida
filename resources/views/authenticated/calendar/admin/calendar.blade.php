@extends('layouts.sidebar')

@section('content')
<div class="calenders">
  <!--スクール予約確認-->
  <div class="confirmation">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>

</div>
@endsection

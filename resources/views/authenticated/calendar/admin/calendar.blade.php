@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto border pt-5 pb-5" style="border-radius:5px; background:#FFF;">
  <div class="w-100">
    <p>{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>

</div>
@endsection

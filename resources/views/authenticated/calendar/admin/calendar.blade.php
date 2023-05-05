@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto">
  <div class="w-100">
    <p>{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
  <!--<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
    <form action="{{ route('calender.reserve') }}" method="post">
      <div class="w-100">
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="delete_date" value="">
          <input type="submit" class="btn btn-primary d-block" value="キャンセル">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
    </div>
  </div>-->
</div>
@endsection

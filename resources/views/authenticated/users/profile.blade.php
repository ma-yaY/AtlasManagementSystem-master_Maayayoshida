@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <span>{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span>
    <div class="user_status p-3">
      <p>名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
      <p>カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
      <p>性別 : @if($user->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
      <p>生年月日 : <span>{{ $user->birth_day }}</span></p>
      <div>選択科目 :
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
      </div>
      <div class="users_subject" style="color:#03AAD2;">
        @can('admin')
        <input type="checkbox" class="subject_edit_btn" id="ac-box">選択科目の編集</input>
        <div class="subject_inner" for="ac-box">
          <form action="{{ route('user.edit') }}" method="post">
            @foreach($subject_lists as $subject_list)
              <label style="color:#000;">{{ $subject_list->subject }}</label>
              <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
            @endforeach
            <input type="submit" value="編集" class="btn btn-primary">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            {{ csrf_field() }}
          </form>
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>

@endsection

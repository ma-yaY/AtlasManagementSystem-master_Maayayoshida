@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
  <div class="top_area w-75 m-auto pt-5">
    <p>マイページ</p>
    <div class="user_status p-3">
      <p class="userRegistrant ml-1">名前：<span class="userRegistrant ml-1">{{ Auth::user()->over_name }}</span><span class="userRegistrant ml-1">{{ Auth::user()->under_name }}</span></p>
      <p class="userRegistrant ml-1">カナ：<span class="userRegistrant ml-1">{{ Auth::user()->over_name_kana }}</span><span class="user_status ml-1">{{ Auth::user()->under_name_kana }}</span></p>
      <p class="userRegistrant ml-1">性別：@if(Auth::user()->sex == 1)<span class="userRegistrant ml-1">男</span>@else<span class="userRegistrant ml-1">女</span>@endif</p>
      <p class="userRegistrant ml-1">生年月日：<span class="userRegistrant ml-1">{{ Auth::user()->birth_day }}</span></p>
    </div>
  </div>
</div>
@endsection

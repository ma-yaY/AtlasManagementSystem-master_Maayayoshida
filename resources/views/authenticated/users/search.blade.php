@extends('layouts.sidebar')

@section('content')
<!--ユーザー検索-->
<div class="search_content w-100  d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class=" one_person">
      <div>
        <span>ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span>男</span>
        @else
        <span>性別 : </span><span>女</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span>講師(英語)</span>
        @else
        <span>権限 : </span><span>生徒</span>
        @endif
      </div>
      @if($user->role == 4)
        <div>
          <span >選択科目 :</span>
          @foreach($user->subjects as $subject)
            <span>{{ $subject->subject }}</span>
          @endforeach
        </div>
      @endif
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 ">
    <div class="">
      <div>
        <span style="font-size: 18px;">検索</span><br>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索"   form="userSearchRequest">
      </div>
      <div>
        <span >カテゴリ</span><br>
        <select class="select_Search" form="userSearchRequest" name="category">
          <option  value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <label>並び替え</label><br>
        <select class="select_Search" name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <input type="checkbox" class="search_conditions" style="border-bottom: thin solid #000;" id="ac-box"><span >検索条件の追加</span></input>
        <div class="search_conditions_inner" for="ac-box">
          <div>
            <label>性別</label><br>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
          </div>
          <div>
            <label>権限</label>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled value="0">----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label>選択科目</label><br>
            @foreach($subjects as $subject)
            <span>{{ $subject->subject }}</span><input type="checkbox" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest">
            @endforeach
          </div>
        </div>
      </div>
      <div>
        <input class="Search_btn" type="submit" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div class="SearchReset_btn">
        <input type="reset" style="border:none; color:#03AAD2; background: #ECF1F6;" value="リセット" form="userSearchRequest">
      </div>
      <script>
        $(document).ready(function(){
        $(".SearchReset_btn input[type='reset']").click(function(e){
          e.preventDefault();
          $("select[name='role']").prop('selectedIndex',0);
        });
        });
      </script>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection

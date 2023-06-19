@extends('layouts.sidebar')

@section('content')
<div class="reserve_user vh-100 " style="align-items:center; justify-content:center;">
  <div class="reserve_userArea w-75 m-auto pt-5" >
    <p ><span>{{$date}}日</span><span class="ml-3">{{$part}}部</span></p>
    <div class="reserve_userBox p-3">
      <table class="reserve_users">
      @foreach($reservePersons as $reservePersons)
        <tr class="text-centerTop" style="color:#fff;">
          <th class="w-25 pl-2">ID</th>
          <th class="w-25 pl-2">名前</th>
          <th class="w-25 pl-2">場所</th>
        </tr>

          @foreach($reservePersons->users as $user_s)
            <tr class="text-centers">
              <td class="w-25 p-2" style="text-align:left;"><span>{{ $user_s->id}}</span></td>
              <td class="w-25 p-2" style="text-align:left;"><span>{{ $user_s -> over_name}}</span><span>{{ $user_s -> under_name}}</span></td>
              <td class="w-25 p-2" style="text-align:left;"><span>リモート</span></td>
              <td class="ml-3"><span></span></td>
            </tr>
          @endforeach
      @endforeach
      </table>
    </div>
  </div>
</div>
@endsection

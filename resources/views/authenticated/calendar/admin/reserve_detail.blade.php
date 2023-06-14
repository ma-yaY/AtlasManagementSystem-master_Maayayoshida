@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">


    <p><span>{{$date}}日</span><span class="ml-3">{{$part}}部</span></p>
    <div class="h-75 border">
      <table class="">
      @foreach($reservePersons as $reservePersons)
        <tr class="text-center">
          <th class="w-25">ID</th>
          <th class="w-25">名前</th>
          <th class="w-25">場所</th>
        </tr>

          @foreach($reservePersons->users as $user_s)
           <tr class="text-center">
              <td class="w-25"><span>{{ $user_s->id}}</span></td>
              <td class="w-25"><span>{{ $user_s -> over_name}}</span><span>{{ $user_s -> under_name}}</span></td>
              <td class="w-25"><span>リモート</span></td>
              <td class="ml-3"><span></span></td>
            </tr>
          @endforeach
      @endforeach
      </table>
    </div>
  </div>
</div>
@endsection

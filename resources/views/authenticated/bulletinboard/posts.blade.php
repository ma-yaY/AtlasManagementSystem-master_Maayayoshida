@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
      <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>

      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">

          @foreach($post->subCategories as $sub_category)
              <p><span>{{ $sub_category->sub_category}}</span></p>
          @endforeach

          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">{{$post->postComments->count($post->id)}}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @endif
          </div>

        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25">
    <div class=" m-4">
      <div class="searchInput" style=" text-align:center; border:thin solid #03AAD2; opacity:0.7; border-radius:5px; background-color:#03AAD2;">
        <a style="color:#FFF;" href="{{ route('post.input') }}">投稿</a>
      </div>
      <div class="searchPost">
        <input type="text" placeholder="キーワードを検索" style=" border:thin solid #999999; opacity:0.7; background-color:#ECF1F6; border-radius: 5px;" name="keyword" form="postSearchRequest">
        <input type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest">
      <ul>
        @foreach($categories as $category)
        <li class="main_categories"><span>{{ $category->main_category }}<span></li>
          @foreach($category->subCategories as $subCategory)
          <li><input type="submit" name="category_word" class="category_btn" value="{{ $subCategory->sub_category }}" form="postSearchRequest"></li>
          @endforeach
        @endforeach
      </ul>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection

<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\BulletinBoard\EditPostFormRequest;
use App\Http\Requests\BulletinBoard\MainRequest;
use App\Http\Requests\BulletinBoard\SubRequest;
use App\Http\Requests\BulletinBoard\commentFormRequest;
use Auth;

class PostsController extends Controller
{


    public function show(Request $request){
        $posts = Post::with('user', 'postComments','subCategories')->get();
        $categories = MainCategory::get();
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            $posts = Post::with('user', 'postComments')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
        }else if($request->category_word){
            $posts = Post::with('user', 'postComments')
            ->whereHas('subCategories', function ($q) use($request){
                $q->where('sub_category', 'LIKE', '%'.$request['category_word'].'%');
            })->get();

        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }

        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }


    public function postDetail($post_id){
        $post = Post::with('user', 'postComments', 'subCategories')->findOrFail($post_id);

        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }


    public function postInput(){
        $main_categories = MainCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);

        $Sub_Category = $request->post_category_id;
        $post_sub_categories = Post::findOrFail($post->id);
        $post_sub_categories->subCategories()->attach($Sub_Category);
        return redirect()->route('post.show');
    }

    //投稿編集
    public function postEdit(EditPostFormRequest $request){
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }

    //mainCategory追加
    public function mainCategoryCreate(MainRequest $request){

        MainCategory::create(['main_category' => $request->main_category]);
        return redirect()->route('post.input');
    }

    //メイン選択サブカテゴリー登録
    public function subCategoryCreate(SubRequest $request){
        $main_category_id = $request->input('main_category_id');
        $Sub_Category = $request->input('sub_category');

        \DB::table('sub_categories')->insert([
            'main_category_id' => $main_category_id,
            'sub_category' => $Sub_Category
        ]);
        return redirect()->route('post.input');
    }

    public function commentCreate(commentFormRequest $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();//like_user_idとuser_idを配列に変換
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }



    public function postLike(Request $request){
        Auth::user()->likes()->attach($request->post_id);
        return response()->json();
    }

    public function postUnLike(Request $request){
        Auth::user()->likes()->detach($request->post_id);
        return response()->json();

    }




}

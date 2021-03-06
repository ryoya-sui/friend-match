<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{

    //投稿記事一覧
    public function index(Request $request)
    {
        $key = $request->key;

        $query = Post::query();
        
        if (!empty($key)) {
            $query->where('title', 'like', '%' . $key . '%')->orWhere('body', 'like', '%' . $key . '%');
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    //記事投稿用のフォーム
    public function form()
    {
        return view('posts.form');
    }

    //記事の作成
    public function create(CreatePostRequest $request)
    {
        $tags = explode(' ', $request->tags);
        $tag1 = $tags[0];
        $tag2 = (isset($tags[1])) ? $tags[1] : null;
        $tag3 = (isset($tags[2])) ? $tags[2] : null;

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'tag1' => $tag1,
            'tag2' => $tag2,
            'tag3' => $tag3,
            'body' => $request->body
        ]);

        $msg = '投稿しました。どんどんアウトプットしましょう';
        return redirect()->route('post.details', ['id' => $post->id])->with('flash_message', $msg);
    }

    //投稿詳細
    public function details($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.details', compact('post'));
    }

    //投稿の編集ページ
    public function edit($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        
        if (empty($post)) {
            return back();
        }

        return view('posts.edit_form', compact('post'));
    }

    //投稿の編集
    public function update(CreatePostRequest $request)
    {
        $post = Post::where('id', $request->id)->where('user_id', Auth::id())->first();

        if (empty($post)) {
            return back();
        }

        $tags = explode(' ', $request->tags);
        $tag1 = $tags[0];
        $tag2 = (isset($tags[1])) ? $tags[1] : null;
        $tag3 = (isset($tags[2])) ? $tags[2] : null;

        $post->title = $request->title;
        $post->tag1 = $tag1;
        $post->tag2 = $tag2;
        $post->tag3 = $tag3;
        $post->body = $request->body;
        $post->save();

        $msg = '記事の内容を編集しました。';
        return redirect()->route('post.details', ['id' => $post->id])->with('flash_message', $msg);
    }

    //投稿の削除
    public function delete(Request $request)
    {
        $post = Post::where('id', $request->id)->where('user_id', Auth::id())->first();

        if (empty($post)) {
            return back();
        }

        $post->delete();
        $msg = '投稿を削除しました';
        return redirect()->route('post.index')->with('flash_message', $msg);
    }

}

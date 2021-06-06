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

        $posts = $query->orderBy('created_at', 'desc')->get();
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

        $msg = "ナイス!!どんどんアプトプットしていこう!";
        return redirect()->route('post.details', ['id' => $post->id])->with('flash_message', $msg);
    }

    //投稿詳細
    public function details($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.details', compact('post'));
    }
}

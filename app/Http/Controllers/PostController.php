<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{

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
        $tag2 = (isset($tags[1])) ?: null;
        $tag3 = (isset($tags[2])) ?: null;

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'tag1' => $tag1,
            'tag2' => $tag2,
            'tag3' => $tag3,
            'body' => $request->body
        ]);

        return redirect()->route('post.details', ['id' => $post->id]);
    }

    //投稿詳細
    public function details($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.details', compact('post'));
    }
}

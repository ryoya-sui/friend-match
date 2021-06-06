@extends('layouts.layout')
@section('content')
<div class="top-wrapper">
    <div class="post-search-form col-md-6">
    <form class="form-inline" action="{{ route('post.index') }}">
        <div class="form-group">
            <input type="text" name="key"  class="form-control" placeholder="キーワードを入力">
        </div>
      <input type="submit" value="検索" class="btn btn-info">
    </form>
    </div>
    <div class="posts-wrapper col-md-6">
        @foreach ($posts as $post)
        <div class="post-box">
            <div class="post-box-left"><a href="#"><img src="{{ asset('images/friend-match.png') }}"></a></div>
            <div class="post-box-right">
                <a class="post-title" href="{{ route('post.details', ['id' => $post->id]) }}">{{ $post->title }}</a>
                <div class="post-details">
                    <div class="post-date">{{ $post->created_at }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection


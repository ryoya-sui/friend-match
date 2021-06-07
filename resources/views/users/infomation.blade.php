@extends('layouts.layout')

@section('content')

<div class='usershowPage'>
  <div class='container'>
    <header class="header">
      <p class='header_logo'>
      <a href="{{ route('home') }}">
      <img src="{{ asset('images/friend-match.png') }}">
      </a>
      </p>
    </header>
    <div class='userInfo'>
      <div class='userInfo_img'>
      <img src="{{ asset('storage/images/' . $user->img_name) }}">
      </div>
      <div class='userInfo_name'>{{ $user->name }}</div>
      <div class='userInfo_selfIntroduction'>{{ $user->self_introduction }}</div>
    </div>
  </div>
  @if ($posts->count() > 0)
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
              <div class="post-box-left">
              @if ($post->user->img_name)
                  <a href="#"><img src="{{ asset('storage/images/' . $post->user->img_name) }}"></a>
              @else
                  <a href="#"><img src="{{ asset('images/friend-match.png') }}"></a>
              @endif
              </div>
              <div class="post-box-right">
                  <a class="post-title" href="{{ route('post.details', ['id' => $post->id]) }}">{{ $post->title }}</a>
                  <div class="post-details">
                      <div class="post-date">{{ $post->created_at }}</div>
                  </div>
              </div>
          </div>
          @endforeach
  </div>
  @endif
</div>

@endsection


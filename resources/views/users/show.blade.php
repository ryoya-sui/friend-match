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
      <div class='userInfo_name'>
       <div class='name_label'>ユーザー名</div>
       <div class='name'>{{ $user->name }}</div>
      </div>
      <div class='userInfo_tag'>
        <div class='tag_label'>学習中のカテゴリー</div>
        @if (empty($user->category))
        <div class='tag'>未設定</div>
        @else
        <div class='tag'>{{ $user->category }}</div>
        @endif
      </div>
      <div class='userInfo_selfIntroduction'>
       <div class='selfIntroduction_label'>自己紹介</div>
       <div class='selfIntroduction'>{{ $user->self_introduction }}</div>
      </div>
    </div>
    <div class='userAction'>
      <div class="userAction_edit userAction_common">
        <a href="{{ route('users.edit') }}"><i class="fas fa-edit fa-2x"></i></a>
        <span>情報を編集</span>
      </div>
      <div class='userAction_logout userAction_common'>
      <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();"><i class="fas fa-cog fa-2x"></i></a>
        <span>ログアウト</span>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </div>
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
          {{ $posts->links() }}
  </div>
  @endif
</div>

@endsection


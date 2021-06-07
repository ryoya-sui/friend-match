@extends('layouts.layout')

@section('content')

<div class="topPage">
  <div class="user-search-form col-md-6">
    <form class="form-inline" action="{{ route('home') }}">
        <div class="form-group">
            <label>学習中カテゴリー・自己紹介文のキーワードで検索する:</label>
            <input type="text" name="key"  class="form-control" placeholder="キーワードを入力">
        </div>
      <input type="submit" value="検索" class="btn btn-info">
    </form>
  </div>
  <div class="nav">
    <ul>
      <li class="personIcon">
        <a href="{{ route('users.show') }}"><i class="fas fa-user fa-2x"></i></a></li>
      <li class="appIcon"><a href="{{ route('home') }}"><img src="{{ asset('images/friend-match.png') }}"></a></li>
      <li class="messageIcon"><a href="{{ route('matching') }}"><i class="fas fa-2x fa-comments"></a></i></li>
    </ul>
  </div>
  <div id="tinderslide">
    <ul>
        @foreach($users as $user)
        <li data-user_id="{{ $user->id }}">
          <img src="{{ asset('storage/images/' . $user->img_name) }}">
          <div class="userName">
            {{ $user->name }}
            @if (!empty($user->category)) 
            <div class="item-tags">
                <div class="item-tag">プログラミング</div>
            </div>
            @endif
          </div>
          <div class="like"></div>
          <div class="dislike"></div>
        </li>
        @endforeach
    </ul>
    <div class="noUser">お相手が見つかりません</div>
  </div>
  <div class="actions" id="actionBtnArea">
      <a href="#" class="dislike"><i class="fas fa-times fa-2x"></i></a>
      <a href="#" class="like"><i class="fas fa-heart fa-2x"></i></a>
  </div>
</div>

<script>
  var usersNum = {{ $userCount }};
  var from_user_id = {{ $from_user_id }};
</script>

@endsection


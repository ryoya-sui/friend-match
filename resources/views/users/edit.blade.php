@extends('layouts.layout')

@section('content')
<div class="signupPage">
  <header class="header">
    <div>アカウントを作成</div>
  </header>
  <div class='container'>

    <form class="form mt-5" method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
    @csrf

      <label for="file_photo" class="rounded-circle userProfileImg">
        <div class="userProfileImg_description">画像をアップロード</div>
        <i class="fas fa-camera fa-3x"></i>
        <input type="file" id="file_photo" name="img_name">

      </label>
      <div class="userImgPreview" id="userImgPreview">
        <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
        <p class="userImgPreview_text">画像をアップロード済み</p>
      </div>
      <div class="form-group @error('name')has-error @enderror">
        <label>名前</label>
        <input type="text" name="name" class="form-control" placeholder="名前を入力してください" value="{{ $user->name }}">
        @error("name")
            <span class="errorMessage">
              {{ $message }}
            </span>
        @enderror
  
    </div>
      <div class="form-group @error('email')has-error @enderror">
        <label>メールアドレス</label>
        <input type="email" name="email" class="form-control" placeholder="メールアドレスを入力してください" value="{{ $user->email }}">
        @error("email")
            <span class="errorMessage">
              {{ $message }}
            </span>
        @enderror
      </div>
      <div class="form-group">
        <div><label>性別</label></div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="sex" value="0" type="radio" id="inlineRadio1" {{ $user->sex == "0" ? "checked" : "" }}>
          <label class="form-check-label" for="inlineRadio1">男</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio2" {{ $user->sex == "1" ? "checked" : "" }}>
          <label class="form-check-label" for="inlineRadio2">女</label>
        </div>
      </div>
      <div class="form-group @error('self_introduction')has-error @enderror">
        <label>自己紹介文</label>
        <textarea class="form-control" name="self_introduction" rows="10">{{ $user->self_introduction }}</textarea>
          @error("self_introduction")
          <span class="errorMessage">
            {{ $message }}
          </span>
          @enderror
        </div>  
    </div>

      <div class="text-center">
      <button type="submit" class="btn submitBtn">更新</button>
      </div>
    </form>
  </div>
</div>
@endsection



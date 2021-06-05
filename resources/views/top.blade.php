@extends('layouts.layout')

@section('content')
<div class="loginPage">
  <div class="container">
    <div class="loginPage_contents">
    <h1 class="h3 loginPage_contents_title">一緒に勉強する仲間を見つけよう</h1>
    <div class="col-sm-3 btn">
        <div class="loginPage_contents_btn"><a class="text-white" href="{{ route('login') }}">メールアドレスでログインする</a></div>
        <div class="loginPage_contents_twitter_btn"><a class="text-white" href="{{ route('twitter.login') }}"><i class="fab fa-twitter fa-lg"></i>twitterログイン</a></div>
        <div class="loginPage_contents_facebook_btn"><a class="text-white" href="{{ route('facebook.login') }}"><i class="fab fa-facebook fa-lg"></i>facebookログイン</a></div>
    </div>
    </div>
  </div>
</div>
@endsection


@extends('layouts.layout')

@section('content')
<div class="loginPage">
  <div class="container">
    <div class="loginPage_contents">
    <h1 class="h3 loginPage_contents_title">一緒に勉強する仲間を見つけよう</h1>
    <div class="btn loginPage_contents_btn"><a class="text-white" href="{{ route('login') }}">メールアドレスでログインする</a></div>
    </div>
  </div>
</div>
@endsection


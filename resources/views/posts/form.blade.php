@extends('layouts.layout')
@section('content')
<form class="post-page-wrapper" action="{{ route('post.create') }}" method="post">
@csrf
    @if ($errors->first('title'))
        <div class="validation">{{ $errors->first('title') }}</div>
    @endif
    <input type="text" class="form-control m-1" id="title-input" placeholder="タイトル" name="title">
    @if ($errors->first('tags'))
        <div class="validation">{{ $errors->first('tags') }}</div>
    @endif
    <input type="text" class="form-control m-1" placeholder="タグをスペース区切りで3つまで入力" name="tags">
    @if ($errors->first('body'))
        <div class="validation">{{ $errors->first('body') }}</div>
    @endif
    <div class="row">
        <div class="col-6 m-1">
            <textarea name="body" id="markdown_editor_textarea" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="col-6 m-1">
            <div id="markdown_preview"></div>
        </div>
    </div>
    <div class="post-page-footer">
        <input type="submit" class="post-button m-1" value="投稿">
    </div>
</form>
@endsection



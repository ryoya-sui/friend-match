@extends('layouts.layout')
@section('content')
<form class="post-page-wrapper" action="{{ route('post.update') }}" method="post">
@csrf
    <input type="hidden" class="form-control m-1" name="id" value="{{ $post->id }}">
    @if ($errors->first('title'))
        <div class="validation">{{ $errors->first('title') }}</div>
    @endif
    <input type="text" class="form-control m-1" id="title-input" placeholder="タイトル" name="title" value="{{ $post->title }}">
    @if ($errors->first('tags'))
        <div class="validation">{{ $errors->first('tags') }}</div>
    @endif
    <input type="text" class="form-control m-1" placeholder="タグをスペース区切りで3つまで入力" name="tags" value="{{ $post->tag1 . ' ' . $post->tag2 . ' ' . $post->tag3 }}">
    @if ($errors->first('body'))
        <div class="validation">{{ $errors->first('body') }}</div>
    @endif
    <div class="row">
        <div class="col-6 m-1">
            <textarea name="body" id="markdown_editor_textarea" cols="30" rows="10" class="form-control">{{ $post->body }}</textarea>
        </div>
        <div class="col-6 m-1">
            <div id="markdown_preview"></div>
        </div>
    </div>
    <div class="post-page-footer">
        <input type="submit" class="post-button m-1" value="編集する">
    </div>
</form>
@endsection

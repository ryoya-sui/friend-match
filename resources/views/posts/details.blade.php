@extends('layouts.layout')
@section('content')
<div class="item-page-wrapper">
    <div class="item-wrapper">
        <div class="item-header">
            <div class="date">{{ $post->created_at }}</div>
            @if (Auth::id() == $post->user_id)
            <button type="button" class="btn btn-success" onclick="location.href='{{ route('post.edit', ['id' => $post->id]) }}'">編集する</button>
            <form action="{{ route('post.delete') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $post->id }}" name="id">
            <input type="submit" value="削除する" class="btn btn-danger" onclick="return confirm('投稿を削除しますか？')">
            </form>
            @endif
        </div>
        <div class="item-title">{{ $post->title }}</div>
        <div class="item-tags">
            <div class="item-tag">{{ $post->tag1 }}</div>
            @if ($post->tag2)
            <div class="item-tag">{{ $post->tag2 }}</div>
            @endif

            @if ($post->tag3)
            <div class="item-tag">{{ $post->tag3 }}</div>
            @endif
        </div>
        <div class="item-body">{{ $post->body }}</div>
    </div>
</div>
@endsection


@extends('layouts.viewPostTemplate')

@section('title', 'View Post #'. $id)

@section('content')
    <span class="fb-comments-count" data-href=""{{ Request::url() }}"></span>

    <div class="row">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
    </div>

    <div class="row">
        <a href="http://localhost/blog/public/" class="btn btn-default pull-right">Go back to Home</a>
    </div>

    <div class="row text-center" id="facebookCommentContainer">
        <div class="fb-comments" data-href="http://localhost/blog/public/posts/{{ $id }}" data-width="100%" data-numposts="10"></div>
    </div>


@endsection
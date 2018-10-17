@extends('layouts.publicHomePageTemplate')

@section('title', 'Blog Public Home Page')

@section('content')

    <div>
        <h2>Top 10 Most Recent Blogs</h2>

        @foreach($posts as $post)
            <div class="well well-lg">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->body }}</p>
                <a href="{{ route('posts.show', ['id'=>$post->id]) }}" class="btn btn-default pull-right">View Post</a>
                &nbsp;
            </div>
        @endforeach

        <div class="row text-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection

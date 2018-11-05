@extends('layouts.publicHomePageTemplate')

@section('title', 'Blog Public Home Page')

@section('content')

    <div>
        <h2>{{ $organization }}</h2>

        @foreach($posts as $post)
            @if($post->status !== 0)
            <div class="well well-lg">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->body }}</p>
                <br>
                <br>
                <p>Visit count: {{ $post->visit_count }}</p>
                <p>Comment count: {{ $post->comment_count }}</p>
                <p>Category: {{ $post->category->name }}</p>
                <p>Post created at: {{ date('d F Y', strtotime($post->created_at)) }} at {{ date('G:i', strtotime($post->created_at)) }}</p>
                <a href="{{ route('posts.show', ['id'=>$post->id]) }}" class="btn btn-default pull-right">View post</a>
                &nbsp;
            </div>
            @endif
        @endforeach

        <div class="row text-center">
            {{ $posts->links() }}

        </div>
    </div>
@endsection

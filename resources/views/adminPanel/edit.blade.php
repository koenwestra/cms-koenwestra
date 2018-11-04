@extends('layouts.template')

@section ('title', 'Edit Post #' . $post->id)

@section('content')
    <h1>Edit Post #{{ $post->id }}</h1>
    <div class="col-sm-8 col-sm-offset-2">
        {{  csrf_field() }}
    {!! Form::open(['action' => ['PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
        <a href="{{ route('posts.index') }}" class="btn btn-default pull-right">Go Back</a>
    </div>
@endsection

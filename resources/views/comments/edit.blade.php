@extends('layouts.template')

@section ('title', 'Edit Comment #' . $comment->id)

@section('content')
    <h1>Edit Post #{{ $comment->id }}</h1>
    <div class="col-sm-8 col-sm-offset-2">
        {{  csrf_field() }}
        {!! Form::open(['action' => ['CommentsController@update', $comment->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $comment->name, ['class' => 'form-control', 'disabled' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('email', 'Email')}}
            {{Form::text('email', $comment->email, ['class' => 'form-control', 'disabled' => 'Email'])}}
        </div>
        <div class="form-group">
            {{Form::label('comment', 'Comment')}}
            {{Form::textarea('comment', $comment->comment, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Comment'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        <a href="{{ route('comments.index') }}" class="btn btn-default pull-right">Go Back</a>
    </div>
@endsection

@extends('layouts.template')

@section ('title', 'Delete Comment #' . $comment->id)

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Delete this comment?</h1>
            <p>
                <strong>Name:</strong> {{ $comment->name }}<br>
                <strong>Email:</strong> {{ $comment->email }}<br>
                <strong>Comment:</strong> {{ $comment->comment }}
            </p>

            {{ Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) }}
            {{ Form::submit('Yes delete this comment', ['class' => 'btn btn-lg btn-block btn-danger']) }}
            {{ Form::close() }}
        </div>
    </div>

@endsection
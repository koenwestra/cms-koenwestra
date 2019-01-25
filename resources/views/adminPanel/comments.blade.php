@extends('layouts.app')

@section('title', 'KoenWestra Admin | Posts')

@section('content')

    <div class="container">
        <a href="/" class="btn btn-outline-primary pull-left">Go back to Home</a>
        <a style="float:right;" class="btn btn-outline-primary" href="{{ route('posts.index') }}">{{ __('Manage Blog Posts') }}</a>
        <a style="float:right; margin-right: 5px;" class="btn btn-outline-primary" href="{{ route('categories.index') }}">{{ __('Manage Categories') }}</a>
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">User Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @component('components.who')
                        @endcomponent

                    </div>
                    <div class="card-header">Comments</div>


                        <tbody>
                        @foreach($posts as $post)
                        <div id="backend-comments" style="margin-top: 10px;">
                            <h5 style="margin-left: 10px;">{{ $post->title }} <small>Comments: {{ $post->comments()->count () }} </small></h5>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Comment</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                <tbody>
                                    @foreach ($post->comments as $comment)
                                        <tr>
                                            <td>{{ $comment->name }}</td>
                                            <td>{{ $comment->email }}</td>
                                            <td>{{ $comment->comment }}</td>
                                            <td>
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-info">Edit</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </thead>
                            </table>
                        </div>
                        @endforeach
                        </tbody>



                </div>




            </div>
        </div>
    </div>
    </div>


@endsection





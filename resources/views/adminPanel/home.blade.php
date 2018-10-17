@extends('layouts.template')

@section('title', 'Blog Admin Panel')

@section('content')
    <h1>Admin Panel</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-primary pull-right">Add New Blog Post</a>

    <br><br><br>

    <table class="table">
        <thead>
            <th>id</th>
            <th>title</th>
            <th>body</th>
            <th>edit</th>
            <th>delete</th>
        </thead>

        <tbody>
        @foreach($posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>edit button</td>
                <td>delete button</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection



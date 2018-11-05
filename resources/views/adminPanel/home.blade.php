@extends('layouts.app')

@section('title', 'Blog Admin Panel')

@section('content')

    <div class="container">
        <a href="/" class="btn btn-outline-primary pull-left">Go back to Home</a>
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
                            <div class="card-header">Posts</div>
                    <br>
                    <div class="col-md-12"><a href="{{ route('posts.create') }}" class="btn btn-primary pull-right">Add New Blog Post</a></div>
                    <br>

                            <table class="table">
                                <thead>
                                <th>id</th>
                                <th>title</th>
                                <th>body</th>
                                <th>Aan/Uit</th>
                                <th>edit</th>
                                <th>delete</th>
                                </thead>

                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <th>{{ $post->id }}</th>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->body }}</td>
                                        <td>
                                            <form action="{{ route('posts.hidePost') }}" method="post">
                                                <label class="switch">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="id" value="{{$post->id}}">
                                                    <input type="checkbox" name="hide" <?php if($post->status == 1){ ?> checked <?php } ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                                <button class="" type="submit">Save</button>
                                            </form>
                                        </td>
                                        <td><a href="{{ route('posts.edit', ['id'=>$post->id]) }}" class="btn btn-info">Edit</a></td>
                                        <td>
                                            <form action="{{ route('posts.destroy', ['id'=>$post->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="DELETE">

                                                <input class="btn btn-danger" type="submit" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                    </div>




                </div>
            </div>
        </div>
    </div>


@endsection





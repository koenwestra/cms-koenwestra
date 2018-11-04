@extends('layouts.app')

@section('title', '| All Categories')

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
                    <div class="card-header">Categories</div>
                    <br>

                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <th>{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-3">
                            <div class="well">
                                {!! Form::open(['route' => 'categories.store', 'method' => 'post']) !!}
                                <h2>New Category</h2>
                                {{ Form::label('name', 'Name:') }}
                                {{ Form::text('name', null, ['class' => 'form-control']) }}
                                <br>
                                {{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block']) }}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>


                </div>




            </div>
        </div>
    </div>
    </div>

@endsection
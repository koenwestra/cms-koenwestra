<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    <div class="loginBox nav navbar-nav pull-right">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="{{ route('posts.index') }}">{{ __('Manage Blog Posts') }}</a>
                    <a class="dropdown-item" href="{{ route('categories.index') }}">{{ __('Manage Categories') }}</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </div>

    <div>
        <h1>Welcome to my blog</h1>
    </div>


    <!-- menu for post organization -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Sort Posts by <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('getPublic', ['type'=>'recentPosts']) }}">Top 10 Most recent posts</a></li>
                        <li><a href="{{ route('getPublic', ['type'=>'mostCommented']) }}">Top 10 Most Commented Posts</a></li>
                        <li><a href="{{ route('getPublic', ['type'=>'mostVisited']) }}">Top 10 Most Visited Posts</a></li>
                    </ul>
                </li>
            </ul>

            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('posts.index') }}">Manage Blog Posts</a></li>
                    <li><a href="{{ route('categories.index') }}">Manage Categories</a></li>
                </ul>
            @endif
        </div>
    </nav>


    <div>

        @yield('content')

        <div class="footer text-center" style="margin: 20px 0 60px 0;">
            <p>&copy; KoenWestra.nl</p>
        </div>

    </div>
</div>
</body>
</html>
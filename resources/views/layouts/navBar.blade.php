<!DOCTYPE html>
<html lang="en">
<head>
    <title>Personal Finances Assistant</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse" style="">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <ul class="nav navbar-nav">
                @auth
                    @if((Auth::user()->admin) === 1)
                        <li><a href="{{ route('users.list') }}"> List of Users </a></li>
                    @endif
                    <li><a href="{{route('about')}}">About</a></li>
                    <li><a href="{{route('profiles')}}">Profile of Users</a></li>
                    <li><a href="{{route('profile')}}">My Profile</a></li>
                @endauth
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                            @if(empty(Auth::user()->profile_photo))
                                <img src="{{url('img/avatars/default.png')}}" style="width:40px; height:40px; float:left;position:absolute; border-radius:50%; top:5px; left:200px; ">
                            @else
                                <img src="/storage/profiles/{{Auth::user()->profile_photo}}" style="width:40px; height:40px; float:left ;position:absolute; border-radius:50%; top:5px; right:200px;">
                            @endif
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a href="{{ route('users.edit',Auth::id()) }}">Edit Profile </a>
                            <br>
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
            </ul>
        </div>
    </nav>
        @yield('content')
</div>
</body>
</html>

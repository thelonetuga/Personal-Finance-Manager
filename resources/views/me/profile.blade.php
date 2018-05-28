@extends('layouts.navBar')

@section('title', 'Profile')

@section('content')
<!doctype html>
<html lang="{{ app()->getLocale() }}" xmlns:top="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Personal Finances Assistant</title>
    <!-- Fonts -->
    <!-- Custom Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <style>
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            font-size: 100px;
        }

        .content {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @if(empty(Auth::user()->profile_photo))
                <img src="{{url('img/avatars/default.png')}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:50px; alt:'';">
            @else
                <img src="/storage/profiles/{{Auth::user()->profile_photo}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:60px; alt:'';">
            @endif

            <h2>{{ Auth::user()->name }}'s Profile</h2>
            <label>Name: {{ Auth::user()->name }} </label><br>
            <label>Email: {{ Auth::user()->email }} </label><br>
            <label>Phone Number: {{ Auth::user()->phone }} </label>
        </div>
    </div>
</div>
<div class="flex-center ">
    <div class="content">
        <a class="btn  btn-primary btn-lg"   href="{{ route('accounts.users',auth()->user()->id) }}">List Accounts</a>
        <a class="btn  btn-primary btn-lg"   href="{{ route('users.accounts.opened',auth()->user()->id) }}">List Opened Accounts </a>
        <a class="btn  btn-primary btn-lg"   href="{{ route('users.accounts.closed',auth()->user()->id) }}">List Closed Accounts </a>
    </div>
</div>
</body>
@endsection
@extends('layouts.navBar')

@section('title', 'Welcome')

@section('content')
    <head>
        <style>
            html, body {
                background: #fefff9;
                color: #c8180c;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .top-left {
                position: absolute;
                left: 50px;
                top: 18px;
            }

            .content {
                text-align: center;
                position: absolute;
                top: 80px;

            }

            .title {
                font-size: 70px;
                color: #f92b1b;
            }

            .links > a {
                color: #040407;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .counters{
                color: #040407;
                padding: 0 25px;
                font-family: Ubuntu;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .row{
                color: #040407;
            }
        </style>
    </head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <p><b>Personal Finances Assistant</b></p>
            </div>
        </div>
        <form>
            <div class="row">
                <div class="counters "style="text-align: center">
                    <h2>Important Information</h2>
                    <div class="row">
                        <div class="counters">
                                <a  class="btn btn-primary">
                                    <div class="card" style="width: 30rem;">
                                        <i style="font-size:54px" class="fa">&#xf0c0;</i>
                                        <div class="card-body">
                                            <h5 class="card-title">Total of registered users:</h5>
                                            <p class="card-text">{{ $usersCount }}</p>
                                        </div>
                                    </div>
                                </a>
                            <a  class="btn btn-primary">
                                <div class="card" style="width: 30rem;">
                                    <i style="font-size:54px" class="material-icons">&#xe851;</i>
                                    <div class="card-body">
                                        <h5 class="card-title">Total number of accounts: </h5>
                                        <p class="card-text">{{  $accountsCount }}</p>
                                    </div>
                                </div>
                            </a>
                            <a  class="btn btn-primary">
                                <div class="card" style="width: 30rem;">
                                    <i style="font-size:54px" class="fa">&#xf19c;</i>
                                    <div class="card-body">
                                        <h5 class="card-title">Movements registered: </h5>
                                        <p class="card-text">{{   $movementsCount }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
@endsection
@extends('layouts.app')

@section('content')
    <style>
        .btn-group.bootstrap-select {
            margin: 0 !important;
        }

        body {
            background-color: #eaeaea !important;
        }

        .main-raised {
            box-shadow: none !important;
        }

        .center {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }

        /*mobile*/
        @media (max-width: 768px) {
            .page-header-compact {
                height: 660px;
            }

            .btn-group.bootstrap-select {
                margin: 10px 1px !important;
            }
        }
    </style>

    <div class=" text-center" style="margin-top: 100px; height: 80vh">
        <div class="center">
            @if($exception->getMessage() != 'player-not-found')
                <h1>404</h1>
                <h3>error</h3>
                <p>{{$exception->getMessage()}}</p>
            @else
                <h1>Player Not Found</h1>
                <h3>WE FOUND NO PLAYERS BY THAT NAME. PLEASE CHECK TO MAKE SURE YOU’VE ENTERED THE ACCOUNT NAME
                    PRECISELY.</h3>
                <p>Player names can include special characters; if you don't see what you're looking for, please check
                    to make sure you've entered the account name precisely.</p>
            @endif
            <img src="/img/sombra.png" style="height: 50vh;    margin-left: 54px;"/>
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('content')
    <style>
        html,
        body {
            background: linear-gradient(rgb(0, 0, 0) 0%, rgba(0, 0, 0, 0.69) 34%, rgba(0, 0, 0, 0.3)), url(/img/blizzard-entertainment-game-overwatch-d-va-hanna-son-khann-3.jpg);
            background-size: cover;
            height: 100vh;
        }

        .btn-group.bootstrap-select {
            margin: 0 !important;
        }

        body {
            background-color: #eaeaea !important;
        }

        .main-raised {
            box-shadow: none !important;
        }

        .footer {
            left: 0;
            right: 0;
            text-align: center;
            color: #ffffff;
            position: absolute;
            bottom: 0;
            width: auto;
        }

        .page-header {
            height: 100%;
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
    <div class="page-header "
         style="">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (Auth::guest())
                        <h1>Overwatch Team Finder</h1>
                    @else
                        <h1>Welcome {{ Auth::user()->battleTag }}</h1>
                    @endif
                    <h4>Find the perfect team to help your way through competitive Overwatch(PC).</h4>

                    <br/>
                    @if (Auth::guest())
                        <h4>Click join to begin!</h4>
                        <a href="{{ route('battleNetLogin') }}" class="btn btn-primary btn-lg btn-round">Join</a>
                    @else

                        <a href="{{ route('topplayers') }}" class="btn btn-primary btn-lg btn-round">View Top
                            Players</a>
                    @endif
                </div>

            </div>
        </div>
    </div>


@endsection

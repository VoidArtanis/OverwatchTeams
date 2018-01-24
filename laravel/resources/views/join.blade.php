@extends('layouts.app')

@section('content')
    <style>
        .btn-group.bootstrap-select {
            margin: 0 !important;
        }
        html,
        body {
            background: linear-gradient(rgb(0, 0, 0) 0%, rgba(0, 0, 0, 0.69) 34%, rgba(0, 0, 0, 0.3)), url(/img/join_back.jpg);
            background-size: cover;
            height: 100vh;
        }
        body {
            background-color: #eaeaea !important;
        }

        .main-raised {
            box-shadow: none !important;
        }

        .page-header {
            height: 100%;
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

        /*mobile*/
        @media (max-width: 991px){
            .page-header-compact {
                height: 660px;
            }

            .btn-group.bootstrap-select {
                margin: 10px 1px !important;
            }s
        }
    </style>
    <div class="page-header  page-header"   >
        <div class="container"  >
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1  >Join Using Battle.Net</h1>
                    <h4 >No registration required, just authenticate this app from battle.net <br/>
                        and we will create your profile automatically!</h4>
                    <br/>
                    <a class="btn btn-primary btn-lg btn-round" href="{{ route('battleNetLogin') }}">Login Using Battle.Net</a>
                </div>

            </div>
        </div>
    </div>


@endsection

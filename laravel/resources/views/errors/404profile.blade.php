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

        .center{
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
    <h1>Profile Not Found!</h1>
    <h3>looks like you entered the wrong battle tag.</h3>
    <p>{{$exception->getMessage()}}</p>
    <img src="/img/sombra.png" style="height: 50vh;    margin-left: 54px;"/>
</div>
    </div>

@endsection

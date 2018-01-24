@extends('layouts.app')

@section('content')
    <style>
        body{
            background: linear-gradient( rgba(144, 144, 144, 0), rgba(0, 0, 0, 0.86) ),url(/img/regfillcover.jpg);
            background-size: 100vw 100vh;
        }
        .btn-group.bootstrap-select {
            margin: 0 !important;
        }
        .footer{
            color: #9a9a9a;
        }
        .page-header-search {
            background-position: center center;
            background-size: cover;
            margin: 0;
            padding: 0;
            border: 0;
            height: 334px;
        }

        .page-header-search {
            height: 300px;

        }

        /*mobile*/
        @media (max-width: 768px) {
            .page-header-search {
                height: 334px;
                text-align: center;
            }

            .btn-group.bootstrap-select {
                margin: 10px 1px !important;
            }
        }

        .check {
            border: 1px solid rgba(251, 251, 251, 0.54) !important;

        }

        .main-raised {

            min-height: 60vh;
        }

        .info {
            max-width: 360px;
            margin: 0 auto;
            padding: 4px 0 30px !important;
        }

        .form-group label.control-label {
            font-size: 14px;
            line-height: 1.07143;
            color: #4e4e4e;
            font-weight: 500;
            margin: 16px -10px 0 -10px;
        }

        .form-group {
            padding-bottom: 7px;
            margin: 6px 0 0 0;
        }

        [class^="icon-flag-"], [class*=" icon-flag-"] {
            display: inline-block !important;
        }

        .bfh-selectbox-filter {
            padding: 9px;
            margin: 0;
            margin-top: -10px;
            border: 1px solid #d6d6d6 !important;
        }

        .form-title {
            font-weight: 500;
            margin-left: -13px;
        }

        .center {

            position: relative;
            top: 50%;
            transform: translateY(-50%);
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: flex;
            -webkit-justify-content: space-around;
            -moz-justify-content: space-around;
            -ms-justify-content: space-around;
            justify-content: space-around;
        }

        .middle-section {
            width: 60%;
        }

        .form-group label.control-label {
            font-size: 14px;
            line-height: 1.07143;
            color: #4e4e4e;
            font-weight: 500;
            margin: 16px -10px 0 11px;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>


    <div class="container " style="margin-top: 100px; height: 80vh">
        <div class="center col-sm-12">
            <div class="col-md-7 col-sm-12 col-xs-12 section" style="background: white;    padding: 17px;">
                <div class=" col-xs-12">
                    <div class="  ">
                        <h2 class="col-xs-12">Hi there!</h2>
                        <h5 class="col-xs-12 text-left">Please specify your country so we can generate a country based
                            local rank for you. </h5>


                    </div>

                    <form method="post" action="{{route('regfillpost')}}">
                        {{ csrf_field() }}
                        <div class="  col-xs-12">
                            <div class="form-group is-empty " style="">
                                <label class="control-label ">Your Country</label>
                                <div class="bfh-selectbox bfh-countries" data-country="US" data-flags="true"
                                     data-blank="false"
                                     data-name="country" data-filter="true"></div>
                                <span class="material-input"></span>
                            </div>
                        </div>

                        <div class="  col-xs-12">
                        <strong  >If you do not wish to specify your country you may skip this part, but
                            you will not be able to see the local ranks of other players. </strong>
                            <hr/>
                        </div>
                        <div class="  col-xs-12">
                            <input class="fl btn btn-primary" type="submit"> </input>
                            <a class="fl btn btn-warning" href="{{route('regfillskip')}}">Skip</a>
                        </div>
                    </form>
                </div>

            </div>

            {{--<img src="/img/sombra.png" style="height: 50vh;    margin-left: 54px;"/>--}}
        </div>
    </div>



@endsection
@section('pre-scripts')

@endsection
@extends('layouts.app')

@section('content')
    <style>
        .btn-group.bootstrap-select {
            margin: 0 !important;
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
        .center{
            position: relative;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>


    <div class=" text-center" style="margin-top: 100px; height: 80vh">
        <div class="center">
            <h1>Confirmation Email Sent</h1>
            <h3>Click the link in the confirmation email to complete the registration.</h3>

            {{--<img src="/img/sombra.png" style="height: 50vh;    margin-left: 54px;"/>--}}
        </div>
    </div>



@endsection
@section('pre-scripts')

@endsection
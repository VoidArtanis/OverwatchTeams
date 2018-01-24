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

        .bg-white {
            background-color: white;
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
        }

        ol {
            list-style-type: decimal;
        }

        .getstarted-title {
            margin-bottom: 20px;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>


    <div class="container   bg-white" style="margin-top: 100px; padding: 20px;">
        <div class="getstarted-title">
            <h1>Getting Started</h1>
            <h4>the following guide will help you find what you want</h4>
        </div>
        <div class="row is-flex" id="FindPlayers">
            <div class="col-md-8 ">
                <h3>Find Players For Competitive Overwatch</h3>
                <p><strong>OverwatchTeams</strong> is highly customized to help you find the perfect teammates. Here's
                    how you find a good teammate:</p>
                <ol>
                    <li>Firstly you must join this community by pressing the <strong>Join</strong> button from the menu.
                    </li>
                    <li>Click <strong>Find Team</strong>.</li>
                    <li>Set your <strong>region</strong> from the region drop down list. ie: US, EU, KR</li>
                    <li>Click the <strong>SR Compatible</strong> checkbox this will find players withing your SR
                        bracket.
                    </li>
                    <li>Click on a user to view their <strong>profile</strong>.</li>
                    <li>Like what you see? Add them up on <strong>BattleNet</strong> using the
                        <strong>BattleTag</strong></li>
                </ol>
                <div class="col-md-3 " style="margin-left: 10px">
                    <a class="btn btn-primary " href="{{ route('search') }}">Find Team</a>
                </div>

            </div>
            <div class="col-md-4 hidden-sm hidden-xs ">
                <img style="    width: 70%;"
                     src="/img/gm.png"/>
            </div>

        </div>
        <hr/>
        <div class="row is-flex" id="TopPlayers">
            <div class="col-md-8 ">
                <h3>View Top Players In Your Country</h3>
                <p>This is a cool feature which helps you find out where you stand in your country's rankings</p>
                <ol>
                    <li>To use this feature you must <strong>Join</strong>.
                    </li>
                    <li>Click <strong>Ranks -> Top Players</strong> from the menu.</li>
                    <li>Set your <strong>country</strong> from the country drop down list.</li>
                    <li>You can refine the results by using the other <strong>search filters</strong>
                    </li>

                </ol>
                <div class="col-md-3 " style="margin-left: 10px">
                    <a class="btn btn-primary " href="{{ route('topplayers') }}">Top Players</a>
                </div>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs ">
                <img style="    width: 69%;    margin-top: 14px;"
                     src="/img/n1.png"/>
            </div>

        </div>
        <hr/>
        <div class="row is-flex" id="RegisterTeam">
            <div class="col-md-8 ">
                <h3>Register Your Team</h3>
                <p>Register your Overwatch team to view your rankings and challenge other teams.</p>
                <ol>
                    <li>To use this feature you must <strong>Join</strong>, and you must be the leader of the team.
                    </li>
                    <li>Click <strong>Ranks -> Top Players</strong> from the menu.</li>
                    <li>Fill the form and submit.</li>
                    <li>Confirm the registration by clicking the <strong>verify</strong> email sent to the email you provided 
                    </li>
                    <li>Tell your teammates to <strong>accept</strong> the team request, it's there under your BattleTag -> Requests
                    </li>
                    <li>After all teammates accept the requests, your team will be active!
                    </li>
                </ol>
                <div class="col-md-3 " style="margin-left: 10px">
                    <a class="btn btn-primary " href="{{ route('teamreg') }}">Register Team</a>
                </div>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs ">
                <img style="width: 58%;margin-top: 14px;margin-left: 13px;"
                     src="/img/nullmari.png"/>
            </div>
        </div>
        <hr/>
        <div class="row is-flex">
            <div class="col-md-8 ">
                <h3>Challenge Other Teams</h3>
                <p>Invite other teams for friendly custom matches. </p>
                <strong>This feature is still under development!</strong>
            </div>
            <div class="col-md-4 hidden-sm hidden-xs ">
                <img style="    width: 66%;margin-top: 14px;margin-left: -22px;"
                     src="/img/mercymedic.png"/>
            </div>
        </div>
    </div>



@endsection
@section('post-scripts')
    <script>
        if(window.location.hash){
            $('html, body').animate({
                scrollTop: $(window.location.hash).offset().top
            }, 2000);
        }

    </script>

@endsection
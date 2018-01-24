@extends('layouts.app')

@section('content')
    <style>
        .btn-group.bootstrap-select {
            margin: 0 !important;
        }

        /*mobile*/
        @media (max-width: 768px) {
            .page-header-compact {
                height: 360px;
            }

            .btn-group.bootstrap-select {
                margin: 10px 1px !important;
            }
        }

        .check {
            border: 1px solid rgba(251, 251, 251, 0.54) !important;

        }

        label {
            color: #e8e8e8 !important;
        }

        .btn-accept {
            margin-top: 20px;
        }

        .main-raised {
            padding-bottom: 40px;
            min-height: 70vh;
        }

        .user {

        }

        .teamName-search{
            text-transform: capitalize;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>

    <div class="main main-raised" style="padding-top: 130px">
        <div class="container " id="app">
            @if(count($teamRequests) > 0)
                <div class="row">
                    <h2>Pending Team Requests</h2>
                    <hr/>
                    <h5>You have been invited by the following teams. Accept the requests to join the teams!</h5>
                    @foreach($teamRequests as $result)
                        {{--Result Item Start--}}
                        <div class="row" style="color: black!important;" id="a{{$result->teamInfo['_id']}}">
                            <a href="{{ route('team') }}?id={{$result->teamInfo['_id']}}">
                                <div ripple class="result" style="padding: 10px;">
                                    <div class="row row-keep-margins  ">

                                        <h1 class="h2 teamName-search fl ">Team: {{ $result->teamInfo['name'] }}<p> </p></h1>
                                        <div class="competitive-rank text-center rl">

                                        </div>
                                        <div class=" rl ">
                                            <a class="btn btn-accept btn-danger"
                                               onclick="accept('{{$result->teamInfo['_id']}}','{{ route('team-reject-user') }}?id={{ $result->teamInfo['_id'] }}')">Decline</a>
                                        </div>
                                        <div class=" rl ">
                                            <a class="btn btn-accept btn-success"
                                               onclick="accept('{{$result->teamInfo['_id']}}','{{ route('team-acpt-user') }}?id={{ $result->teamInfo['_id'] }}')">Accept</a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{--Result Item End--}}
                    @endforeach
                </div>
            @endif
                @if(count($scrimRequests) > 0)
                    <div class="row">
                        <h2>Pending Scrim Invitations</h2>
                        <hr/>
                        <h5>You have been invited for the following scrims, view and accept to make them active. GL HF!</h5>
                        @foreach($scrimRequests as $result)
                            {{--Result Item Start--}}
                            <div class="row" style="color: black!important;" id="as{{$result['_id']}}">
                                <a href="{{ route('team') }}?id={{$result['_id']}}">
                                    <div ripple class="result" style="padding: 10px;">
                                        <div class="row row-keep-margins  ">

                                            <h1 class="h2 teamName-search fl ">{{ $result->senderTeamInfo['name'] }} vs {{ $result->targetTeamInfo['name'] }}<p> </p></h1>
                                            <div class="competitive-rank text-center rl">

                                            </div>

                                            <div class=" rl ">
                                                <a class="btn btn-accept btn-success"
                                                   href="{{ route('teamscrim') }}?id={{ $result['_id'] }}">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            {{--Result Item End--}}
                        @endforeach
                    </div>
                @endif
                @unless (count($teamRequests) || count($scrimRequests))
                    <h2>Pending Team Requests</h2>
                    <p>No requests yet, come back later!</p>
                @endunless
        </div>
    </div>



@endsection
@section('scripts')
    <script>
        function accept(sender, url) {
            $.get(url, function (data, status) {
                if (status == 'success') $('#a' + sender).hide();
            });
        }
    </script>
@endsection
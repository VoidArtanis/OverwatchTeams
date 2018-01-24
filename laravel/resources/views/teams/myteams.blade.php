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

        .avatar-list {
            margin-top: 7px;
            margin-left: 15px;
        }

        .rank-portrait-search {
            height: 59px;
            margin-top: 5px;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>

    <div class="main main-raised" style="padding-top: 130px">
        <div class="container " id="app">
            <div class="row">
                <h2>My Teams</h2>
                @if(count($data)>0)
                    <h5>Click on the teams to view more information.</h5>
                @endif
                @unless (count($data))
                    <p>You have not joined a team yet.<br/> <a href="{{route('teamreg')}}">Register your team now!</a>
                        New teams will not be active till all the team members accept their invites. Tell your team mates to join and accept!
                    </p>
                @endunless
            </div>

            <div class=" ">
                @foreach($data as $result)
                    {{--Result Item Start--}}
                    <div class="row" style="color: black!important;" id="a{{$result->teamInfo['_id']}}">
                        <a href="{{ route('team') }}?id={{$result->teamInfo['_id']}}">
                            <div ripple class="result" style="padding: 10px;">
                                <div class="row row-keep-margins  ">

                                    <h1 class="h2 teamName-search fl ">Team: {{ $result->teamInfo['name'] }}<p></p></h1>


                                    <div class="competitive-rank text-center rl" style="margin-top: 5px">
                                        <img class="rank-portrait-search "
                                             src="{{ $rank_images[$result->teamInfo['tier']] }}">
                                        <p class="  ">{{ $result->teamInfo['sr'] }}</p>
                                    </div>

                                </div>
                                <div class="row hidden-sm avatar-list">
                                    <div class="row teammember">
                                        <img src="{{ $result->teamInfo['leaderInfo']['us']['stats']['competitive']['overall_stats']['avatar'] }}"  onerror="this.src='/img/default.png'"
                                             style="float:left" class="small-avatar fl leader-potrait">
                                        <h5 class="small-member-name fl"> {{$result->teamInfo['leaderInfo']['battleTag']}}</h5>
                                        <div class="rl" style="margin-top: 5px">
                                            <p class="  small-member-sr">{{ $result->teamInfo['leaderInfo']['us']['stats']['competitive']['overall_stats']['comprank']  }}
                                                SR</p>
                                        </div>
                                    </div>
                                    <div class="row teammember">
                                        <img src="{{ $result->teamInfo['member2Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"  onerror="this.src='/img/default.png'"
                                             style="float:left" class="small-avatar avatar-list-item fl">
                                        <h5 class="small-member-name fl"> {{$result->teamInfo['member2Info']['battleTag']}}</h5>
                                        <div class="rl" style="margin-top: 5px">
                                            <p class="small-member-sr">{{ $result->teamInfo['member2Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                SR</p>
                                        </div>
                                    </div>
                                    <div class="row teammember">
                                        <img src="{{ $result->teamInfo['member3Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"  onerror="this.src='/img/default.png'"
                                             style="float:left" class="small-avatar avatar-list-item fl">
                                        <h5 class="small-member-name fl"> {{$result->teamInfo['member3Info']['battleTag']}}</h5>
                                        <div class="rl" style="margin-top: 5px">
                                            <p class="small-member-sr">{{ $result->teamInfo['member3Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                SR</p>
                                        </div>
                                    </div>
                                    <div class="row teammember">
                                        <img src="{{ $result->teamInfo['member4Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"  onerror="this.src='/img/default.png'"
                                             style="float:left" class="small-avatar avatar-list-item fl">
                                        <h5 class="small-member-name fl"> {{$result->teamInfo['member4Info']['battleTag']}}</h5>
                                        <div class="rl" style="margin-top: 5px">
                                            <p class="small-member-sr">{{ $result->teamInfo['member4Info']['us']['stats']['competitive']['overall_stats']['comprank'] }}
                                                SR</p>
                                        </div>
                                    </div>
                                    <div class="row teammember">
                                        <img src="{{ $result->teamInfo['member5Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"  onerror="this.src='/img/default.png'"
                                             style="float:left" class="small-avatar avatar-list-item fl">
                                        <h5 class="small-member-name fl"> {{$result->teamInfo['member5Info']['battleTag']}}</h5>
                                        <div class="rl" style="margin-top: 5px">
                                            <p class="small-member-sr">{{ $result->teamInfo['member5Info']['us']['stats']['competitive']['overall_stats']['comprank'] }}
                                                SR</p>
                                        </div>
                                    </div>
                                    <div class="row teammember">
                                        <img src="{{ $result->teamInfo['member6Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"  onerror="this.src='/img/default.png'"
                                             style="float:left" class="small-avatar avatar-list-item fl">
                                        <h5 class="small-member-name fl"> {{$result->teamInfo['member6Info']['battleTag']}}</h5>
                                        <div class="rl" style="margin-top: 5px">
                                            <p class="small-member-sr">{{ $result->teamInfo['member6Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                SR</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>
                    {{--Result Item End--}}
                @endforeach

            </div>
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
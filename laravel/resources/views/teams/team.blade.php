@extends('layouts.app')

@section('content')
    <style>
        .btn-group.bootstrap-select {
            margin: 0 !important;
        }

        .page-header-team {
            background-position: center center;
            background-size: cover;
            margin: 0;
            padding: 0;
            border: 0;
            min-height: 360px;
        }

        /*mobile*/
        @media (max-width: 768px) {
            .page-header-team {
                min-height: 434px;
                text-align: center;
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

        .main-raised {
            background: #313335;
            min-height: 60vh;
        }

        .teamSubheading {
            margin-top: 3px;
            margin-right: 30px;
        }

        .teamSubheading-mob {
            margin-top: 3px;

        }

        .teamCover {

            /* position: absolute; */
            position: relative;
            /* top: 42%; */
            transform: translateY(3%);
            height: 170px;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>
    <div class="   page-header-team txt-white"
         style="    background-color: #232323; height:420px; ">

        <div class="container" style="padding-top: 100px">
            <div class="row desktop-v">
                @if($team['sr'] > 0)
                    <div class="teamCover rl">
                        <img src="{{ $rank_images[$team['tier']] }}" style="    height: 130px;"
                             class="row">
                        @if($team['sr'])
                            <h5 style="    margin-top: -5px;" class="text-center">{{$team['sr']}} SR</h5>
                        @endif
                    </div>
                @endif
                <div class="col-sm-5">
                    <div class="row">
                        <h1>{{ $team['name'] }}</h1>
                    </div>

                    <div class="row">
                        <h3 class="fl teamSubheading"><span class="bfh-countries fl"
                                                            data-country="{{ $team['country'] }}"
                                                            data-flags="true"></span>
                            <span class="toUpper"
                                  style="margin-left: 10px"> [{{$team['region']}}]</span>
                        </h3>
                    </div>
                    <div class="row">
                        <h5 class="fl teamSubheading">Local Rank: #{{ $countryRank }}</h5>
                        <h5 class="fl teamSubheading">World Rank: #{{ $teamRank }}</h5>
                    </div>


                </div>
                <br/>

                <div class="bg-default  col-md-12 toolbar">
                    @if($isLeader)
                        <a class="btn   btn-simple btn-just-icon rl txt-white"
                           href="{{ route('team-delete') .'?id='. $team['_id']}}"> <i class="fa fa-trash"></i></a>
                        <a class="btn   btn-simple btn-just-icon rl txt-white"
                           href="{{ route('team-edit') .'?id='. $team['_id']}}"> <i class="fa fa-pencil"></i></a>
                    @endif
                    <a class="btn   btn-warning    fl txt-white"
                       href="{{ route('scrimschedule') .'?id='. $team['_id']}}"> <i class="fa fa-bolt"></i> Invite for
                        Scrim</a>
                    <a class="btn   btn-primary    fl txt-white"
                       href="{{ route('team-edit') .'?id='. $team['_id']}}"> <i class="fa fa-comment"></i> Contact
                        Leader</a>
                </div>

            </div>
            <div class="row mobile-v">
                <div class="teamCover  " style="  height: 80px;">
                    <img src="{{ $rank_images[$team['tier']] }}" style="    height: 70px;"
                         class="row">
                    <h5 style="    margin-top: -5px;" class="text-center">{{$team['sr']}} SR</h5>
                </div>
                <div class="col-sm-12 text-center">
                    <div class="row">
                        <h1>{{ $team['name'] }}</h1>
                    </div>

                    <div class="row centered-container">

                        <h3 class=" text-center teamSubheading-mob"><span class="bfh-countries fl"
                                                                          data-country="{{ $team['country'] }}"
                                                                          data-flags="true"></span></h3>  <span
                                class="toUpper" style="margin-left: 10px">[{{$team['region']}}]</span>

                    </div>
                    <div class="row centered-container">
                        <h5 class=" col-xs-4 fl teamSubheading-mob" style="    text-align: right;">Local Rank:
                            #{{ $countryRank }}</h5>
                        <h5 class=" col-xs-4  rl teamSubheading-mob" style="    text-align: left;">World Rank:
                            #{{ $teamRank }}</h5>
                    </div>
                    @if($isLeader)
                        <div class="row">
                            <a class="btn btn-primary">Edit Team</a>
                        </div>
                    @endif
                    <br/>

                </div>

            </div>
        </div>
    </div>

    <div class="main main-raised" style="">
        <div class="container " id="app">
            <div class=" ">

                <br/>
                <h3 class="txt-white">Bio</h3>
                <h5 class="txt-white">
                    {{$team['bio']}}
                </h5>
                @if(!$team['active'])
                    <h4 class="txt-warning">This team is not active yet, all team members have not accepted their
                        request.</h4>
                @endif
                <br/> <br/>
                {{--Result Item Start--}}
                <teammember player="{{ json_encode($team['leaderInfo']) }}"
                            profileroot="{{ route('profile') . '?id=' . $team['leaderInfo']['_id']}}" counter="1"
                            rankedpotrait="{{ $rank_images[$team['leaderInfo'][$team['region']]['stats']['competitive']['overall_stats']['tier']] }}"></teammember>
                <teammember player="{{ json_encode($team['member2Info']) }}"
                            profileroot="{{route('profile')  . '?id=' . $team['member2Info']['_id']}}" counter="2"
                            rankedpotrait="{{ $rank_images[$team['member2Info'][$team['region']]['stats']['competitive']['overall_stats']['tier']] }}"></teammember>
                <teammember player="{{ json_encode($team['member3Info']) }}"
                            profileroot="{{route('profile') . '?id=' . $team['member3Info']['_id']}}" counter="3"
                            rankedpotrait="{{ $rank_images[$team['member3Info'][$team['region']]['stats']['competitive']['overall_stats']['tier']] }}"></teammember>
                <teammember player="{{ json_encode($team['member4Info']) }}"
                            profileroot="{{route('profile') . '?id=' . $team['member4Info']['_id']}}" counter="4"
                            rankedpotrait="{{ $rank_images[$team['member4Info'][$team['region']]['stats']['competitive']['overall_stats']['tier']] }}"></teammember>
                <teammember player="{{ json_encode($team['member5Info']) }}"
                            profileroot="{{route('profile') . '?id=' . $team['member5Info']['_id']}}" counter="5"
                            rankedpotrait="{{ $rank_images[$team['member5Info'][$team['region']]['stats']['competitive']['overall_stats']['tier']] }}"></teammember>
                <teammember player="{{ json_encode($team['member6Info']) }}"
                            profileroot="{{route('profile') . '?id=' . $team['member6Info']['_id']}}" counter="6"
                            rankedpotrait="{{ $rank_images[$team['member6Info'][$team['region']]['stats']['competitive']['overall_stats']['tier']] }}"></teammember>
                {{--Result Item End--}} <br/> <br/> <br/> <br/>
            </div>
        </div>
    </div>



@endsection
@section('pre-scripts')
    <script src="/laravel/public/js/app.js"></script>
@endsection
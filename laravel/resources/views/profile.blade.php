@extends('layouts.app')

@section('content')

    <link href="/css/profile.css" rel="stylesheet"/>


    <div class="main main-raised">
        <div class="header-compact"
             style="margin-top: 130px;background: url('https://d3hmvhl7ru3t12.cloudfront.net/img/pages/career/gibraltar-bg-194b7fee37eb4135f6e971c704f27b43a99e345585e5cc920025afff7683b9023397dfff19ae795c920375f32aa310c8daba5c9c31d43167006649c81e8562c6.jpg')">
            <div class="heroImage"
                 style="background-image: url(https://d1u1mce87gyfbn.cloudfront.net/hero/{{ $hero_keys[$main_hero] }}/career-portrait.png);height: 100%">

            </div>
            {{--Desktop View--}}
            <div class="header-content container desktop-v">
                <div class="col-md-12 player-banner">
                    <div class="row center-banner">
                        <img src="{{ $user[$cRegion]['stats']['quickplay']['overall_stats']['avatar'] }}"
                             style="float:left" class="player-portrait fl" onerror="this.src='img/default.png'">
                        <h1 class="h2 playerName fl txt-white">{{ $user->battleTag }}</h1>
                        @if($user[$cRegion]['stats']['competitive']['overall_stats']['comprank'])
                            <div class="competitive-rank text-center">
                                <img class="rank-portrait"
                                     src="{{ $rank_image }}">
                                <p class="txt-white competitive-sr">{{ $user[$cRegion]['stats']['competitive']['overall_stats']['comprank'] }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="row center-banner">
                        <div>
                            <h4 class="header-subtext fl txt-white">
                                Level {{ $user[$cRegion]['stats']['quickplay']['overall_stats']['prestige'] }}{{ ($user[$cRegion]['stats']['quickplay']['overall_stats']['level'] =='100')?'99':$user[$cRegion]['stats']['quickplay']['overall_stats']['level'] }}</h4>
                            <h4 class="header-subtext fl header-subtext-lmargin txt-white">{{ $user[$cRegion]['stats']['competitive']['overall_stats']['wins'] }}
                                wins</h4>
                            <div class="fl header-subtext-lmargin">
                                <form method="get" action="{{route('profile')}}">
                                    <input name="id" value="{{$user['_id']}}" type="hidden">
                                    <select class="selectpicker" data-style="btn btn-primary btn-round" name="region"
                                            title="Single Select" onchange="this.form.submit()"
                                            data-size="4">
                                        @foreach($regions as $region)
                                            <option value="{{$region}}" {{ ($region == $cRegion) ? 'selected' : '' }}>{{$region}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--@if(!$guest)--}}
                    {{--@if($accepted)--}}
                    {{--<div class="row center-banner">--}}
                    {{--<span class="label label-success battleTag-label">{{ $user['battleTag'] }}</span>--}}
                    {{--</div>--}}

                    {{--@else--}}
                    {{--@if($requestRecieved)--}}
                    {{--<div class="row center-banner">--}}
                    {{--<a class="btn btn-success"--}}
                    {{--href="{{ route('profile-acpt') }}?sender={{ $user['_id'] }}">Accept BattleTag--}}
                    {{--Request</a>--}}
                    {{--</div>--}}
                    {{--@else--}}
                    {{--<div class="row center-banner">--}}
                    {{--<a class="btn {{ $request_sent ? 'btn-info' : 'btn-primary'}}"--}}
                    {{--{{ $request_sent ? 'disabled' : ''}} href="{{ route('profile-req') }}?target={{ $user['_id'] }}">{{  $request_btn_text }}</a>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                    {{--@endif--}}
                    {{--@endif--}}
                </div>
            </div>
            {{--Mobile View--}}
            <div class="header-content container mobile-v">
                <div class="col-md-12 player-banner">
                    <div class=" center-banner">
                        <div>
                            <div class="row center-banner">
                                <img src="{{ $user[$cRegion]['stats']['quickplay']['overall_stats']['avatar'] }}"
                                     style="float:left" class="player-portrait ">
                            </div>
                            <div class="row center-banner">
                                <h1 class="h2 playerName txt-white ">{{ $user->battleTag }}</h1>
                            </div>
                            <div class="row center-banner">


                                <div class="competitive-rank text-center">
                                    <img class="rank-portrait"
                                         src="{{ $rank_image }}">
                                    <p class="txt-white competitive-sr">{{ $user[$cRegion]['stats']['competitive']['overall_stats']['comprank'] }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row center-banner">
                        <div class="">
                            <div class="row text-center">
                                <h4 class="header-subtext   txt-white">
                                    Level {{ $user[$cRegion]['stats']['quickplay']['overall_stats']['prestige'] }}{{ ($user[$cRegion]['stats']['quickplay']['overall_stats']['level'] =='100')?'99':$user[$cRegion]['stats']['quickplay']['overall_stats']['level'] }}</h4>
                                <h4 class="header-subtext    txt-white">{{ $user[$cRegion]['stats']['competitive']['overall_stats']['wins'] }}
                                    wins</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row center-banner">
                        <div class="">
                            <div class="competitive-rank text-center">
                                <form method="get" action="{{route('profile')}}">
                                    <input name="id" value="{{$user['_id']}}" type="hidden">
                                    <select class="selectpicker" data-style="btn btn-primary btn-round" name="region"
                                            title="Single Select" onchange="this.form.submit()"
                                            data-size="4">
                                        @foreach($regions as $region)
                                            <option value="{{$region}}" {{ ($region ==$cRegion) ? 'selected' : '' }}>{{$region}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--@if(!$guest)--}}
                    {{--@if($accepted)--}}
                    {{--<div class="row center-banner">--}}
                    {{--<span class="label label-success battleTag-label">{{ $user['battleTag'] }}</span>--}}
                    {{--</div>--}}

                    {{--@else--}}
                    {{--@if($requestRecieved)--}}
                    {{--<div class="row center-banner">--}}
                    {{--<a class="btn btn-success"--}}
                    {{--href="{{ route('profile-acpt') }}?sender={{ $user['_id'] }}">Accept BattleTag--}}
                    {{--Request</a>--}}
                    {{--</div>--}}
                    {{--@else--}}
                    {{--<div class="row center-banner">--}}
                    {{--<a class="btn {{ $request_sent ? 'btn-info' : 'btn-primary'}}"--}}
                    {{--{{ $request_sent ? 'disabled' : ''}} href="{{ route('profile-req') }}?target={{ $user['_id'] }}">{{  $request_btn_text }}</a>--}}
                    {{--</div>--}}
                    {{--@endif--}}
                    {{--@endif--}}
                    {{--@endif--}}
                </div>
            </div>

        </div>
        <div class="container " id="app">
            <div class="section">
                <div class="row text-center">
                    <ul class="nav nav-pills nav-pills-rose center-pills" style="">
                        @if (count($user[$cRegion . 'qpHeroes']) > 0)
                            <li class="active"><a href="#pill1" data-toggle="tab">QuickPlay</a></li>
                        @endif
                        @if (count($user[$cRegion .  'compHeroes']) > 0)
                            <li><a href="#pill2" data-toggle="tab">Competitive</a></li>
                        @endif

                    </ul>

                    <div class="tab-content tab-space text-left">
                        @if (count($user[$cRegion . 'qpHeroes']) > 0)
                            <div class="tab-pane active" id="pill1">
                                <div class="center-mobile">
                                    <h1>Top Heroes</h1>
                                </div>
                                <hr/>
                                <herocards sortedheroes="{{ json_encode($user[ $cRegion . 'qpHeroes']) }}"
                                           herodata="{{ json_encode($user[$cRegion]['heroes']['stats']['quickplay']) }}"
                                           heronames="{{ json_encode($hero_names) }}"
                                           heroavatars="{{ json_encode($hero_avatars) }}">

                                </herocards>
                                <br/>
                                <br/>
                                <br/>
                                <div class="center-mobile">
                                    <h1>General Stats</h1>
                                </div>
                                <hr/>
                                <playerstats
                                        stats="{{ json_encode($user[$cRegion]['stats']['quickplay']['game_stats']) }}"></playerstats>
                            </div>
                        @endif
                        @if (count($user[$cRegion . 'compHeroes']) > 0)
                            <div class="tab-pane" id="pill2">
                                <div class="center-mobile">
                                    <h1>Top Heroes</h1>
                                </div>
                                <hr/>
                                <herocards sortedheroes="{{ json_encode($user[$cRegion . 'compHeroes']) }}"
                                           herodata="{{ json_encode($user[$cRegion]['heroes']['stats']['competitive']) }}"
                                           heronames="{{ json_encode($hero_names) }}"
                                           heroavatars="{{ json_encode($hero_avatars) }}">

                                </herocards>
                                <br/>
                                <br/>
                                <br/>
                                <div class="center-mobile">
                                    <h1>General Stats</h1>
                                </div>
                                <hr/>
                                <playerstats
                                        stats="{{ json_encode($user[$cRegion]['stats']['competitive']['game_stats']) }}"></playerstats>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('pre-scripts')
    <script src="/laravel/public/js/app.js"></script>
@endsection
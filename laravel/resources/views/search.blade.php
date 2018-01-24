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

        /*mobile*/
        @media (max-width: 768px) {
            .page-header-search {
                height: 434px;
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
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>
    <div class="   page-header-search txt-white" style="    background-color: #232323;">
        <div class="container" style="padding-top: 100px">
            <div class="row">
                <div class="col-md-12">

                    <h3>Search Players By Heroes.</h3>
                    <br/>

                </div>
                <div class="col-md-12">
                    <div class="   card-form-horizontal">
                        <div class=" ">
                            <form method="get" action="{{route('search')}}">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <select class="selectpicker" data-style="btn btn-primary btn-round"
                                                onchange="this.form.submit()"
                                                data-size="7" name="hero">
                                            @foreach ($heroes as $key => $value)
                                                <option value="{{$key}}" {{ ($hero==$key) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <select class="selectpicker" data-style="btn btn-primary btn-round"
                                                data-size="7" name="sort" onchange="this.form.submit()">
                                            <option value="time-desc" {{ ($sortby=='time-desc') ? 'selected' : '' }}>
                                                Play
                                                Time High - Low
                                            </option>
                                            <option value="time-asc" {{ ($sortby=='time-asc') ? 'selected' : '' }}> Play
                                                Time Low - High
                                            </option>
                                            <option value="games-desc" {{ ($sortby=='games-desc') ? 'selected' : '' }}>
                                                Games Played High - Low
                                            </option>
                                            <option value="games-asc" {{ ($sortby=='games-asc') ? 'selected' : '' }}>
                                                Games Played Low - High
                                            </option>

                                            <option value="sr-desc" {{ ($sortby=='sr-desc') ? 'selected' : '' }}>SR
                                                High - Low
                                            </option>
                                            <option value="sr-asc" {{ ($sortby=='sr-asc') ? 'selected' : '' }}>SR Low
                                                - High
                                            </option>


                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <select class="selectpicker" data-style="btn btn-primary btn-round"
                                                name="region"
                                                title="Single Select" onchange="this.form.submit()"
                                                data-size="4">
                                            @foreach($regions as $region)
                                                <option value="{{$region}}" {{ ($region ==$cRegion) ? 'selected' : '' }}>{{$region}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(!Auth::guest())
                                        <div class="col-sm-3">
                                            <div class="checkbox ">
                                                <label>
                                                    <input class="txt-white" type="checkbox" name="sr-compat"
                                                           onchange="this.form.submit()" {{ ($srcompat) ? 'checked' : '' }}>
                                                    SR Compatible
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised" style="">
        <div class="container " id="app">
            <div class="section">
                @unless (count($users))
                    <h3 class="txt-white">No players found!</h3>
                @endunless
                @foreach($users as $result)
                    {{--Result Item Start--}}
                    <div class="row desktop-search">
                        <a href="{{ route('profile') }}?id={{$result['_id']}}">
                            <div ripple class="result">
                                <div class="row row-keep-margins  ">
                                    <img src="{{ $result[$cRegion]['stats']['competitive']['overall_stats']['avatar'] }}"
                                         style="float:left" class="player-portrait fl"
                                         onerror="this.src='img/default.png'">
                                    <h1 class="h2 playerName-search fl txt-white">{{ $result['battleTag'] }}</h1>

                                    <div class="competitive-rank text-center rl" style="min-width: 80px">
                                        @if($result[$cRegion]['stats']['competitive']['overall_stats']['comprank']=='n/a' || !$result[$cRegion]['stats']['competitive']['overall_stats']['comprank']   )
                                            <p class=" na-label  txt-white">unranked</p>
                                        @else
                                            <img class="rank-portrait-search"
                                                 src="{{ $rank_images[$result[$cRegion]['stats']['competitive']['overall_stats']['tier']] }}">
                                            <p class=" competitive-sr txt-white">{{ $result[$cRegion]['stats']['competitive']['overall_stats']['comprank'] }}</p>
                                        @endif
                                    </div>

                                    <div class=" rl ">
                                        <p class="search-meta left-divider">{{ (array_key_exists('win_percentage',$result[$cRegion]['heroes']['stats']['competitive'][$hero]['average_stats']))? $result[$cRegion]['heroes']['stats']['competitive'][$hero]['average_stats']['win_percentage'] * 100 : 0}}
                                            % Winrate </p>
                                    </div>
                                    @if($result[$cRegion]['heroes']['stats']['competitive'][$hero]['average_stats'])
                                        <div class=" rl ">
                                            <p class="search-meta ">{{ $result[$cRegion]['heroes']['stats']['competitive'][$hero]['average_stats']['games_played'] }}
                                                games played </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="row mobile-search">
                        <a href="{{ route('profile') }}?id={{$result['_id']}}">
                            <div ripple class="result">
                                <div class="row row-keep-margins  ">
                                    <div class="col-xs-8">
                                        <div class="row">
                                            <h1 class="h2 playerName-search   txt-white col-xs-12">{{ $result['battleTag'] }}</h1>
                                        </div>
                                        <div class="row">
                                            <p class="search-meta left-divider fl">{{ (array_key_exists('win_percentage',$result[$cRegion]['heroes']['stats']['competitive'][$hero]['average_stats']))? $result[$cRegion]['heroes']['stats']['competitive'][$hero]['average_stats']['win_percentage'] * 100 : 0}}
                                                % Wr </p>
                                            @if($result[$cRegion]['heroes']['stats']['competitive'][$hero]['average_stats'])
                                                <p class="search-meta fl">{{ $result[$cRegion]['heroes']['stats']['competitive'][$hero]['average_stats']['games_played'] }}
                                                    games </p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="competitive-rank text-center rl col-xs-4"
                                         style="margin-top: -2px;margin-bottom: 8px;min-width: 80px">
                                        @if($result[$cRegion]['stats']['competitive']['overall_stats']['comprank']=='n/a' || !$result[$cRegion]['stats']['competitive']['overall_stats']['comprank']   )
                                            <p class=" na-label  txt-white">unranked</p>
                                        @else
                                            <img class="rank-portrait-search"
                                                 src="{{ $rank_images[$result[$cRegion]['stats']['competitive']['overall_stats']['tier']] }}">
                                            <p class=" competitive-sr txt-white">{{ $result[$cRegion]['stats']['competitive']['overall_stats']['comprank'] }}</p>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </a>
                    </div>
                    {{--Result Item End--}}
                @endforeach
                <div class="col-md-12 text-center">
                    <?php echo $users->render(); ?>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('pre-scripts')

@endsection
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
                height: 530px;
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

        .bfh-selectbox > input, .bfh-selectbox > a {
            color: #fff;
        }

        .form-control:focus {
            /* border-color: #66afe9; */
            outline: 0;
            -webkit-box-shadow: inset 0 0px 0px rgba(0, 0, 0, .075), 0 0 0px rgba(102, 175, 233, .6) !important;
            box-shadow: inset 0 0px 0px rgba(0, 0, 0, .075), 0 0 0px rgba(102, 175, 233, .6) !important;;
        }

        .selectCountry {
            text-align: left;
            background-color: #1976d1;
            border-radius: 30px;
            /* padding: 0px 30px; */
            padding-left: 20px;
            height: 42px;
            padding-right: 20px;
            margin-top: -3px;
        }

        .bfh-selectbox .bfh-selectbox-toggle {
            display: inline-block;
            padding: 10px 24px 6px 12px;
            text-decoration: none;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>
    <div class="   page-header-search txt-white" style="    background-color: #232323;">
        <div class="container" style="padding-top: 100px">
            <div class="row">
                <div class="col-md-12">
                    <h3>Top Players By Their Main Heroes.</h3>
                    <br/>
                </div>
                <div class="col-md-12">
                    <div class="   card-form-horizontal">
                        <div class=" ">
                            <form method="get" action="{{route('topplayers')}}" id="frm">
                                <div class="row">

                                    <div class="col-sm-3">
                                        <select class="selectpicker" data-style="btn btn-primary btn-round"
                                                onchange="this.form.submit()"
                                                data-size="7" name="hero">
                                            <option value="all" {{ ($hero=='All') ? 'selected' : '' }}>All Heroes
                                            </option>

                                            @foreach ($heroes as $key => $value)
                                                <option value="{{$key}}" {{ ($hero==$key) ? 'selected' : '' }}>{{$value}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="selectpicker" data-style="btn btn-primary btn-round"
                                                onchange="this.form.submit()"
                                                data-size="7" name="tier">
                                            @foreach ($ranks as $key => $value)
                                                <option value="{{$value}}" {{ ($tier==$value) ? 'selected' : '' }}>{{$key}}</option>
                                            @endforeach
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
                                    @if(!Auth::guest() && Auth::user()['country'])
                                        <div class="col-sm-3">
                                            <div class="" style="">
                                                <div class="bfh-selectbox bfh-countries selectCountry " style=""
                                                     data-country="{{ $country }}" data-flags="true" data-addAll="true"
                                                     data-blank="false"
                                                     data-name="country" data-filter="true"></div>
                                                <span class="material-input"></span>
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
                                <div class="fl numbering">
                                    {{++$counter}}
                                </div>
                                <div class="row row-keep-margins  ">
                                    <img src="{{ $result[$cRegion]['stats']['quickplay']['overall_stats']['avatar'] }}"
                                         style="float:left" class="player-portrait fl"
                                         onerror="this.src='img/default.png'">
                                    <h1 class="h2 playerName-search fl txt-white">{{ $result['battleTag'] }}</h1>
                                    <div class="competitive-rank text-center rl" style="min-width: 80px;">
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

                    <div class="row mobile-search">
                        <a href="{{ route('profile') }}?id={{$result['_id']}}">
                            <div ripple class="result">
                                <div class="mobileNumbering">
                                    #{{$counter}}
                                </div>
                                <div class="row row-keep-margins  ">
                                    <div class="col-xs-8">
                                        <div class="row">
                                            <h1 class="h2 playerName-search   txt-white col-xs-12">{{ $result['battleTag'] }}</h1>
                                        </div>
                                    </div>
                                    <div class="competitive-rank text-center rl col-xs-4"
                                         style="min-width: 80px;margin-top: -2px;margin-bottom: 8px;">
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

@section('post-scripts')
    <script>
        $(document).ready(function () {

            $('.bfh-selectbox').on('hidden.bfhselectbox', function () {
                $('#frm').submit();
            });

            $('.bfh-selectbox-filter').attr('placeholder', 'Search')
        });


    </script>
@endsection
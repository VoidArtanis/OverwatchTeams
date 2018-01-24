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

        .teamName{
            font-size: 1.8em;
            margin: 12px 0 0 0px;
            text-transform: uppercase;
        }
        .teamCountry{
            margin: 12px 0 0 17px;
        }
        
        .bfh-selectbox>input,.bfh-selectbox>a{
            color: #fff;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>
    <div class="   page-header-search txt-white" style="    background-color: #232323;">
        <div class="container" style="padding-top: 100px">
            <div class="row">
                <div class="col-md-12">

                    <h3>Top Teams.</h3>
                    <h5>**Uncheck global to search country wise.</h5>


                </div>
                <div class="col-md-12">
                    <div class="   card-form-horizontal">
                        <div class=" ">
                            <form method="get" action="{{route('topTeams')}}" id="frm">
                                <div class="row">

                                    <div class="col-sm-2">
                                        <div class="checkbox" style="margin-top: 7px;">
                                            <label>
                                                <input type="checkbox" {{ $local ? '' : 'checked' }} name="global" id="global" onchange="toggleCountries()">
                                                Global Ranks
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-sm-3"  >
                                            <div class="bfh-selectbox bfh-countries txt-white" id="countryFilter"
                                                 data-country="{{$countryFilter}}" data-flags="true" data-blank="false" onchange="this.form.submit()"
                                                 data-name="country" data-filter="true"></div>
                                            <span class="material-input"></span>

                                    </div>

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
                @unless (count($data))
                    <h3 class="txt-white">No teams found!</h3>
                @endunless

                @foreach($data as $result)
                    {{--Result Item Start--}}
                    <div class="row desktop-search">
                        <a href="{{ route('team') }}?id={{$result['_id']}}">
                            <div ripple class="result">
                                <div class="fl numbering">
                                    {{++$counter}}
                                </div>
                                <div class="row row-keep-margins  ">

                                    <h1 class="h2 playerName-search fl txt-white">{{ $result['name'] }}</h1>
                                    <div class="competitive-rank text-center rl" style="min-width: 80px;">
                                        @if($result['sr']==-1 || !$result['sr']   )
                                            <p class=" na-label  txt-white" >unranked</p>
                                        @else
                                            <img class="rank-portrait-search"
                                                 src="{{ $rank_images[$result['tier']] }}">
                                            <p class=" competitive-sr txt-white">{{ $result['sr'] }}</p>
                                        @endif
                                    </div>
                                    <div class="competitive-rank text-center rl col-xs-3"
                                         style="text-align: right; border: 0">
                                        <h3 class="rl teamSubheading txt-white"><span class="bfh-countries fl"
                                                                                      data-country="{{ $result['country'] }}"
                                                                                      data-flags="true"></span></h3>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="row mobile-search">
                        <a href="{{ route('team') }}?id={{$result['_id']}}">
                            <div ripple class="result">
                                <div class="mobileNumbering">
                                    #{{$counter}}
                                </div>
                                <div class="row row-keep-margins  ">
                                    <div class="col-xs-8">
                                        <div class="row">
                                            <h4 class="  teamName   txt-white col-xs-12">{{ $result['name'] }}</h4>
                                            <h5 class="  teamCountry  " style="color: #7b7b7b ;"><span class="bfh-countries fl"
                                                                                data-country="{{ $result['country'] }}"
                                                                                data-flags="true"></span></h5>
                                        </div>
                                    </div>

                                    <div class="competitive-rank text-center rl col-xs-4" style="min-width: 80px;"
                                         style="margin-top: -2px;margin-bottom: 8px;">
                                        @if($result['sr']==-1 || !$result['sr']   )
                                            <p class=" na-label  txt-white" >n/a</p>
                                        @else
                                            <img class="rank-portrait-search"
                                                 src="{{ $rank_images[$result['tier']] }}">
                                            <p class=" competitive-sr txt-white">{{ $result['sr'] }}</p>
                                        @endif
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
@section('post-scripts')
    <script>
        $(document).ready(function(){

            $('.bfh-selectbox').on('change.bfhselectbox', function () {
               $('#frm').submit();
            });
            if($('#global').is(":checked")){
                $('.bfh-selectbox').hide()
            }else{
                $('.bfh-selectbox').show()
            }
            $('.bfh-selectbox-filter').attr('placeholder', 'Search')
        });

        function toggleCountries() {
            if($('#global').is(":checked")){
                $('#frm').submit();
            }else{
              $('.bfh-selectbox').show()
            }
        }
    </script>
@endsection
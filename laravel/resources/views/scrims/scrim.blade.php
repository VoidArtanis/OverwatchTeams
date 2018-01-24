@extends('layouts.app')

@section('content')
    <style>
        html,
        body {
            background: linear-gradient(rgb(0, 0, 0) 0%, rgba(0, 0, 0, 0.69) 34%, rgba(0, 0, 0, 0.3)), url(/img/hanamura.jpg);
            background-size: cover;
            height: 100vh;
        }

        .btn-group.bootstrap-select {
            margin: 0 !important;
        }

        body {
            background-color: #eaeaea !important;
        }

        .main-raised {
            box-shadow: none !important;
        }

        .footer {
            left: 0;
            right: 0;
            text-align: center;
            color: #ffffff;
            position: absolute;
            bottom: 0;
            width: auto;
        }

        .page-header {
            height: 100%;
        }

        /*mobile*/
        @media (max-width: 768px) {
            .page-header-compact {
                height: 660px;

            }

            .btn-group.bootstrap-select {
                margin: 10px 1px !important;
            }
        }

        .page-header .container {
            padding-top: 78px;
            color: #FFFFFF;
        }

        h4 span {
            margin-left: 6px;
            font-weight: 600;
        }

        .teammember {
            margin-left: 10px;
            border-bottom: 1px solid rgba(169, 169, 169, 0.16);
            padding-right: 2.5rem !important;
            padding-top: 10px;
            padding-left: 10px;

        }

        .teammember a {
            color: white;
        }

        .hoverglow {
            background: rgba(255, 255, 255, 0.0);
            transition-duration: .5s;
            -webkit-transition-timing-function: ease-out; /* Safari and Chrome */
            transition-timing-function: ease-out;
        }

        .hoverglow:hover {
            background: rgba(255, 255, 255, 0.31);
            transition-duration: .5s;
            -webkit-transition-timing-function: ease; /* Safari and Chrome */
            transition-timing-function: ease;
        }

        #chatdiv {
            background-color: rgba(0, 0, 0, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .chatBox {
            margin-left: -20px;
            padding-top: 10px;
        }

        .flexContainer {
            padding-left: 100px;
            padding-right: 100px;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>

    <div class=""
         style="padding-top: 80px;color: #fff;">
        <div class="flexContainer">
            <div class="row ">
                <div class="{{$data['status']=='pending' ? 'col-md-12 ': 'col-md-8 ' }} text-left ">

                    <h2>{{$data->senderTeamInfo['name']}} - {{$data->targetTeamInfo['name']}}</h2>
                    @if($data['status']=='pending')
                        <div class="rl hidden-xs hidden-sm" style="margin-top: -30px">
                            <p class="   ">This scrim won't be active until you accept it! </p>
                            <p class="weight500  rl"><span><a class="btn btn-success  "
                                                              href="{{route('scrimaccept')}}?id={{$data['_id']}}">Accept Scrim</a></span>
                            </p>
                        </div>

                    @endif
                    <h4>Starts @ <span>{{$data['date']}}</span> <span>{{$data['time']}}</span></h4>


                    @if($data['matches']=='bo1')
                        <h5 class="weight500 toUpper">One Match</h5>
                    @elseif($data['matches']=='bo3')
                        <h5 class="weight500 toUpper">Best of 3</h5>
                    @elseif($data['matches']=='bo5')
                        <h5 class="weight500 toUpper">Best of 5</h5>
                    @endif


                    @if($data['status']=='pending')
                        <div class="  hidden-md hidden-lg">
                            <p class="   ">This scrim won't be active until you accept it! </p>
                            <p class="weight500   "><span><a href="{{route('scrimaccept')}}?id={{$data['_id']}}"
                                                             class="btn btn-success  ">Accept Scrim</a></span></p>
                        </div>

                    @endif

                    <div class="hidden-xs hidden-sm">
                        <div class="col-xs-5 teamColumn ">
                            <div class="vertical-center">
                                <div class="result">
                                    <div class="row row-keep-margins  ">
                                        <h3 class="   rl "> {{ $data->senderTeamInfo['name'] }}<p></p></h3>
                                    </div>
                                    <div class="row hidden-sm avatar-list">
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->senderTeamInfo['leaderInfo']['_id']}}">
                                                <img src="{{ $data->senderTeamInfo['leaderInfo']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:right" class="small-avatar-right rl leader-potrait">
                                                <h5 class="small-member-name rl"> {{$data->senderTeamInfo['leaderInfo']['safeBattleTag']}}</h5>
                                                <div class="fl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="  small-member-sr">{{ $data->senderTeamInfo['leaderInfo']['us']['stats']['competitive']['overall_stats']['comprank']  }}
                                                        SR</p>

                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->senderTeamInfo['member2Info']['_id']}}">
                                                <img src="{{ $data->senderTeamInfo['member2Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:right" class="small-avatar-right avatar-list-item fl">
                                                <h5 class="small-member-name rl"> {{$data->senderTeamInfo['member2Info']['safeBattleTag']}}</h5>
                                                <div class="fl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->senderTeamInfo['member2Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->senderTeamInfo['member3Info']['_id']}}">
                                                <img src="{{ $data->senderTeamInfo['member3Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:right" class="small-avatar-right avatar-list-item fl">
                                                <h5 class="small-member-name rl"> {{$data->senderTeamInfo['member3Info']['safeBattleTag']}}</h5>
                                                <div class="fl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->senderTeamInfo['member3Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->senderTeamInfo['member4Info']['_id']}}">
                                                <img src="{{ $data->senderTeamInfo['member4Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:right" class="small-avatar-right avatar-list-item fl">
                                                <h5 class="small-member-name rl"> {{$data->senderTeamInfo['member4Info']['safeBattleTag']}}</h5>
                                                <div class="fl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->senderTeamInfo['member4Info']['us']['stats']['competitive']['overall_stats']['comprank'] }}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->senderTeamInfo['member5Info']['_id']}}">
                                                <img src="{{$data->senderTeamInfo['member5Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:right" class="small-avatar-right avatar-list-item fl">
                                                <h5 class="small-member-name rl"> {{$data->senderTeamInfo['member5Info']['safeBattleTag']}}</h5>
                                                <div class="fl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->senderTeamInfo['member5Info']['us']['stats']['competitive']['overall_stats']['comprank'] }}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->senderTeamInfo['member6Info']['_id']}}">
                                                <img src="{{ $data->senderTeamInfo['member6Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:right" class="small-avatar-right avatar-list-item fl">
                                                <h5 class="small-member-name rl"> {{$data->senderTeamInfo['member6Info']['safeBattleTag']}}</h5>
                                                <div class="fl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->senderTeamInfo['member6Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-xs-2 teamColumn text-center">
                            <h1 class="vertical-center nomargins"> vs </h1>
                        </div>

                        <div class="col-xs-5  teamColumn">
                            <div class="vertical-center">
                                <div class="result">
                                    <div class="row row-keep-margins  ">
                                        <h3 class="   fl "> {{ $data->targetTeamInfo['name'] }}<p></p></h3>
                                    </div>
                                    <div class="row hidden-sm avatar-list">
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->targetTeamInfo['leaderInfo']['_id']}}">
                                                <img src="{{ $data->targetTeamInfo['leaderInfo']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:left" class="small-avatar fl leader-potrait">
                                                <h5 class="small-member-name fl"> {{$data->targetTeamInfo['leaderInfo']['safeBattleTag']}}</h5>
                                                <div class="rl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="  small-member-sr">{{ $data->targetTeamInfo['leaderInfo']['us']['stats']['competitive']['overall_stats']['comprank']  }}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->targetTeamInfo['member2Info']['_id']}}">
                                                <img src="{{ $data->targetTeamInfo['member2Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:left" class="small-avatar avatar-list-item fl">
                                                <h5 class="small-member-name fl"> {{$data->targetTeamInfo['member2Info']['safeBattleTag']}}</h5>
                                                <div class="rl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->targetTeamInfo['member2Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->targetTeamInfo['member3Info']['_id']}}">

                                                <img src="{{ $data->targetTeamInfo['member3Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:left" class="small-avatar avatar-list-item fl">
                                                <h5 class="small-member-name fl"> {{$data->targetTeamInfo['member3Info']['safeBattleTag']}}</h5>
                                                <div class="rl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->targetTeamInfo['member3Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->targetTeamInfo['member4Info']['_id']}}">
                                                <img src="{{ $data->targetTeamInfo['member4Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:left" class="small-avatar avatar-list-item fl">
                                                <h5 class="small-member-name fl"> {{$data->targetTeamInfo['member4Info']['safeBattleTag']}}</h5>
                                                <div class="rl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->targetTeamInfo['member4Info']['us']['stats']['competitive']['overall_stats']['comprank'] }}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->targetTeamInfo['member5Info']['_id']}}">
                                                <img src="{{$data->targetTeamInfo['member5Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:left" class="small-avatar avatar-list-item fl">
                                                <h5 class="small-member-name fl"> {{$data->targetTeamInfo['member5Info']['safeBattleTag']}}</h5>
                                                <div class="rl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->targetTeamInfo['member5Info']['us']['stats']['competitive']['overall_stats']['comprank'] }}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="row teammember hoverglow">
                                            <a href="{{ route('profile') }}?id={{$data->targetTeamInfo['member6Info']['_id']}}">
                                                <img src="{{ $data->targetTeamInfo['member6Info']['us']['stats']['competitive']['overall_stats']['avatar'] }}"
                                                     onerror="this.src='/img/default.png'"
                                                     style="float:left" class="small-avatar avatar-list-item fl">
                                                <h5 class="small-member-name fl"> {{$data->targetTeamInfo['member6Info']['safeBattleTag']}}</h5>
                                                <div class="rl hidden-sm hidden-xs" style="margin-top: 5px">
                                                    <p class="small-member-sr">{{ $data->targetTeamInfo['member6Info']['us']['stats']['competitive']['overall_stats']['comprank']}}
                                                        SR</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($data['status']=='accepted')
                    <div class="col-md-3  col-md-offset-1 text-left  ">
                        <h4 style="margin-top: 30px; text-transform: uppercase">This scrim is <span
                                    style="margin-left: 12px;margin-top: 4px;"
                                    class="btn btn-success btn-sm btn-round">{{$data['status']}}</span>
                        </h4>
                        <strong>Invite Link - <a target="_blank"
                                                 href="https://discordapp.com/invite/{{$data['discordChannelInviteCode']}}">https://discordapp.com/invite/{{$data['discordChannelInviteCode']}}</a></strong>
                        @if(!Auth::user()->discordAccessToken)
                            <a class="btn btn-primary btn-block"
                               href="{{config('discord.base_url')}}/oauth2/authorize?response_type=code&client_id={{config('discord.client_id')}}&scope=identify messages.read guilds guilds.join&state={{$data['id']}}&redirect_uri={{config('discord.oauth_redirect_url')}}">
                                <i class="material-icons">compare_arrows</i> Connect to Discord
                            </a>
                        @else
                            <div class="col-md-12 bg-green" id="chatdiv" style="position: relative;">
                                <ul class="chatBox" id="chatBox">
                                </ul>
                                <form class="">
                                    <textarea class="txt-dark" id="discordChatTxt"
                                              style="bottom:0;position: absolute; left:0; width:100%;color: #000;"></textarea>
                                </form>
                                <button id="discordChatSendBtn" class="btn btn-primary btn-block"
                                        style="bottom:-60px;position: absolute; left:0; ">Send
                                </button>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="col-md-3 col-md-offset-1  text-left  ">

                        <h4 style="margin-top: 30px; text-transform: uppercase">This scrim is <span
                                    style="margin-left: 12px;margin-top: 4px;"
                                    class="btn btn-danger btn-sm btn-round">{{$data['status']}}</span>
                        </h4>

                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        var discordAccessToken = "{{Auth::user()->discordAccessToken}}";
        var discordBaseUrl = "{{config('discord.base_url')}}";
        var discordChannelId = "{{$data['discordChannelId']}}";
        var discordChannelInviteCode = "{{$data['discordChannelInviteCode']}}";
        var lastMessageId = null;

        function getMessages(){
            $.ajax({
                url: '/discord/getChannelMessages',
                data: {
                    channelId: discordChannelId,
                    lastMessageId: lastMessageId
                },
                success: function (response, status) {
                    var messages = response.messages;
                    if(messages && messages[0]) {
                        lastMessageId = messages[0].id;
                    }
                    messages.reverse().forEach(function (message) {
                        addMessageToUi(message.author.username, message.content)
                    })
                }
            });
        }

        function addMessageToUi(user, content, avatar) {
            $('#chatBox').append("<li>" + user + " - " + content + "</li>");
        }

        if (discordAccessToken) {
            $.ajax({
                url: discordBaseUrl + '/users/@me',
                type: 'GET',
                crossDomain: true,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + discordAccessToken);
                },
                success: function (response, status) {
                    window.discordUserId = response.id;
                    window.discordUsername = response.username;
                    console.log('Discord - User Fetch - ' + status);

                    getMessages();
                    setInterval(function () {
                        getMessages();
                    }, 2000);

                    $.ajax({
                        url: discordBaseUrl + '/invites/' + discordChannelInviteCode,
                        method: 'POST',
                        crossDomain: true,
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('Content-Type', 'application/json');
                            xhr.setRequestHeader('Authorization', 'Bearer ' + discordAccessToken);
                        },
                        success: function (response, status) {
                            console.log('Discord - Auto-Accept Invite - ' + status);
                        }
                    })

                }
            });
        }

        $('#discordChatSendBtn').on('click', function (event) {
            var message = $('#discordChatTxt').val();
            $.ajax({
                url: '/discord/sendMessageToChannel',
                method: 'POST',
                data: {
                    channelId: discordChannelId,
                    message: '<@' + discordUserId + '> via OverwatchTeams - ' + message
                },
                success: function (response, status) {
                    console.log('Discord - Message Dispatched - ' + response.success);
                }
            })

        });


        $(document).ready(function () {
            $('.teamColumn').height($('body').height() - $('.teamColumn').position().top - $('.footer').height() - 150)
            $('#chatdiv').height($('body').height() - $('#chatdiv').position().top - $('.footer').height() - 150)
        });

        $(window).resize(function () {
            $('.teamColumn').height($('body').height() - $('.teamColumn').position().top - $('.footer').height() - 150)
            $('#chatdiv').height($('body').height() - $('#chatdiv').position().top - $('.footer').height() - 150)
        });
    </script>
@endsection

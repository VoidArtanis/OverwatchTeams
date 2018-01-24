@extends('layouts.app')

@section('content')
    <style>
        html,
        body {
            background: linear-gradient(rgb(0, 0, 0) 0%, rgba(0, 0, 0, 0.69) 34%, rgba(0, 0, 0, 0.3)), url(/img/hanamura.jpg);
            background-size: cover;
            min-height: 100vh;
            background-repeat: no-repeat;
        }

        .btn-group.bootstrap-select {
            margin: 0 !important;
        }

        .footer {
            color: #9a9a9a;
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

        .center {

            position: relative;

            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: flex;
            -webkit-justify-content: space-around;
            -moz-justify-content: space-around;
            -ms-justify-content: space-around;
            justify-content: space-around;
        }

        .middle-section {
            width: 60%;
        }

        .form-group label.control-label {
            font-size: 14px;
            line-height: 1.07143;
            color: #4e4e4e;
            font-weight: 500;
            margin: 16px -10px 0 11px;
        }
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>


    <div class="container " style="padding-top: 100px; min-height: 80vh ">
        <div class="center center-vertical col-sm-12">
            <div class="col-md-7 col-sm-12 col-xs-12 section"
                 style="background: white;    padding: 40px;    padding-top: 20px;">
                <div class="row">
                    <h3>Scrim Invitation</h3>
                    <h4>To Team: {{$opTeam['name']}}</h4>
                    @if(count($myTeams)==0)
                        <hr/>
                        <h4>Whoops!</h4>
                        <p ><Strong>Looks like you are not a leader of a team yet! Only the team leaders can send invites for a scrim.</Strong></p>
                    @else
                        <p><Strong>Note: You must be the team leader to create a scrim invitation.</Strong></p>
                        <form method="post" action="{{ route('scrimschedule-post') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="targetTeam" value="{{$opTeam['_id']}}">
                            <div class="col-md-12">
                                <h4 class="  formtitle bg-primary">Team Info</h4>

                                <div class="select-formgroup">
                                    <label class="label-control">My Team</label>
                                    <select class="selectpicker" data-style=" form-control " required
                                            name="senderTeam"
                                            title="Select your team"
                                            data-size="4">

                                        @foreach($myTeams as $tm)
                                            <option value="{{$tm['_id']}}">{{$tm['name']}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group   is-empty">
                                    <label class="label-control">Custom Message (Optional)</label>
                                    <textarea type="text" class="form-control" height="400px"
                                              placeholder="Hi, my team would like to play some friendly matches.."
                                              name="customMessage"
                                              required> </textarea>

                                </div>

                                <h4 class="  formtitle bg-primary">Match Info</h4>

                                <div class="select-formgroup ">
                                    <label class="label-control">Number of Matches</label>
                                    <select class="selectpicker" data-style=" form-control " required
                                            name="matches"

                                            data-size="4">

                                        <option value="bo1">1 Match</option>
                                        <option value="bo3">Best of 3</option>
                                        <option value="bo5">Best of 5</option>

                                    </select>
                                </div>

                                <div class="form-group is-empty">
                                    <label class="label-control">Match Date</label>
                                    <input type="text" class="form-control datetimepicker datepicker" required
                                           placeholder="10/05/2016" name="date"/>
                                </div>
                                <div class="form-group is-empty">
                                    <label class="label-control">Match Time</label>
                                    <input type="text" class="form-control datetimepicker timepicker" required
                                           placeholder="12:00 PM" name="time"/>
                                </div>
                                <hr/>

                                <input class="btn btn-primary" value="Send Invitation " type="submit">
                            </div>

                        </form>
                    @endif
                </div>

            </div>

            {{--<img src="/img/sombra.png" style="height: 50vh;    margin-left: 54px;"/>--}}
        </div>
    </div>



@endsection
@section('pre-scripts')

@endsection

@section('scripts')
    <script>
        $('.datepicker').datetimepicker({
            useCurrent: true,
            format: 'DD/MM/YYYY', icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            },
            minDate:new Date()
        });
        $('.timepicker').datetimepicker({
            useCurrent: true,
            format: 'hh:mm a', icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            },
            minDate:new Date()

        });
    </script>
@endsection
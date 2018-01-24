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
    </style>
    <link href="/css/profile.css" rel="stylesheet"/>
    <link href="/css/search.css" rel="stylesheet"/>
    <div class="   page-header-search txt-white" style="    background-color: #232323;">
        <div class="container" style="padding-top: 100px">
            <div class="row">
                <div class="col-md-12">

                    <h3>Edit Your Team</h3>
                    <h5>Gather your teammates and compete against other teams!</h5>
                    <br/>

                </div>
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>

    <div class="main main-raised" style="">
        <div class="container section" id="app">

            <div class="row">
                <form method="post" action="{{ route('teameditpost') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$oldval['id']}}" name="id">
                    <div class="col-md-5">
                        <h5 class="form-title">Basic Info</h5>
                        <div class="form-group   is-empty">
                            <label class="control-label">Team Name</label>
                            <input type="text" class="form-control" placeholder="team name" name="teamname" value="{{ $oldval['teamname'] }}"
                                   required>
                            <span class="material-input"></span>
                        </div>
                        <h5 style="color: red;font-size: 14px;">{{$errors->first()}}</h5>
                        <div class="form-group   is-empty">
                            <label class="control-label">Country</label>
                            <div class="bfh-selectbox bfh-countries" data-country="{{ $oldval['country'] }}" data-flags="true" data-blank="false"
                                 data-name="country"  data-filter="true"></div>
                            <span class="material-input"></span>
                        </div>

                        <div class="form-group is-empty">
                            <label class="control-label">Region</label>
                            <select class="selectpicker" data-style=" "
                                    name="region"
                                    title="Select The Region"
                                    data-size="4">

                                <option value="us" {{ ($oldval['region'] =='us') ? 'selected' : '' }}>US</option>
                                <option value="eu" {{ ($oldval['region'] =='eu') ? 'selected' : '' }}>EU</option>
                                <option value="kr" {{ ($oldval['region'] =='kr') ? 'selected' : '' }}>KR</option>

                            </select>
                        </div>
                        <br/> <br/>
                        <h5 class="form-title">Team Leader</h5>
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group   is-empty">
                                <label class="control-label">BattleTag of Leader</label>
                                <input type="text" class="form-control" placeholder="Battletag#12345" name="btleader" value="{{ $oldval['btleader'] }}"
                                       required>
                                <span class="material-input"></span>
                            </div>
                            <div class="form-group   is-empty">
                                <label class="control-label">Email Address of Leader</label>
                                <input type="email" class="form-control" placeholder="email@abc.com" required value="{{ $oldval['btleader-email'] }}"
                                       name="btleader-email">
                                <span class="material-input"></span>
                            </div>
                            <br/>
                            <br/>
                        </div>

                        <h5 class="form-title">Team Members</h5>

                        <div class="col-lg-12 col-sm-12">

                            <div class="form-group   is-empty">
                                <label class="control-label">BattleTag of Member 2</label>
                                <input type="text" class="form-control" placeholder="Battletag#12345" name="btmember2" value="{{ $oldval['btmember2'] }}"
                                       required>

                            </div>
                            <div class="form-group   is-empty">
                                <label class="control-label">BattleTag of Member 3</label>
                                <input type="text" class="form-control" placeholder="Battletag#12345" name="btmember3"  value="{{ $oldval['btmember3'] }}"
                                       required>

                            </div>
                            <div class="form-group   is-empty">
                                <label class="control-label">BattleTag of Member 4</label>
                                <input type="text" class="form-control" placeholder="Battletag#12345" name="btmember4"  value="{{ $oldval['btmember4'] }}"
                                       required>

                            </div>
                            <div class="form-group   is-empty">
                                <label class="control-label">BattleTag of Member 5</label>
                                <input type="text" class="form-control" placeholder="Battletag#12345" name="btmember5"  value="{{ $oldval['btmember5'] }}"
                                       required>

                            </div>
                            <div class="form-group   is-empty">
                                <label class="control-label">BattleTag of Member 6</label>
                                <input type="text" class="form-control" placeholder="Battletag#12345" name="btmember6"  value="{{ $oldval['btmember6'] }}"
                                       required>

                            </div>
                            <br/>
                            <br/>

                        </div>
                        <div class="col-lg-12 col-sm-12">
                        <h5 class="form-title">Team Description</h5>

                        <div class="form-group   is-empty">
                            <label class="control-label">Team Bio</label>
                            <textarea type="text" class="form-control" height="400"
                                      placeholder="Description about your team" name="teambio" required >{{ $oldval['teambio'] }}</textarea>

                        </div>
                    </div>
                    <input class="btn btn-primary" value="Submit " type="submit">
            </div>
            <div class="col-md-5 col-md-offset-1">
                <div class="info info-horizontal">
                    <div class="icon icon-rose">
                        <i class="material-icons">timeline</i>
                    </div>
                    <div class="description">
                        <h4 class="info-title">Rank up as a team</h4>
                        <p class="description">
                            Play with your mates and get an official rank. Compete against teams in your
                            country.
                        </p>
                    </div>
                </div>

                <div class="info info-horizontal">
                    <div class="icon icon-primary">
                        <i class="material-icons">whatshot</i>
                    </div>
                    <div class="description">
                        <h4 class="info-title">Custom team matches (scrims)</h4>
                        <p class="description">
                            Invite other teams to a friendly match. If the request is accepted, you will be
                            given
                            the details of the team for a custom game!
                        </p>
                    </div>
                </div>

                <div class="info info-horizontal">
                    <div class="icon icon-success">
                        <i class="material-icons">local_play</i>
                    </div>
                    <div class="description">
                        <h4 class="info-title">Organize tournaments</h4>
                        <p class="description">
                            Invite teams to compete in tournaments. Publish results and other stats like player
                            of
                            the tournament.
                        </p>
                    </div>
                </div>
            </div>
            </form>
        </div>

    </div>
    </div>



@endsection
@section('pre-scripts')

@endsection
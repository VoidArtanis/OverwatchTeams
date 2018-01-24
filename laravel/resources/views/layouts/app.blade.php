<!doctype html>
<html lang="{{ app()->getLocale() }}">
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="57x57" href="/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

    <!-- CSS Files -->
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/css/custom.css" rel="stylesheet"/>
    <link href="/css/material-kit.css?v=1.1.0" rel="stylesheet"/>
    <link href="/css/bootstrap-formhelpers.min.css" rel="stylesheet"/>

    <meta property="og:image" content="https://overwatchteams.com/img/ico.png"/>
    <meta property="og:title" content="Overwatch Teams"/>
    <meta property="og:type" content="community"/>
    <meta property="og:url" content="https://overwatchteams.com"/>
    <meta property="og:description" content="Find the perfect team to help your way through competitive Overwatch."/>

</head>
<body>

<div>
    <nav class="navbar navbar-primary navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand weight500" href="{{ url('/') }}">
                   Overwatch Teams
                </a>

                <form class="navbar-form navbar-left hidden-sm hidden-xs " role="search" method="GET" action="{{ route('profile') }}"
                      style="margin-top: 10px">
                    <div class="form-group form-white">
                        <input type="text" name="tag" class="form-control btSearchNav"
                               placeholder="&#xf002 Battletag#1234" style="font-family:Arial, FontAwesome"
                        >
                    </div>
                    <input type="submit" style="display:none"/>
                </form>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-form navbar-left hidden-md hidden-lg " role="search" method="GET" action="{{ route('profile') }}"
                              style="margin-top: 10px">
                            <div class="form-group form-white">
                                <input type="text" name="tag" class="  btSearchNav"
                                       placeholder="Search Battletag#1234"
                                >
                            </div>
                            <input type="submit" style="display:none"/>
                        </form>
                    </li>

                    <li><a href="{{ route('search') }}"><i class="fa fa-search weight500" aria-hidden="true" style="font-size: 19px;margin-right: 6px"></i>Find </a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="material-icons">whatshot</i>
                            Ranks <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-with-icons">
                            <li><a href="{{ route('topplayers') }}">Top Players</a></li>
                            <li><a href="{{ route('topTeams') }}">Top Teams</a></li>

                        </ul>
                    </li>

                    @if (Auth::guest())


                        <li><a href="{{ route('login') }}">Join</a></li>
                    @else
                        @if($hasTagRequests)
                            <li><a href="{{ route('requests') }}" class="button-glow">Invites</a></li>

                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->battleTag }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-with-icons">

                                <li><a href="{{ route('profile') }}"><i class="material-icons">person</i>My Profile</a></li>
                                <li><a href="{{ route('editprofile') }}"><i class="material-icons">mode_edit</i>Edit Profile</a></li>
                                <hr style="margin: 0;"/>
                                <li><a href="{{ route('myteams') }}"><i class="material-icons">people</i>My Teams</a></li>

                                <li><a href="{{ route('teamreg') }}"><i class="material-icons">group_add</i>Register Team</a></li>
                                <hr style="margin: 0;"/>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
                @if (!\Request::is('home'))
                    {{--<form class="navbar-form navbar-left" role="search">--}}

                    {{--<div class="form-group form-white">--}}
                    {{--<div class="input-group">--}}
                    {{--<input type="text" class="form-control" placeholder="location">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group form-danger responsive-header-select "  >--}}
                    {{--<select class="selectpicker  txt-white " multiple data-style="form-control"--}}
                    {{--title="Type" data-size="7">--}}
                    {{--<option value="1">Appartment</option>--}}
                    {{--<option value="2">Buy Land</option>--}}
                    {{--<option value="2">Buy House</option>--}}
                    {{--<option value="2">For Lease</option>--}}
                    {{--<option value="2">For Rent</option>--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="form-group form-white responsive-header-select ">--}}
                    {{--<select class="selectpicker txt-white" multiple data-style="form-control"--}}
                    {{--title="Payment Type" data-size="7">--}}
                    {{--<option value="1" >Rent</option>--}}
                    {{--<option value="2">Sell</option>--}}
                    {{--<option value="2">Lease</option>--}}
                    {{--</select>--}}
                    {{--</div>--}}

                    {{--<div class="form-group text-center">--}}
                    {{--<button type="submit" class="btn btn-white btn-raised btn-fab btn-fab-mini"><i--}}
                    {{--class="material-icons">search</i></button>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                @endif
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

@yield('content')

<!--     *********    BIG FOOTER     *********      -->

    <footer class="footer">
        <div class="container">
            <nav class="pull-left">
                <ul>
                    <li>
                        <a href="/">
                            Overwatch Teams
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('getstarted') }}">
                            Get Started
                        </a>
                    </li>
                    <li>
                        <a href="http://www.intellogic.lk">
                            About Us
                        </a>
                    </li>


                </ul>
            </nav>
            <div class="copyright pull-right">
                ©
                <script>document.write(new Date().getFullYear())</script>
                , made with <i class="material-icons">favorite</i> by Intellogic.
            </div>
        </div>
    </footer>

    <!--     *********   END BIG FOOTER     *********      -->
</div>

<!-- Scripts -->


</body>
@yield('pre-scripts')
<!--   Core JS Files   -->
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/bootstrap-formhelpers.js"></script>
<script src="/js/material.min.js"></script>


<!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
<script src="/js/moment.min.js"></script>

<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
<script src="/js/nouislider.min.js" type="text/javascript"></script>

<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
<script src="/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select   -->
<script src="/js/bootstrap-selectpicker.js" type="text/javascript"></script>

<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/   -->
<script src="/js/bootstrap-tagsinput.js"></script>

<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput   -->
<script src="/js/jasny-bootstrap.min.js"></script>

<!--    Plugin For Google Maps   -->
{{--<script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}

<!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
<script src="/js/atv-img-animation.js" type="text/javascript"></script>

<!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
<script src="/js/material-kit.js?v=1.1.0" type="text/javascript"></script>
<script src="/js/jquery.flexisel.js"></script>

<script src="https://www.gstatic.com/firebasejs/4.3.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.3.0/firebase-messaging.js"></script>
@if (!Auth::guest())
    <script>

        $.ajaxSetup({
            beforeSend: function (jqXHR, settings ) {
                if (!settings.crossDomain) {
                    jqXHR.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                }
            }
        });

        var config = {
            apiKey: "AIzaSyBfQvGtwIl6G1b95yOCNgeysxAP18NQwZg",
            messagingSenderId: "899277060134"
        };

        firebase.initializeApp(config);
        const messaging = firebase.messaging();
        messaging.requestPermission()
            .then(function () {
                console.log('Notification permission granted.');
                return messaging.getToken();
            })
            .then(function (currentToken) {
                var payload = {
                    token: currentToken,
                    userId: '{{Auth::user()['_id']}}'
                };

                $.ajax({
                    type: 'POST',
                    url: "{{ route('notifSave') }}",
                    data: payload,
                    dataType: 'script',

                    success: function (resultData) {

                    }
                });
            })
            .catch(function (err) {
                console.log('Unable to get permission to notify.', err);
            });

        messaging.onTokenRefresh(function () {
            messaging.getToken()
                .then(function (refreshedToken) {
                    console.log('Token refreshed.');
                })
                .catch(function (err) {
                    showToken('Unable to retrieve refreshed token ', err);
                });
        });

        messaging.onMessage(function (payload) {
            console.log("Message received. ", payload);
        });
    </script>
@endif
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-106384529-1', 'auto');
    ga('send', 'pageview');

</script>
@yield('scripts')
@yield('post-scripts')
</html>

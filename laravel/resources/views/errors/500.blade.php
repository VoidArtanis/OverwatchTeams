
<!doctype html>
<html lang="en">
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

    <title>Overwatch Team Finder</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="Qr2iEOh6wj0MlaOToQ6zR4mVPXcAtB38croL7Lo3">

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

    <!-- CSS Files -->
    <link href="/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/css/custom.css" rel="stylesheet"/>
    <link href="/css/material-kit.css?v=1.1.0" rel="stylesheet"/>
    <link href="/css/bootstrap-formhelpers.min.css" rel="stylesheet"/>
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
                <a class="navbar-brand" href="https://overwatchteams.com">
                    Overwatch Team Finder
                </a>


            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

        </div><!-- /.container-fluid -->
    </nav>

    <style>
        .btn-group.bootstrap-select {
            margin: 0 !important;
        }

        body {
            background-color: #eaeaea !important;
        }

        .main-raised {
            box-shadow: none !important;
        }

        .center {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
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
    </style>

    <div class=" text-center" style="margin-top: 100px; height: 80vh">
        <div class="center">
            <h1>Error 500</h1>
            <h3>Internal Server Error.</h3>
            <h5>{{$exception->getMessage()}}</h5>
            <p> <a class="btn btn-primary" href="/"> Go To Home </a></p>

            <img src="/img/sombra.png" style="height: 50vh;    margin-left: 54px;"/>
        </div>
    </div>


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


<!--    Plugin for 3D images animation effect, full documentation here: https://github.com/drewwilson/atvImg    -->
<script src="/js/atv-img-animation.js" type="text/javascript"></script>

<!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
<script src="/js/material-kit.js?v=1.1.0" type="text/javascript"></script>
<script src="/js/jquery.flexisel.js"></script>

<script src="https://www.gstatic.com/firebasejs/4.3.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.3.0/firebase-messaging.js"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "Qr2iEOh6wj0MlaOToQ6zR4mVPXcAtB38croL7Lo3"
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
                userId: '59aff520b0bedf2a1c0008e8'
            };

            $.ajax({
                type: 'POST',
                url: "https://overwatchteams.com/notiftokensave",
                data: payload,
                dataType: 'script',

                success: function (resultData) {

                }
            });

            console.log(currentToken);
        })
        .catch(function (err) {
            console.log('Unable to get permission to notify.', err);
        });

    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (refreshedToken) {
                console.log('Token refreshed.');
                // Indicate that the new Instance ID token has not yet been sent to the
                // app server.
                console.log(refreshedToken);
            })
            .catch(function (err) {
                console.log('Unable to retrieve refreshed token ', err);
                showToken('Unable to retrieve refreshed token ', err);
            });
    });

    messaging.onMessage(function (payload) {
        console.log("Message received. ", payload);
    });
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-106384529-1', 'auto');
    ga('send', 'pageview');

</script>
</html>

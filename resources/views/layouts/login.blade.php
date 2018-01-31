<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Login')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    @yield('content')
    <style>
        .hero.is-success {
            background: #F2F6FA;
        }
        .hero .nav, .hero.is-success .nav {
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        .box {
            margin-top: 5rem;
        }
        .avatar {
            margin-top: -70px;
            padding-bottom: 20px;
        }
        .avatar img {
            width: 128px;
            padding: 5px;
            background: #fff;
            border-radius: 50%;
            -webkit-box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
            box-shadow: 0 2px 3px rgba(10,10,10,.1), 0 0 0 1px rgba(10,10,10,.1);
        }
        input {
            font-weight: 300;
        }
        p {
            font-weight: 700;
        }
        p.subtitle {
            padding-top: 1rem;
        }
    </style>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
</body>
</html>

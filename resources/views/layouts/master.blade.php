<html>
    <head>
        <title>Alexandre Chartier - @yield('title')</title>

        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


    </head>
    <body>
        <div class="container">
            <div class="container-700">
            @yield('content')
            </div><!-- .container-700 -->
        </div><!-- .container -->

        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="/js/bootstrapValidator.js"></script>
        @yield('script')


    </body>
</html>
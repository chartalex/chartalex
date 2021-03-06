<html>
    <head>
        <title>Alexandre Chartier - @yield('title')</title>

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">

        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <link rel="shortcut icon" href="favicon.ico">

    </head>
    <body>
        <div class="container">
            <div class="container-700">
            @if (Auth::check())
                <div class="text-right small">
                    <a href="/mclh/order/" title="{{ Auth::user()->email }}">{{ Auth::user()->email }}</a> <span style="opacity: 0.5">(<a href="/auth/logout">logout</a>)</span>
                    @if (isset($cart))
                        <i class="fa fa-shopping-cart"></i>                
                        <a href="/mclh/cart" class="text-muted"> Cart </a>
                        ({{ Cart::count() }})
                    @endif
                </div>
            @endif

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
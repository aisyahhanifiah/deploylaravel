<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') ClubHub</title>
        <!-- Favicon -->
        <link href="{{ asset('img') }}/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> --}}
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

        <!-- <link type="text/css" href="/vendor/bootstrap/dist/css/bootstrap-reboot.min.css" rel="stylesheet"> -->
        

        {{-- <link rel="stylesheet" href="{{ asset('selectize') }}/css/selectize.css"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('selectize') }}/css/normalize.css">
        <link rel="stylesheet" href="{{ asset('selectize') }}/css/stylesheet.css"> --}}
        <link rel="manifest" href="{{asset('manifest.json')}}">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="msapplication-starturl" content="/">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="theme-color" content="#e5e5e5">
        
        {{-- <script type="text/javascript">
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function () {
                    navigator.serviceWorker.register('/sw.js').then(function (registration) {
                        console.log('ServiceWorker registration :', registration.scope);
                    }).catch(function (error) {
                        console.log('ServiceWorker registration failed:', errror);
                    });
                });
            }
           
        </script> --}}
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Argon JS -->
        

        <script src="">
            // $(document).ready(function() {
            //     $(document).on('click', '.nav-item a', function (e) {
            //         $(this).addClass('active').siblings().removeClass('active');
            //     });
            // });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>

        <script src="{{ asset('selectize') }}/js/standalone/selectize.js"></script>
        <script src="{{ asset('selectize') }}/js/selectize.js"></script><script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script> 

        @stack('js')
{{--         <script src="{{ asset('selectize') }}/js/index.js"></script>
 --}}
        @yield('loadlist')
        {{-- <script src="{{asset('js')}}/installworker.js"></script> --}}
        <script src="{{asset('try.js')}}"></script>
        {{-- <script type="text/javascript">
            // Check that service workers are supported
            if ('serviceWorker' in navigator) {
              // Use the window load event to keep the page load performant
              window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js');
              });
            }
        </script> --}}
</body>
</html>
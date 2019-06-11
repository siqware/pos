<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') | SigWare</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link href="{{asset('sigware/dist/semantic.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('sigware/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('sigware/css/main.css')}}" rel="stylesheet"/>
    <link href="{{asset('sigware/plugins/pacejs/pace.css')}}" rel="stylesheet"/>
    @stack('css')
    <link href="{{asset('sigware/css/utilities-stylesheet.css')}}" rel="stylesheet"/>
    <link href="{{asset('sigware/css/custom-css.css')}}" rel="stylesheet"/>
    @yield('css')
</head>
<body>
<div id="contextWrap">
    <!--sidebar-->
    @include('layouts.sidebar')
    <div class="pusher">
        <!--navbar-->
        @include('layouts.header')
        <!--navbar-->
        <!--maincontent-->
        <div class="mainWrap navslide">
            <div class="ui equal width left aligned padded grid stackable">
                <!--Site Content-->
                @yield('content')
                <!--Site Content-->
            </div>
        </div>
        <!--maincontent-->
    </div>
</div>
<!--jquery-->
<script src="{{asset('sigware/js/jquery-2.1.4.min.js')}}"></script>
<!--jquery-->
<!--semantic-->
<script src="{{asset('sigware/dist/semantic.min.js')}}"></script>
<!--semantic-->
<script src="{{asset('sigware/plugins/cookie/js.cookie.js')}}"></script>
<script src="{{asset('sigware/plugins/nicescrool/jquery.nicescroll.min.js')}}"></script>
<script data-pace-options='{ "ajax": false }' src="{{asset('sigware/plugins/pacejs/pace.js')}}"></script>
<script src="{{asset('sigware/js/main.js')}}"></script>
@stack('js')
{{--<script src="{{asset('sigware/js/custom-script.js')}}"></script>--}}
@yield('js')
</body>
</html>

<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name') }} | @yield('pageTitle')</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <style>
            /* Prevents slides from flashing */
            #slides {
              display:none;
            }
        </style>
        <link href="{{ asset('/bower_components/admin-lte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/> -->
        <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />    
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

        <!-- Yang ini buat search di select tag -->
        <link href="{{ asset('/bower_components/admin-lte/plugins/select2/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-blue.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/dist/css/slideshow.css') }}">

        <link href="{{ asset('/bower_components/admin-lte/dist/css/style.default.css') }}" rel="stylesheet" type="text/css" />
        
    </head>
    <body class="skin-blue">
        <div id="preloader">
            <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
        </div>
        <div class="wrapper">
            
            @include('layouts.web.partials.header')
            
            <div class="content-wrapper">
            @include('layouts.web.partials.content')
            </div>

            @include('layouts.web.partials.sidebar')

        </div>

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset ('/bower_components/admin-lte/dist/js/jquery.slides.min.js') }}"></script>
    <script src="{{ asset ('/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <script src="{{ asset ('/bower_components/admin-lte/dist/js/app.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    @yield('script')
    <script type="text/javascript">
    jQuery('body').css({'overflow':'hidden'});
    jQuery(window).ready(function() {       
       jQuery('#status').fadeOut();
       jQuery('#preloader').delay(350).fadeOut(function(){
          jQuery('body').delay(550).css({'overflow':'visible'});
       });
    });  

    </script>
    <script>
        $(function(){
            $("#slides").slidesjs({
                width: 640,
                height: 420,
            });
        });
    </script>
    <!-- <script src="{{ asset ('/bower_components/admin-lte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script> -->
    </body>
</html>
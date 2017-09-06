<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
        <link href="{{ asset('/bower_components/admin-lte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />     -->
        <!-- <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-blue.min.css') }}" rel="stylesheet" type="text/css" /> -->
        <link href="{{ asset('/bower_components/admin-lte/dist/css/style.default.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="signin">
        <section>    
            @include ('flash::message')
            <div class="signinpanel cs_df">
                <div class="row">            
                    <div class="col-md-7">                
                        <div class="signin-info">
                            <div class="logopanel">
                                <h1><img src="{{ asset('/logo/logo.png') }}" class="img-responsive" /></h1>
                            </div>
                            <div class="mb20"></div>
                        </div>            
                    </div>            
                    <div class="col-md-5">                
                        <form action="{{ route('login') }}" method="post" role="form">
                            {{ csrf_field() }}
                            <h4 class="nomargin">
                                Sign In
                            </h4>
                            <p class="mt5 mb20">
                                Login to access your account.
                            </p>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="email" name="email" class="form-control uname" placeholder="Username" required autofocus/>
                                
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" name="password" class="form-control pword" placeholder="Password" required/>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                  
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} /> Remember Me
                                    </label>                                    
                                </div>
                            </div>
                            <button class="btn btn-success btn-block">
                                Sign In
                            </button>
                            <input type="hidden" name="action" value="login" />
                        </form>
                    </div>            
                </div>       
            @include('/layouts/web/partials/footer')
            </div>  
        </section>
        
    <!-- REQUIRED JS SCRIPTS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset ('/bower_components/admin-lte/dist/js/app.min.js') }}" type="text/javascript"></script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>
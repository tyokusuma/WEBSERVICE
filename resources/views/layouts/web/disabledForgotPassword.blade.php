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
                    <div class="col-md-8 col-md-offset-2">                
                            <h4 class="nomargin">
                                Reset Password
                            </h4>
                            <p class="mt5 mb20">
                                Change your account password.
                            </p>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="password" name="password" class="form-control uname" placeholder="New password" disabled autofocus/>
                                
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" name="password_confirmation" class="form-control pword" placeholder="Confirm your password" disabled />
                            </div>
                            
                            <button class="btn btn-success btn-block">
                                Change Password
                            </button>
                            <input type="hidden" name="action" value="login" />
                    </div>            
                </div>       
            </div>  
        </section>
        
    <!-- REQUIRED JS SCRIPTS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset ('/bower_components/admin-lte/dist/js/app.min.js') }}" type="text/javascript"></script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>
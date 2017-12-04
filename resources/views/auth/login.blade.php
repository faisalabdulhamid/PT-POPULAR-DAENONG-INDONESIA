<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>{{ (isset($title)) ? $title: 'Login Page'}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="dist/img/metis-tile.png" />
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('dist/lib/bootstrap/css/bootstrap.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dist/lib/font-awesome/css/font-awesome.css') }}">
    
    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
    
    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="{{ asset('dist/lib/metismenu/metisMenu.css') }}">
    
    <!-- onoffcanvas stylesheet -->
    <link rel="stylesheet" href="{{ asset('dist/lib/onoffcanvas/onoffcanvas.css') }}">
    
    <!-- animate.css stylesheet -->
    <link rel="stylesheet" href="{{ asset('dist/lib/animate.css/animate.css') }}">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login">

    <div class="form-signin" id="root">
        <div class="text-center">
            <img src="{{ config('app.icon') }}" alt="{{ config('app.name') }}">
        </div>
        <hr>
        <div class="tab-content">
            <div id="login" class="tab-pane active">
                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <p class="text-muted text-center">
                        Enter your Email and password
                    </p>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" placeholder="Username" class="form-control top" name="email" v-model="data.email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" placeholder="Password" class="form-control bottom" name="password" v-model="data.password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="checkbox">
            		  <label>
            		    <input type="checkbox"> Remember Me
            		  </label>
            		</div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" v-on:click="login">Sign in</button>
                </form>
            </div>
            <div id="forgot" class="tab-pane">
                <form action="#">
                    <p class="text-muted text-center">Enter your valid e-mail</p>
                    <input type="email" placeholder="mail@domain.com" class="form-control">
                    <br>
                    <button class="btn btn-lg btn-danger btn-block" type="submit">Recover Password</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <ul class="list-inline">
                <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
                <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
            </ul>
        </div>
    </div>


    <!--jQuery -->
    <script src="{{ asset('dist/lib/jquery/jquery.js') }}"></script>

    <!--Bootstrap -->
    <script src="{{ asset('dist/lib/bootstrap/js/bootstrap.js') }}"></script>
    
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>

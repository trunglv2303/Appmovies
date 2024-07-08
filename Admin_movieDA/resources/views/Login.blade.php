<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>

<head>
    <title>Classy Login form Widget Flat Responsive Widget Template :: w3layouts</title>
    <script src="/template/assets/js/login.min.js"></script>
    <!-- Custom Theme files -->
    <link href="/template/assets/css/style1.css" rel="stylesheet" type="text/css" media="all" />
    <!-- for-mobile-apps -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Classy Login form Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <!-- //for-mobile-apps -->
    <!--Google Fonts-->
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>
</head>

<body>
    <!--header start here-->
    <div class="header">
        <div class="header-main">
            <h1>Login Form</h1>
            <div class="header-bottom">
                <div class="header-right w3agile">
                    @if (Session::has('error'))
                    <div style="background: red " class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif

                    @if (Session::has('password'))
                    <div style="background: red " class="alert alert-danger">
                        {{ Session::get('password') }}
                    </div>
                    @endif

                    @if (Session::has('username'))
                    <div style="background: red " class="alert alert-danger">
                        {{ Session::get('username') }}
                    </div>
                    @endif
                    <div class="header-left-bottom agileinfo">

                        <form action="{{route('login')}}" method="post">
							@csrf
                            <input type="email" value="Email" name="username" onfocus="this.value = '';"
                                onblur="if (this.value == '') {this.value = 'User name';}" required />
                            <input type="password" value="Password" name="password" onfocus="this.value = '';"
                                onblur="if (this.value == '') {this.value = 'password';}" required />
                            <div class="remember">
                                <span class="checkbox1">
                                    <label class="checkbox"><input type="checkbox" name="" checked=""><i>
                                        </i>Remember me</label>
                                </span>
                                <div class="forgot">
                                    <h6><a href="#">Forgot Password?</a></h6>
                                </div>
                                <div class="clear"> </div>
                            </div>

                            <input type="submit" value="Login">
                        </form>
                     

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--header end here-->

    <!--footer end here-->
</body>

</html>

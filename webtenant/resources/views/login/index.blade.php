<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Capital Place | Log in</title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="{{ url('/img/logoweb/iconweb.ico') }}">
        <!-- CSS -->
        <link href="{{ asset('public/lainnya/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/lainnya/plugins/font-awesome-4.4.0/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/AssetsLogin/css/AdminLTE.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/AssetsLogin/css/square/blue.css') }}" rel="stylesheet">

        <style>
            html, body {
                height: 80%;
                margin: 0;
            }

            .login-page {
                position: relative;
                overflow: hidden;
                min-height: 100vh;
                background: none; /* penting */
                background-size: cover
            }

            .login-page::before {
                content: "";
                position: absolute;
                inset: -20px; /* bukan 0, biar keluar dikit */

                background: url("{{ asset('public/lainnya/img/Background.jpg') }}") no-repeat center center;
                background-size: cover;

                filter: blur(8px);
                transform: scale(1.1);

                z-index: 0;
            }

            .login-page > * {
                position: relative;
                z-index: 1;
            }
 

            .login-btn {
                background-image: url("{{ asset('public/lainnya/img/sign-in.png') }}");
                background-color: transparent;
                background-size: 30px;
                height: 30px;
                width: 30px;
                border: 0px;
            }

            input:-webkit-autofill {
                -webkit-box-shadow: 0 0 0px 1000px white inset;
            }
        </style>
    </head>

<body class="login-page">
    <div class="login-box" style="width: 1024px;">

        {{-- <div class="login-logo">
            <img src="{{ asset('public/lainnya/img/logo-col.png') }}" height="200">
        </div> --}}

        <div class="login-box-body">
            <p class="login-box-msg">
                <font size="8" color="#bda870"><b>TENANT </b>Capital Place</font>
            </p>

            <p class="login-box-msg">
                <font size="10" color="#bda870">Sign in</font>
            </p>

            <form action="{{ url('/based') }}" method="POST" id="formlogin" class="needs-validation" novalidate="" style="width:360px; margin: 0 auto;">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="default-01">Email</label>
                    </div>
                    <input type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter your email address" required = "true">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign In</button>
                </div>
            </form><!-- form -->

        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('public/lainnya/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('public/AssetsLogin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/AssetsLogin/js/icheck.min.js') }}"></script>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>

    </body>
</html>
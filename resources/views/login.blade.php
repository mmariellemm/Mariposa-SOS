<!DOCTYPE html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSPINIA | Login</title>
    <link href="{{asset('public/master/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/master/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public/master/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/master/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/EstiloLogin.css')}}" rel="stylesheet">

</head>

<body>

<div class="login-container">
    <div class="row">
        <div class="col-md-6 right-column">
            <div class="middle-box text-center loginscreen animated fadeInRight">
                <div class="container-fluid">
                    <div>
                        <img src="{{asset('public/img/logo2.png')}}" width="250px" height="100px">
                        <h1 class="logo-name"></h1>
                    </div>
                    <h2 style="font-family: 'Imprint MT Shadow'">Bienvenido</h2>
                    <p style="font-family: 'Imprint MT Shadow', sans-serif; font-size: 20px; color: black;">Inicie sesión con su cuenta para acceder a la plataforma.</p>
                    <p style="font-family: 'Imprint MT Shadow', sans-serif; font-size: 20px; color: black;">Llene los campos.</p>
                    <form action="{{action('LoginController@iniciar_sesion')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Correo" value="" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña" value="" required="">
                        </div>

                        <button type="submit" class="btn btn-primary block full-width m-b">Iniciar Sesion</button>

                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success') }}
                            </div>
                        @endif

                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{Session::get('error') }}
                            </div>
                        @endif

                        <p style="font-family: 'Imprint MT Shadow', sans-serif; font-size: 20px; color: black;"><small>¿No tienes cuenta?</small></p>
                        <a class="btn btn-sm btn-white btn-block" href="{{ url('/jugador/autoregistro') }}">Crear una cuenta</a>
                        <br>
                        <a class="btn btn-primary" href="{{ url('/landing/page') }}">Página de Inicio</a>
                        <br>
                        <br>
                    </form>
                    <p class="m-t"> <small>Inspinia web app framework basado en Bootstrap 3 &copy; 2014</small> </p>
                </div>
                <br><br>

            </div>
        </div>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public/master/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('public/master/js/popper.min.js')}}"></script>
<script src="{{asset('public/master/js/bootstrap.js')}}"></script>

</body>

</html>

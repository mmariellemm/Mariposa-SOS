<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="{{asset('public/master/css/autoregistro.css')}}" rel="stylesheet">
    <link >
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>

</head>

<body>

    <div class="min-h-screen py-10" style="background-image: linear-gradient(180deg, #ffc300, #ff8b00);">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row w-10/12 lg:w-12/12 bg-white rounded-xl shadow-lg mx-auto overflow-hidden" style="border: 4px solid #ffffff;; background: linear-gradient(120deg, #9bda5d, #ffb600)">
                <div class="w-full lg:w-1/2 flex flex-col items-center justify-center text-center p-12" >
                    <h1 class="text-3xl mb-3">Bienvenido al registro</h1>
                    <p>Crea una cuenta para acceder a la plataforma.</p>
                    <p class="mt-2">Crea tu cuenta. Solo toma un minuto</p>


                    <p class="mt-5 text-muted text-center">¿Ya tienes una cuenta?</p>
                    <a style="width: 50%" href="{{ route('login') }}" class="block w-50% mx-auto bg-green-700 py-3 text-center text-white">Login</a>


                </div>
                <div class="w-full lg:w-1/2 py-16 px-12">
                    <h2 class="text-center text-3xl mb-4">Registro</h2>
                    <h2 class="mb-3 text-center">Datos del usuario</h2>

                    <form class="contenedor2 AutoRegistroFondo" role="form" action="{{action('JugadorController@autoregistro')}}" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <div class="grid grid-cols-2 gap-5">
                            <input type="text" name="nombre" required="" placeholder="Su nombre" class="border border-gray-400 py-1 px-2">
                            <input type="text" name="alias" required="" placeholder="Su Alias" class="border border-gray-400 py-1 px-2">
                        </div>
                        <div class="mt-5">
                            <input type="email" name="email" value="" required="" placeholder="Su email" class="border border-gray-400 py-1 px-2 w-full">
                        </div>
                        <div class="mt-5">
                            <input type="password" name="password" required="" placeholder="Contraseña" class="border border-gray-400 py-1 px-2 w-full">
                        </div>
                        <div class="mt-5 text-center bg-white">
                            <label>Selecciona tu edad:</label> <br>
                            <select  class="form-control" style="border-radius: 10px; border: 2px solid black" name="edad"  required="">
                                <option value="1">8-18</option>
                                <option value="2">19-45</option>
                                <option value="3">46-60</option>
                            </select>

                        </div>

                        <div class="mt-5 text-center bg-white" style="border: 10px solid whitesmoke">
                            <label>Género:</label><br>
                            <label>
                                <input type="radio" name="genero" value="M"> Masculino
                            </label>
                            <label>
                                <input type="radio" name="genero" value="F"> Femenino
                            </label>
                            <!-- Agrega más opciones según sea necesario -->
                        </div>
                        <div class="mx-auto mt-5 text-center">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark" for="file_input">Sube tu foto de perfil</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none bg-white dark:border-gray-600 dark:placeholder-gray-400" name="foto" accept="image/*" id="file_input" type="file">


                        </div>
                        <div class="mt-5 text-center ">
                            <button type="submit" class="w-full bg-orange-500 py-3 text-center text-white"> Registrarse ahora</button>

                        </div>
                    </form>


                </div>

            </div>
            <div>
                <!--<h1 class="logo-name"><img src="{{asset('public/img/logo.png')}}" width="280px" height="200px"></h1>-->

            </div>

        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="{{asset('public/master/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('public/master/js/popper.min.js')}}"></script>
    <script src="{{asset('public/master/js/bootstrap.js')}}"></script>

</body>

</html>

<style media="screen">

</style>

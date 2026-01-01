<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Protest+Riot&display=swap');
    </style>

    <!--TITULO DE LA PAGINA ARRIBA EN EL NAVEGADOR-->
    <title>S.O.S Mariposa</title>

    <!-- All CSS -->
    <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">



</head>



<body>


    <!--TITULO DE LA PAGINA DE INICIO-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <!--<a class="navbar-brand" href="#"><span class="text-warning"></span></a>-->
            <br>


            @if(isset($jugador))
            <font face="Rubik Pixels" size="5.9" color="black">
                S.O.S MARIPOSA
                <br>
                Bienvenid@ {{$jugador->nombre}}
            </font>
            @else
            <font face="Rubik Pixels" size="7" color="black">
            </font>
            <div class="img-logo">
                <img src="{{asset('public/img/logo2.png')}}" width="170px" height="65px" alt="">
            </div>


            @endif

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <!--BOTONES DEL MENU DE LA PAGINA-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item NavbarFont">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>

                    <li class="nav-item NavbarFont">
                        <a class="nav-link" href="#dequetrata">¿De que trata?</a>
                    </li>

                    <li class="nav-item NavbarFont">
                        <a class="nav-link" href="#Objetivo">Objetivo</a>
                    </li>


                    <li class="nav-item NavbarFont">
                        <a class="nav-link" href="#personajes">Personajes</a>
                    </li>

                    <li class="nav-item NavbarFont">
                        <a class="nav-link" href="#jugar">¡Empezar a jugar!</a>
                    </li>

                    <li class="nav-item NavbarFont">
                        <a class="nav-link" href="#equipotrabajo">¿Quienes somos?</a>
                    </li>
                    @if(isset($jugador))
                    <li class="nav-item">
                        <a class="nav-link" href="#tienda">tienda</a>
                    </li>

                    @else

                    @endif



                    @if(isset($jugador))
                    <li class="nav-item NavbarFont" style="margin-left: 10px;">
                        <a class="btn btn-danger" href="{{route('login')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                            Log-out
                        </a>
                    </li>

                    @else
                    <li class="nav-item NavbarFont">
                        <a class="btn btn-success" href="{{ url('/jugador/autoregistro') }}">Registrarme</a>
                    </li>

                    <li class="nav-item NavbarFont" style="margin-left: 10px;">
                        <a class="btn btn-success" href="{{route('login')}}" style="background-color: #FF8B00;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                            Login
                        </a>
                    </li>
                    @endif







                </ul>
            </div>
        </div>
    </nav>



    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('public/img/dashboard/CarrucelI2.png')}}" class="d-block w-100 " alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>¡Ayuda a monarca!</h5>
                    <p>Sumergete en la vida de una pequeña mariposa acabada de eclosionar.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('public/img/dashboard/CarrucelI1.png')}}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Sumérgete en un mundo hermoso y desafiante</h5>
                    <p>Supera niveles emocionantes mientras ayudas a monarca a superar sus enemigos naturales que pondrán a prueba tus habilidades de vuelo y evasión.. </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Algo terrible esta por suceder en el bosque</h5>
                    <p>Ayudala a escapar de algo aterrador para todos</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <!--Historia-->
    <section id="dequetrata" class="about section-padding">
        <br><br>
        <!--DE QUE TRATA?-->
        <div class="SobreJuego">
            <h1 style="text-align: center;">Historia</h1>
            <br>

        </div>
        <div style="border: 2px solid #02b56f; padding: 10px;" class="d-flex position-relative  ">
            <iframe class="flex-shrink-0 me-3" width="560" height="315" src="https://www.youtube.com/embed/hDc_KO-ys_k?si=1Nxihttbzbfewref" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <div>
                <h3 style="text-align: Center;">
                    <br><br>
                    Una delicada mariposa ha emergido del capullo, lista para emprender su viaje migratorio. <br>Sin embargo, el camino que le aguarda está plagado de peligros. <br> ¡Acompáñala y ayúdala a alcanzar su destino!
                </h3>
            </div>
        </div>
    </section>

    <section id="Objetivo" class="about section-padding">
        <br><br>
        <!--DE QUE TRATA?-->
        <div class="SobreJuego">
            <h1 style="text-align: center;">Objetivo</h1>
            <br>

        </div>
        <div style="border: 2px solid #00ffcc; padding: 10px; background: linear-gradient(120deg, #02b56f, #02b56f);" class="d-flex position-relative  ">
            <div>
                <h3 style="text-align: center;">
                    Ante la preocupante situación de la población de mariposas monarca en los bosques del sur y oeste de México, donde se observa una disminución significativa, es imperativo destacar el papel del ser humano en este declive.
                    <br> A través de Mariposa S.O.S, buscamos hacer cociencia a las personas a conocer la belleza y fragilidad de la naturaleza, mientras aprenden sobre la importancia de proteger el hábitat natural de las mariposas monarca y otras especies vulnerables. Reconocer que la responsabilidad humana en este fenómeno es fundamental para lograr cambios positivos en nuestras acciones hacia un futuro más sostenible.
                    <br> <br> ¡Acompaña a monarca en su viaje migratorio y sé parte del cambio!"
                </h3>
            </div>
        </div>
    </section>





    <!--PERSONAJES-->
    <section id="personajes" class="portfolio section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h1>Personajes</h1>
                        <h3>¡Conoce a la historia de enemigos y amigos!</h3>

                    </div>
                </div>
            </div>



            <!--MARIPOSA MONARCA-->
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 mx-auto">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark Personajes" style="background: linear-gradient(120deg, #02b56f, #02b56f);">
                            <div class="img-area mb-4">
                                <img src="{{asset('public/img/mariposamo.png')}}" class="img-fluid" width="115px" height="115px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">Mariposa Monarca</h3>
                            <p class="lead">Monarca es mundialmente conocida por la increíble migración masiva que lleva junto a millones de
                                ejemplares a California y México cada invierno. <br> La monarca norteamericana es la única mariposa que realiza una travesía
                                tan espectacular, con una distancia cercana a los 5000 kilómetros.</p>
                        </div>
                    </div>
                </div>
                <br>

                <div class="col-12 col-md-12 col-lg-4 mx-auto">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark Personajes" style="background: linear-gradient(120deg, #02b56f, #02b56f);">
                            <div class="img-area mb-4">
                                <img src="{{asset('public/img/dashboard/LagartijaP.png')}}" class="img-fluid" width="115px" height="115px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">Lagartija del disfraz</h3>
                            <p class="lead Personajes"> La lagartija acecha en los rincones oscuros del bosque en busca de presas. Su piel escamosa y camuflaje la hacen casi invisible entre la vegetación, lo que la convierte en una amenaza sigilosa para las mariposas monarca. Con su lengua larga y rápida, puede atrapar a sus presas en un abrir y cerrar de ojos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 mx-auto">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark Personajes" style="background: linear-gradient(120deg, #02b56f, #02b56f);">
                            <div class="img-area mb-4">
                                <img src="{{asset('public/img/dashboard/RoedorP.png')}}" class="img-fluid" width="115px" height="115px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">Raton de las sombras</h3>
                            <p class="lead Personajes">El Roedor es una amenaza constante para las mariposas monarca en su viaje migratorio. Es un depredador temido en el bosque. A menudo se esconde en madrigueras subterráneas o entre la maleza, esperando pacientemente a que las mariposas monarca se acerquen lo suficiente como para atacar.</p>
                        </div>
                    </div>
                </div>
                <div><br></div>
                <div class="col-12 col-md-12 col-lg-4 mx-auto">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark Personajes" style="background: linear-gradient(120deg, #02b56f, #02b56f);">
                            <div class="img-area mb-4">
                                <img src="{{asset('public/img/dashboard/AguilaP.png')}}" class="img-fluid" width="115px" height="115px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">El Águila Alada</h3>
                            <p>El Águila Alada es la reina de los cielos y una cazadora formidable. Con su enormes alas y su aguda visión, acecha desde lo alto del gran bosque en busca de presas, entre ellas, las mariposas monarca. Su vuelo majestuoso y silencioso le permite sorprender a sus presas antes de que puedan huir. </p>
                        </div>
                    </div>
                </div>



                <!--ORCA-->
                <!--<div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="img/orca.jpg" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Orca</h3>
                            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eligendi
                                modi temporibus alias iste. Accusantium?
                            </p>

                            #nota: esta linea no se usa por el momento <button class="btn bg-warning text-dark">learn More</button>

                        </div>
                    </div>
                </div>-->

                <!--<br><br>
                (INSERTAR OTRO ANIMAL)-->
                <!--<div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="img/project-3.jpg" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title">Building Make</h3>
                            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eligendi
                                modi temporibus alias iste. Accusantium?</p>
                            <button class="btn bg-warning text-dark">Learn More</button>
                        </div>
                    </div>

                </div>-->

            </div>
        </div>


    </section>


    <!--PRESENTACION DEL EQUIPO DE TRABAJO-->
    <section class="team section-padding" id="equipotrabajo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h1>¿Quienes somos?</h1>
                        <h4>Somos un equipo de desarrolladores y estudiantes de la
                            Universidad Tecnologica Metropolitana,<br>en la que cada uno
                            de nosotros contribuyo a la creacion de este proyecto.
                        </h4>

                    </div>
                </div>
            </div>





            <br>
            <br>
            <br>
            <!--DESARROLLADORA 1-->
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark" style="background-color:#2EFFB4">
                            <div class="img-area mb-4">

                                <!--IMAGEN, NOMBRE Y DESCRIPCION-->
                                <img src="{{asset('public/img/mariposamo.png')}}" class="img-fluid" width="130px" height="130px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">Marielle Abigail <br> Ake Carrillo</h3>
                            <br>
                            <!--<p class="lead">
                                Encargada de la creacion y diseño del lading page del juego, y
                                diseño de los personajes. <br><br>
                            </p>-->

                            <!--<button class="btn bg-warning text-dark">Learn More</button>-->

                        </div>
                    </div>
                </div>


                <!--DESARROLLADOR 2-->
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark" style="background-color:#2EFFB4">
                            <div class="img-area mb-4">
                                <img src="{{asset('public/img/mariposamo.png')}}" class="img-fluid" width="150px" height="150px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">Victor Manuel <br> Manrique Echeverria</h3>
                            <!--  <p class="lead">
                                Encargado de la creacion del panel administrativo y registro
                                en la base de datos.
                            </p>-->

                            <!--#nota: esta linea no se usa por el momento <button class="btn bg-warning text-dark">learn More</button>#-->

                        </div>
                    </div>
                </div>


                <!--DESARROLLADORA 3-->
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark" style="background-color:#2EFFB4">
                            <div class="img-area mb-4">
                                <img src="{{asset('public/img/mariposamo.png')}}" class="img-fluid" width="150px" height="150px"> <!--ancho/alto-->
                            </div>
                            <!--  <img src="{{asset('public/img/Lagartija2.png')}}" class="img-fluid" width="130px" height="130px" alt="">-->
                            <h3 class="card-title">Gilda Gabriela <br> Be Tun</h3>
                            <!--<p class="lead">
                                Encargada de la creacion del login para el panel administrativo <br><br>-->
                            <!--</p>
                            nota: esta linea no se usa por el momento <button class="btn bg-warning text-dark">learn More</button>-->

                        </div>
                    </div>
                </div>
            </div>



        </div>


    </section>




    <!--PRESENTACION DEL EQUIPO DE TRABAJO-->
    <section class="team section-padding" id="equipotrabajo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h1>Tienda</h1>
                        <h4> Conoce los articulos que podras comprar<br>al embarcarte en tu viaje.
                        </h4>

                    </div>
                </div>
            </div>






            <br>
            <br>
            <br>
            <!--Tienda 1-->
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark" style="background-color:#d1cab2">
                            <div class="img-area mb-4">

                                <!--IMAGEN, NOMBRE Y DESCRIPCION-->
                                <img src="{{asset('storage\app\skins\skin-5.png')}}" class="img-fluid" width="130px" height="240px"> <!--ancho/alto-->

                            </div>
                            <h3 class="card-title">Mariposa <br> Verde</h3>
                            <br>
                            <button type="button" name="button" class="btn btn-warning ">Comprar</button>
                            <!--<p class="lead">
                                    Encargada de la creacion y diseño del lading page del juego, y
                                    diseño de los personajes. <br><br>
                                </p>-->

                            <!--<button class="btn bg-warning text-dark">Learn More</button>-->

                        </div>
                    </div>
                </div>



                <!--DESARROLLADOR 2-->
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark" style="background-color:#d1cab2">
                            <div class="img-area mb-4">
                                <img src="{{asset('storage\app\skins\skin-6.png')}}" class="img-fluid" width="150px" height="150px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">Proximamente en venta <br>Mariposa Rainbown</h3>
                            <button type="button" name="button" class="btn btn-warning ">Comprar</button>

                            <!--  <p class="lead">
                                    Encargado de la creacion del panel administrativo y registro
                                    en la base de datos.
                                </p>-->

                            <!--#nota: esta linea no se usa por el momento <button class="btn bg-warning text-dark">learn More</button>#-->

                        </div>
                    </div>
                </div>


                <!--DESARROLLADORA 3-->
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark" style="background-color:#d1cab2">
                            <div class="img-area mb-4">
                                <img src="{{asset('storage\app\skins\skin-4.png')}}" class="img-fluid" width="150px" height="150px"> <!--ancho/alto-->
                            </div>
                            <!--  <img src="{{asset('public/img/Lagartija2.png')}}" class="img-fluid" width="130px" height="130px" alt="">-->
                            <h3 class="card-title">Mariposa <br>Roja</h3>
                            <button type="button" name="button" class="btn btn-warning ">Comprar</button>
                            <!--<p class="lead">
                                    Encargada de la creacion del login para el panel administrativo <br><br>-->
                            <!--</p>>
                            nota: esta linea no se usa por el momento <button class="btn bg-warning text-dark">learn More</button>-->

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>

    @if(isset($jugador))
    <!--PRESENTACION DEL EQUIPO DE TRABAJO-->
    <section class="team section-padding" id="tienda">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header text-center pb-5">
                        <h1>Tienda</h1>
                        <h4>Compra Skins para el personaje en nuestra tienda en linea
                        </h4>

                    </div>
                </div>
            </div>


            <!--DESARROLLADORA 1-->
            <!<div class="row">
                <div class="col-12 col-md-12 col-lg-4 mx-auto">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">

                                <!--IMAGEN, NOMBRE Y DESCRIPCION-->
                                <img src="{{asset('storage/app/skins/skin-2.jpg')}}" class="img-fluid" width="150px" height="150px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">Mariposa Roja</h3>
                            <p class="lead">
                                Mariposa de un hermoso color rojo <br><br>
                                Presumela ahora
                            </p>

                            <button class="btn btn-danger">Comprar</button>

                        </div>
                    </div>
                </div>


                <!--DESARROLLADOR 2-->
                <div class="col-12 col-md-12 col-lg-4 mx-auto">
                    <div class="card text-light text-center bg-white pb-2">
                        <div class="card-body text-dark">
                            <div class="img-area mb-4">
                                <img src="{{asset('storage/app/skins/skin-3.jpg')}}" class="img-fluid" width="150px" height="150px"> <!--ancho/alto-->
                            </div>
                            <h3 class="card-title">Mariposa Verde</h3>
                            <p class="lead">
                                Mariposa de un hermoso color rojo <br><br>
                                Presumela ahora
                            </p>
                            <button class="btn btn-danger">Comprar</button>

                            <!--#nota: esta linea no se usa por el momento <button class="btn bg-warning text-dark">learn More</button>#-->

                        </div>
                    </div>
                </div>



        </div>
        </div>


    </section>

    @else

    @endif



    <!--REGISTRARSE-->
    <!--<section id="registrarme" class="contact section-padding">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h1>¡Registrate para mas!</h1>
                        <h4>Para mas informacion, registrate con tus datos<br></h4>

                    </div>
                </div>
            </div>
    -->


    <!--DATOS PARA REGISTRARSE-->
    <!--<div class="iframe-container">
                <iframe src="AreaRegistro.php" frameborder="0" width="1313px" height="460px"></iframe>

            </div>

        </div>
    </section>
    -->



    <!--FOOTER STARTS-->
    <footer class="bg-dark p-2 text-center">
        <div class="container">
            <!--COPYRIGHT-->
            <p class="text-white">Desarrollada por: MARIELLE AKE CARRILLO, GILDA BE TUN, VICTOR MANRIQUE ECHEVERRIA. <br>Pagina web elaborada por estudiantes de la <BR> UNIVERSIDAD TECNOLOGICA METROPOLITANA.<br><br></p>

        </div>
    </footer>
    <!--FOOTER ENDS-->










    <!--All JS-->
    <script src="{{asset('public/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/"js/script.js"')}}"></script>



</body>

</html>
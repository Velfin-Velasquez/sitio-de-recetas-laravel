<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- FONTS -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('fonts/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

    <!-- OWL CAROUSEL -->
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/dist/assets/owl.carousel.min.css') }}">
    <script src="{{ asset('plugins/owl-carousel/dist/owl.carousel.min.js') }}"></script>

    <!-- SPLIDE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>

    <!-- JQUERY MODAL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

    <!-- MODAL VIDEO -->
    <link rel="stylesheet" href="{{asset('plugins/modal-video/css/modal-video.min.css')}}">
    <script src="{{asset('plugins/modal-video/js/modal-video.min.js')}}"></script>

    <!-- MAGNIFIC POPUP -->
    <link rel="stylesheet" href="{{asset('plugins/magnific-popup/dist/magnific-popup.css')}}">
    <script src="{{asset('plugins/magnific-popup/dist/jquery.magnific-popup.js')}}"></script>

    <!-- MOMENT JS -->
    <script src="https://momentjs.com/downloads/moment.min.js"></script>

    <!-- EMOJI AREA -->
    <link rel="stylesheet" href="{{asset('plugins/emoji-area/dist/emojionearea.min.css')}}">
    <script type="text/javascript" src="{{asset('plugins/emoji-area/dist/emojionearea.min.js')}}"></script>

    <!-- EMOJI PICKER -->
    <link rel="stylesheet" href="{{asset('plugins/emoji-picker/css/jquery.emojipicker.css')}}">
    <script type="text/javascript" src="{{asset('plugins/emoji-picker/js/jquery.emojipicker.js')}}"></script>

    <link rel="stylesheet" href="{{asset('plugins/emoji-picker/css/jquery.emojipicker.a.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/emoji-picker/css/jquery.emojipicker.g.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/emoji-picker/css/jquery.emojipicker.tw.css')}}">
    <script type="text/javascript" src="{{asset('plugins/emoji-picker/js/jquery.emojis.js')}}"></script>

    <!-- APP JS and CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>


    <script type="text/javascript">
        $(document).ready(function(e) {
            // emoji picker
            // $('#input-default').emojiPicker({
            //     position: 'left',
            // });
            // emojionarea
            $("#emojion").emojioneArea();
        });
    </script>
    @yield('styles')
</head>

<body>
    <div id="app" class="wrapper">
        <!-- SIDEBAR ONLY IF IS AUTH-->
        @auth
        <nav id="sidebar">
            <div class="custom-menu">
                <section class="custom-menu__title">
                    <a href="{{ route('inicio.index') }}">
                        <h5><b>Dishes 🥡</b></h5>
                    </a>
                </section>

                <section class="custom-menu__list">
                    <div class="menu-item"><a href="{{ route('inicio.index') }}"><i class="far fa-home"></i>Inicio</a>
                    </div>
                    <div class="menu-item"><a href="{{ route('recetas.index') }}"><i class="far fa-concierge-bell"></i></i> Recetas</a></div>
                    <div class="menu-item"><a href="{{ route('perfiles.show', ['perfil' => Auth::user()->id]) }}"><i class="far fa-user-circle"></i> Perfil</a></div>
                </section>
            </div>


            <div class="sidebar__bottom">
                <a href="{{ route('logout') }}" data-target="#logoutModal" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <h5><b><span class="emoticon"></span> Cerrar Sesión</b></h5>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>
        @endauth


        <!-- RIGHT CONTENT -->
        <div id="content">
            <!-- STICKY BANNER LOGIN AND REGISTER -->
            @guest
            <div class="container-fluid login-banner sticky-top">
                <h5 class="login-banner__message">¿Aún no te encuentras authenticado 🧐?, para explorar y compartir
                    recetas por favor create una cuenta <a class="action" href="{{ route('register') }}"><b>aquí</b></a> o tal caso de disponer una cuenta <a class="action" href="{{ route('login') }}"><b>inicie sesión</b></a></h5>
            </div>
            @endguest

            <!-- NAVBAR-TOP NAVIGATION -->
            <nav class="navbar navbar-expanded">
                <div class="container-fluid">
                    <!-- NAVBAR HEADER OR BRAND -->
                    <div class="navbar-header">
                        @guest
                        <a class="navbar-brand" href="/">Dishes 🥡</a>
                        @else
                        <button type="button" id="sidebarCollapse" class="btn btn-light">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                        @endguest
                    </div>

                    <!-- MOBILE GRID SEACH -->
                    @auth
                    <form class="form-group col-9 col-sm-9 col-md-9 col-lg-5 col-xl-5 me-auto mb-2 mb-lg-0" action="{{ route('buscar.show') }}" method="GET">
                        <input class="form-control form-control-lg nav-search" type="search" name="buscar" placeholder="Buscar" aria-label="Search">
                    </form>
                    @else
                    <form class="form-group col-8 col-sm-8 col-md-9 col-lg-5 col-xl-5 me-auto mb-2 mb-lg-0" action="{{ route('buscar.show') }}" method="GET">
                        <input class="form-control form-control-lg nav-search" type="search" name="buscar" placeholder="Buscar" aria-label="Search">
                    </form>
                    @endauth

                    <!-- USER PROFILE -->
                    <!-- d-none d-lg-block -->
                    <ul class="nav navbar-nav d-none d-lg-block">
                        @guest
                        <a class="btn login-button" href="{{ route('login') }}">Iniciar Sesión</a>
                        @else
                        <a href="{{ route('perfiles.show', ['perfil' => Auth::user()->id]) }}">
                            @if (!Auth::user()->perfil->imagen)
                            <user-recetas user-image={{ asset('images/avatarEmpty.jpg') }} user-name={{ Auth::user()->name }} user-id={{ Auth::user()->id }}></user-recetas>
                            @else
                            <user-recetas user-image={{ asset('/storage/' . Auth::user()->perfil->imagen) }} user-name={{ Auth::user()->name }} user-id={{ Auth::user()->id }}></user-recetas>
                            @endif
                        </a>
                        @endguest
                    </ul>
                </div>
            </nav>

            <!-- PAGE CONTENT-->
            <div id="page-content" class="container-fluid">
                <!-- CATEGORY SLIDER -->

                @if (!str_contains(Request::url(), '/recetas') && !str_contains(Request::url(), '/perfiles') && !str_contains(Request::url(), '/buscar'))

                <div class="container-fluid">
                    <section class="all-categories">
                        <h2 class="subtitle"><b>🥸 Categorías</b></h2>
                        <hr class="divider" style="margin-top:10px;">

                        <!-- ALTERNATIVA -->
                        <!-- <div class="owl-carousel owl-theme categories-carousel" style="height: 100px;">
                            @foreach ($categorias as $categoria)
                            <a class="category-card" href="{{ route('categorias.show', ['categoriaReceta' => $categoria->id]) }}">
                                <span class="category-card__icon">{!! $categoria->icono !!}</span>
                                <span class="category-card__title"><b>{{ $categoria->nombre }}</b></span>
                                <span class="category-card__counter">10 Recetas</span>
                            </a>
                            @endforeach
                        </div> -->

                        <div id="splide-category-horizontal" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($categorias as $categoria)
                                    <!-- {{$categoria}} -->
                                    <li class="splide__slide" style="margin-left: 30px; margin-right: 30px;">
                                        <a class="category-card" href="{{ route('categorias.show', ['categoriaReceta' => $categoria->id]) }}">
                                            <span class="category-card__icon">{!! $categoria->icono !!}</span>
                                            <span class="category-card__title"><b>{{ $categoria->nombre }}</b></span>
                                            <span class="category-card__counter">10 Recetas</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>

                @endif
                <br>
                <!-- CONTENT INJECTION -->
                <div class="py-1 mt-4 ml-5 col-12">
                    @yield('botones')
                    @yield("content")
                </div>

            </div>
        </div>
    </div>

    @yield('script')

</body>

</html>
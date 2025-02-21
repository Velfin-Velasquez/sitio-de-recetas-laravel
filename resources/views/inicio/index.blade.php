@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<div class="container-fluid">
    <!-- ULTIMAS RECETAS -->
    <section class="latest-recipes">
        <h2 class="subtitle"><b>🧐 Últimas Recetas</b></h2>
        <hr class="divider">

        <!-- CAROUSEL ULTIMAS RECETAS -->
        @if (count($nuevas) === 0)
        <p class="alert alert-warning text-center"><b>No se encontraron ultimas recetas 😅!</b></p>
        @else
        <div id="splide-latest-recipes-horizontal" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($nuevas as $nueva)
                    <li class="splide__slide" style="margin-left: 30px; margin-right: 30px;">
                        <!-- LATEST CARD -->
                        <div class="latest-recipe-card">
                            <div class="background">
                                <img class="image" src="/storage/{{ $nueva->imagen }}" alt="image">
                            </div>
                            <div class="content">
                                <div class="body">
                                    <h5 class="title">{{ Str::words(strip_tags($nueva->titulo), 4)}}</h5>
                                    <h6 class="created_by">
                                        {{ Str::words(strip_tags($nueva->preparacion), 8) }}
                                    </h6>
                                </div>
                                <div class="footer">
                                    <span class="likes"><i class="fas fa-heart"></i><b class="counter">{{ count($nueva->likes) }}</b></span>
                                    <span class="date">{{ date('d-m-Y', strtotime($nueva->created_at)) }}</span>
                                </div>
                            </div>
                            <a class="see-more" href="{{ route('recetas.show', ['receta' => $nueva->id]) }}">
                                <span style="color: white;">Ver 👀</span>
                            </a>
                        </div>
                        <!-- END LATEST CARD -->
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </section>

    <br>
    <br>

    <!-- TODAS LAS RECETAS -->
    <section class="all-categories">
        <h2 class="subtitle"><b>🥰 Todas nuestras recetas</b></h2>
        <hr class="divider" style="margin-top:10px;">

        @if (count($recetas) === 0)
        <p class="alert alert-warning text-center"><b>No se encontró ninguna categoria 😓!</b></p>
        @else
        <!-- SPLIDE HORIZONTAL -->
        <div id="splide-horizontal" class="splide splide-horizontal">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($recetas as $key => $group)
                    <li class="splide__slide" style="margin-left: 30px; margin-right: 30px;">
                        <div class="title-wrapper">
                            <h6 class="title-wrapper__text">{{ str_replace('-', ' ', $key) }}</h6>
                        </div>
                        <!-- SPLIDE VERTICAL -->
                        <div id="splide-vertical-{{ $loop->index }}" class="splide splide-vertical">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($group as $recetas)
                                    @if (count($recetas) == 0)
                                    <li class="splide__slide">
                                        <div class="recipe-card text-center" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                            <span style="font-size: 50px; margin: 10px; color: grey;">😔</span>
                                            <h5>No se encontraron recetas para <br>
                                                <b>{{ str_replace('-', ' ', $key) }}</b>
                                            </h5>
                                        </div>
                                    </li>
                                    @endif
                                    @foreach ($recetas as $receta)
                                    <li class="splide__slide" style="margin-top:20px;">
                                        <!-- RECIPE CARD -->
                                        <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}">
                                            <div class="recipe-card">
                                                <div class="top">
                                                    <div class="left">
                                                        <!-- {{ $receta->url }} -->
                                                        <h5><b>{{ Str::words(strip_tags($receta->titulo), 6) }}</b></h5>
                                                        <h6>Creado por <b>{{ Str::words(strip_tags($receta->autor->name), 2) }}</b></h6>
                                                    </div>
                                                    <div class="right">
                                                        <span class="figure"><i class="fas fa-chevron-right"></i></span>
                                                    </div>
                                                </div>

                                                <div class="body">
                                                    <div class="body__top">
                                                        <p class="steps">
                                                            {{ Str::words(strip_tags($receta->preparacion), 18) }}
                                                        </p>
                                                    </div>
                                                    <div class="body__bottom">
                                                        <!-- LEFT -->
                                                        <div class="left">
                                                            <div class="image">
                                                                <div class="background">
                                                                    <img class="image" src="/storage/{{ $receta->imagen }}" alt="recipe-image">
                                                                </div>
                                                                <div class="content">
                                                                    <i style="color: #E0E0E0" class="fal fa-camera"></i>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- RIGHT -->
                                                        <div class="right">
                                                            @if ($receta->url === null)
                                                            <div class="video video--empty">
                                                                <i class="fal fa-video"></i>
                                                            </div>
                                                            @else
                                                            <div class="video">
                                                                <div class="background">
                                                                    <video-receta-img link={{ $receta->url }}>
                                                                    </video-receta-img>
                                                                </div>
                                                                <div class="content">
                                                                    <i style="color: #E0E0E0" class="fal fa-video"></i>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="bottom">
                                                    <span class="likes"><i class="fas fa-heart"></i>
                                                        <b>{{ count($nueva->likes) }}</b></span>
                                                    <span class="date">{{ date('d-m-Y', strtotime($receta->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- END RECIPE CARD -->
                                    </li>
                                    @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- END SPLIDE VERTICAL -->
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- END SPLIDE HORIZONTAL -->
        @endif
    </section>

</div>
@endsection

@section('scripts')
<script>
    $('.image-link').magnificPopup({
        type: 'image'
    });
</script>
@endsection
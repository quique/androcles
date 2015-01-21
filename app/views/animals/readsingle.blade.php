@extends('layout')

@section('content')

<div class="jumbotron text-center">
    <div class="container">
        <h2>{{{ $title }}}</h2>
    </div>
</div>

@if (count($pics) == 1)
    <div class="jumbotron text-center">
        <img src="{{ asset("images/animalpics/" . $pics->first()->filename) }}" alt="Foto de {{{ $animal->name }}}">
    </div>
@elseif (count($pics) > 0)
<div id="myCarousel" class="container carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($pics); ++$i)
            <li data-target="#myCarousel" data-slide-to="{{ $i }}" {{ $i == 0 ? 'class="active"' : '' }}></li>
        @endfor
    </ol>

    <div class="carousel-inner">
        @foreach($pics as $pic)
            <div class="item {{ $pic == $pics->first() ? 'active' : '' }}">
                <img src="{{ asset("images/animalpics/$pic->filename") }}" class="img-responsive" alt="Foto de {{{ $animal->name }}}">
            </div>
        @endforeach
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
<!-- /.carousel -->
<br style="clear: both;">
@endif

<div class="container col-md-offset-3 col-md-6">
    <div id="fb-root"></div>
    <script type="text/javascript">(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-like" data-href="{{ URL::current() }}" data-send="true" data-width="450" data-show-faces="true"></div><br />

    <p style="margin-top: 20px;">{{ str_replace(["\r\n", "\n", "\r"], '<br />', htmlspecialchars($animal->comments, ENT_QUOTES, 'UTF-8')) }}</p>

    @if ($animal->youtube)
        <!-- The <iframe> (and video player) will replace this <div> tag. -->
        <div id="ytplayer"></div><br /><br />

        <script>
            // Load the IFrame Player API code asynchronously.
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // Replace the 'ytplayer' element with an <iframe> and
            // YouTube player after the API code downloads.
            var player;
            function onYouTubeIframeAPIReady() {
                player = new YT.Player('ytplayer', {
                    height: '390',
                    width: '640',
                    videoId: '{{{$animal->youtube}}}'
                });
            }
        </script>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Datos</h3></div>
        <table class="table">
            <tr><td><strong>Nombre del animal:</strong></td>
                <td>{{{ $animal->name }}}</td></tr>

            <tr><td><strong>Especie:</strong></td>
                <td>{{ $animal->species()->first()->name }}</td></tr>

            <tr><td><strong>Raza:</strong></td>
                <td>{{{ $animal->breed }}}</td></tr>

            <tr><td><strong>Tamaño:</strong></td>
                <td>{{{ $animal->size }}}</td></tr>

            <tr><td><strong>Peso:</strong></td>
                <td>{{{ $animal->weight }}}</td></tr>

            <tr><td><strong>Sexo:</strong></td>
                <td>{{ $animal->sex()->first()->name }}</td></tr>

            <tr><td><strong>Esterilizado:</strong></td>
                <td>{{ $animal->neutered ? 'Sí' : 'No' }}</td></tr>

            <tr><td><strong>Fecha de nacimiento:</strong></td>
                <td>{{ strftime('%d-%m-%Y', strtotime($animal->dateofbirth)) }}</td></tr>

            <tr><td><strong>Fecha de ingreso:</strong></td>
                <td>{{ strftime('%d-%m-%Y', strtotime($animal->dateofarrival)) }}</td></tr>

            <tr><td><strong>Color:</strong></td>
                <td>{{ $animal->color()->first()->name }}</td></tr>

            <tr><td><strong>Pelaje:</strong></td>
                <td>{{ $animal->coat()->first()->description }}</td></tr>

            <tr><td><strong>Situación:</strong></td>
                <td>{{ $animal->status()->first()->name }}</td></tr>
        </table>
    </div>


    <div>
        @if (Sentry::check() and Sentry::getUser()->hasAccess('animals.remove'))
            <a href="{{ action('AnimalsController@delete', $animal->id) }}" class="btn btn-danger">Borrar</a>
        @endif
        @if (Sentry::check() and Sentry::getUser()->hasAccess('animals.edit'))
            <a href="{{ action('AnimalsController@update', $animal->id) }}" class="btn btn-warning">Editar</a>
        @endif
    </div><br><br>
</div>
@stop

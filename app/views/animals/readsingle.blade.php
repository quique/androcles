@extends('layout')

@section('content')

<div class="jumbotron text-center">
    <div class="container">
        <h2>{{{ $title }}}</h2>
    </div>
</div>

@if (count($pics) > 0)
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
    <div class="fb-like" data-href="{{ URL::current() }}" data-send="true" data-width="450" data-show-faces="true"></div><br />

    <p style="margin-top: 20px;">{{ str_replace(["\r\n", "\n", "\r"], '<br />', htmlspecialchars($animal->comments, ENT_QUOTES, 'UTF-8')) }}</p>

    @if ($animal->youtube) 
        <iframe width='640' height='480' src="http://www.youtube.com/embed/$animal->youtube" frameborder='0' allowfullscreen></iframe><br /><br />
    @endif

    <div class="panel panel-default">
        <div class="panel-heading"><h3>Datos</h3></div>
        <table class="table" summary="Ficha de {{{ $animal->name }}}">
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
        <a href="{{ action('AnimalsController@delete', $animal->id) }}" class="btn btn-danger">Borrar</a>
        <a href="{{ action('AnimalsController@update', $animal->id) }}" class="btn btn-warning">Editar</a>
    </div><br><br>
</div>
@stop

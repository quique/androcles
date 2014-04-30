@extends('layout')

@section('content')

<div class="jumbotron text-center">
    <div class="container">
        <h2>{{ $title }}</h2>
    </div>
</div>

<div id="myCarousel" class="carousel slide col-md-offset-3 col-md-6">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <!-- {{ $i = 0 }} -->
        @foreach($animal_pics as $pic)
            <li data-target="#myCarousel" data-slide-to="{{ $i++ }}" {{ $pic == $animal_pics->first() ? 'class="active"' : '' }}></li>
        @endforeach
    </ol>

    <div class="carousel-inner">
        @foreach($animal_pics as $pic)
            <div class="item {{ $pic == $animal_pics->first() ? 'active' : '' }}">
                <img src="/images/animalpics/{{ $pic->filename }}" class="img-responsive" alt="Foto de {{ $animal->name }}">
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

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <p style="margin-top: 20px;">{{ $animal->comments }}</p>

        <div class="panel panel-default">
            <div class="panel-heading"><h3>Datos</h3></div>
            <table class="table" summary="Ficha de {{ $animal->name }}">
                <tr><td><strong>Nombre del animal:</strong></td>
                    <td>{{ $animal->name }}</td></tr>

                <tr><td><strong>Especie:</strong></td>
                    <td>{{ $animal->species()->first()->name }}</td></tr>

                <tr><td><strong>Raza:</strong></td>
                    <td>{{ $animal->breed }}</td></tr>

                <tr><td><strong>Tamaño:</strong></td>
                    <td>{{ $animal->size }}</td></tr>

                <tr><td><strong>Peso:</strong></td>
                    <td>{{ $animal->weight }}</td></tr>

                <tr><td><strong>Sexo:</strong></td>
                    <td>{{ $animal->sex()->first()->name }}</td></tr>

                <tr><td><strong>Esterilizado:</strong></td>
                    <td>{{ $animal->neutered ? 'Sí' : 'No' }}</td></tr>

                <tr><td><strong>Fecha de nacimiento:</strong></td>
                    <td>{{ $animal->dateofbirth }}</td></tr>

                <tr><td><strong>Fecha de ingreso:</strong></td>
                    <td>{{ $animal->dateofarrival }}</td></tr>

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
</div>
@stop

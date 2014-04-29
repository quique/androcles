@extends('layout')

@section('content')

<div class="jumbotron text-center">
    <div class="container">
        <h1>{{ $title }}</h1>
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
            <div class="panel-heading"><h4>Datos</h4></div>
            <table class="table">
                <tr><td><b>Nombre del animal:</b></td>
                    <td>{{ $animal->name }}</td></tr>

                <tr><td><b>Especie:</b></td>
                    <td>{{ $animal->species()->first()->name }}</td></tr>

                <tr><td><b>Raza:</b></td>
                    <td>{{ $animal->breed }}</td></tr>

                <tr><td><b>Tamaño:</b></td>
                    <td>{{ $animal->size }}</td></tr>

                <tr><td><b>Peso:</b></td>
                    <td>{{ $animal->weight }}</td></tr>

                <tr><td><b>Sexo:</b></td>
                    <td>{{ $animal->sex()->first()->name }}</td></tr>

                <tr><td><b>Esterilizado:</b></td>
                    <td>{{ $animal->neutered ? 'Sí' : 'No' }}</td></tr>

                <tr><td><b>Fecha de nacimiento:</b></td>
                    <td>{{ $animal->dateofbirth }}</td></tr>

                <tr><td><b>Fecha de ingreso:</b></td>
                    <td>{{ $animal->dateofarrival }}</td></tr>

                <tr><td><b>Color:</b></td>
                    <td>{{ $animal->color()->first()->name }}</td></tr>

                <tr><td><b>Pelaje:</b></td>
                    <td>{{ $animal->coat()->first()->name }}</td></tr>

                <tr><td><b>Situación:</b></td>
                    <td>{{ $animal->status()->first()->name }}</td></tr>
            </table>
        </div>

    </div>
</div>
@stop

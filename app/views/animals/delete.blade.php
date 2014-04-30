@extends('layout')
@section('content')

<div class="container">
    <section class="section-padding">
        <div class="jumbotron text-center">
            <h2>{{ $title }}</h2>
        </div>

        <h3>¿Seguro que desea borrar {{ $animal->name }}? </h3>
        {{ Form::open(['url'=> '#', 'class'=>'form']) }}
            {{ Form::hidden('id', $animal->id)}}
            <div class="form-group">
                {{ Form::submit('Borrar', ['class' => 'btn btn-danger']) }}
                <a href="{{ action('AnimalsController@readSingle', ['id'=>$animal->id]) }}" class="btn btn-info"> No </a>
            </div>
        {{ Form::close() }}

</section>
</div>
@stop

@extends('layout')
@section('content')

<div class="container">
    <section class="section-padding">
        <div class="page-header">
            <h2>{{ $title }}</h2>
        </div>

        <h3>¿Seguro que desea borrar a {{{ $animal->name }}}? </h3>
        {{ Form::open(['url'=> URL::route('animals.destroy', $animal->id), 'class'=>'form']) }}
            {{ Form::hidden('id', $animal->id)}}
            <div class="form-group">
                {{ Form::submit('Borrar', ['class' => 'btn btn-danger']) }}
                <a href="{{ action('AnimalsController@show', ['id'=>$animal->id]) }}" class="btn btn-info"> No </a>
            </div>
        {{ Form::close() }}

</section>
</div>
@stop

@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="header-text">
                <h1>{{ $title }}</small></h1>
            </div>
        </div>
    </section>

    <div class="container">
    <form action="{{ action('NewsController@handleCreate') }}" enctype="multipart/form-data" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" name="title" placeholder="Título de la noticia" value="{{ Input::old('title') }}" />
            @if($errors->has('title'))
                <p class="text-danger">Verifique este campo.</p>
            @endif
        </div>
        <div class="form-group">
            <label for="body">Cuerpo</label>
            <textarea class="form-control" rows="6" name="body" placeholder="Cuerpo de la noticia">{{ Input::old('body') }}</textarea>
            @if($errors->has('body'))
                <p class="text-danger">Verifique este campo.</p>
            @endif
        </div>
        <div class="form-group">
            <label for="photo">Imagen</label>
            <input type="file" name="photo" id="photo" />
            <p class="help-block">Formato: JPEG.</p>
        </div>
        
        <a href="{{ action('NewsController@index') }}" class="btn btn-danger">Cancelar</a>
        <button type="reset" class="btn btn-warning">Borrar</button>
        <input type="submit" value="Publicar" class="btn btn-success" />
    </form>
    </div>
@stop

@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="header-text">
                <h1>{{ $title }}</h1>
            </div>
        </div>
    </section>

    <div class="container">
    <form action="{{ action('NewsController@handleEdit') }}" enctype="multipart/form-data" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $news->id }}">
        
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" name="title" placeholder="Título de la noticia" value="{{{ $news->title }}}" />
            @if($errors->has('title'))
                <p class="text-danger">Verifique este campo.</p>
            @endif
        </div>
        
        <div class="form-group">
            <label for="body">Cuerpo</label>
            <textarea class="form-control" rows="6" name="body" placeholder="Cuerpo de la noticia">{{{ $news->body }}}</textarea>
            @if($errors->has('body'))
                <p class="text-danger">Verifique este campo.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="photo">Imagen</label>
            <input type="file" name="photo" id="photo" />
            <p class="help-block">Formato: JPEG.</p>
        </div>
        
        @if (count($pics) > 0)
            @foreach ($pics as $pic)
                <div class="form-group">
                <input name="picstodelete[]" type="checkbox" value='{{ $pic->id }}'>
                <label for="picstodelete[]">Eliminar</label>
                <img src='{{ asset("images/newsthumbs/$pic->filename") }}' alt="Imagen de la noticia" />
                </div>
            @endforeach
        @endif

        <a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
        <button type="reset" class="btn btn-warning">Deshacer</button>
        <input type="submit" value="Guardar" class="btn btn-success" />
        
    </form>
    </div>
@stop

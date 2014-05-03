@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="header-text">
                <h1>Eliminación de noticia</small></h1>
            </div>
        </div>
    </section>

    <div class="container">
        <p>¿Seguro que desea eliminar la noticia «{{{ $news->title }}}»?</p>

        <form action="{{ action('NewsController@handleDelete') }}" method="post" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="news" value="{{ $news->id }}" />
            <input type="submit" class="btn btn-danger" value="Eliminar" />
            <a href="{{ URL::previous() }}" class="btn btn-info">No</a>
        </form>
    </div>
@stop

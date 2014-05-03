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
        <div class="pull-right">
            <a href="{{ action('NewsController@create') }}" class="btn btn-primary">Crear noticia</a>
        </div>

        @if ($news->isEmpty())
            <p>Todavía no hay ninguna noticia :(</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Título</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                        <tr>
                            <td>{{ strftime('%d-%m-%Y', strtotime($item->created_at)) }}</td>
                            <td><a href="{{ action('NewsController@show', $item->id) }}">{{{ $item->title }}}</a></td>
                            <td>
                                <a href="{{ action('NewsController@delete', $item->id) }}" class="btn btn-danger">Eliminar</a>
                                <a href="{{ action('NewsController@edit', $item->id) }}" class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@stop

@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="header-text">
                <h1>{{ trans($title) }}</h1>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="pull-right">
            <a href="{{ action('NewsController@create') }}" class="btn btn-primary">{{ trans('news.create') }}</a>
        </div>

        @if ($news->isEmpty())
            <p>{{ trans("news.no-news") }}</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('news.date') }}</th>
                        <th>{{ trans('news.title') }}</th>
                        <th>{{ trans('news.admin') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                        <tr>
                            <td>{{ strftime('%d-%m-%Y', strtotime($item->created_at)) }}</td>
                            <td><a href="{{ action('NewsController@show', $item->id) }}">{{{ $item->title }}}</a></td>
                            <td>
                                <a href="{{ action('NewsController@delete', $item->id) }}" class="btn btn-danger">{{ trans('news.remove') }}</a>
                                <a href="{{ action('NewsController@edit', $item->id) }}" class="btn btn-warning">{{ trans('news.edit') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@stop

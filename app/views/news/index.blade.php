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
        @if (Sentry::check() and Sentry::getUser()->hasAccess('news.create'))
            <div class="pull-right">
                <a href="{{ action('NewsController@create') }}" class="btn btn-primary">{{ trans('news.create') }}</a>
            </div>
        @endif

        @if ($news->isEmpty())
            <p>{{ trans("news.no-news") }}</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('news.date') }}</th>
                        <th>{{ trans('news.title') }}</th>
                        @if (Sentry::check() and (Sentry::getUser()->hasAccess('news.edit') or Sentry::getUser()->hasAccess('news.remove')))
                            <th>{{ trans('news.admin') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                        <tr>
                            <td>{{ strftime('%d-%m-%Y', strtotime($item->created_at)) }}</td>
                            <td>{{ HTML::linkRoute('news.show', $item->title, [$item->id]) }}</td>

                            <td>
                                @if (Sentry::check() and Sentry::getUser()->hasAccess('news.remove'))
                                    <a href="{{ action('NewsController@delete', $item->id) }}" class="btn btn-danger">{{ trans('news.remove') }}</a>
                                @endif
                                @if (Sentry::check() and Sentry::getUser()->hasAccess('news.edit'))
                                    <a href="{{ action('NewsController@edit', $item->id) }}" class="btn btn-warning">{{ trans('news.edit') }}</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@stop

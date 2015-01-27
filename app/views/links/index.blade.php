@extends('layout')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>{{ trans($title) }}</h1>
        </div>

        @if (Sentry::check() and Sentry::getUser()->hasAccess('links.create'))
            <div class="pull-right">
                <a href="{{ action('LinksController@create') }}" class="btn btn-primary">{{ trans('links.create') }}</a>
            </div>
            <br style="clear: both;">
        @endif

        @if ($links->isEmpty())
            <p>{{ trans("links.no-links") }}</p>
        @else
            <dl>
                @foreach($links as $item)
                    <dt><a href="{{ $item->url }}">{{{ $item->name }}}</a></dt>
                    <dd>{{{ $item->description }}} <br>
                        @if (Sentry::check())
                            @if (Sentry::getUser()->hasAccess('links.delete'))
                                <a href="{{ action('LinksController@delete', $item->id) }}" class="btn btn-danger">{{ trans('links.remove') }}</a>
                            @endif
                            @if (Sentry::getUser()->hasAccess('links.edit'))
                                <a href="{{ action('LinksController@edit', $item->id) }}" class="btn btn-warning">{{ trans('links.edit') }}</a>
                            @endif
                            <br>
                        @endif
                        <br>
                    </dd>
                @endforeach
            </dl>
        @endif
    </div>
@stop

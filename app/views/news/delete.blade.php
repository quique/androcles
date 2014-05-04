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
        <p>{{{ trans('news.sure', ['title' => $news->title]) }}}</p>

        <form action="{{ action('NewsController@handleDelete') }}" method="post" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="news" value="{{ $news->id }}" />
            <input type="submit" class="btn btn-danger" value="{{ trans('news.remove') }}" />
            <a href="{{ URL::previous() }}" class="btn btn-info">{{ trans('news.no') }}</a>
        </form>
    </div>
@stop

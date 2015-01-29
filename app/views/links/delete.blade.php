@extends('layout')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>{{ trans($title) }}</h1>
        </div>

        <p>{{{ trans('links.sure', ['name' => $link->name]) }}}</p>

        <form action="{{ action('LinksController@destroy', $link->id) }}" method="post" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="link" value="{{ $link->id }}" />
            <input type="submit" class="btn btn-danger" value="{{ trans('links.remove') }}" />
            <a href="{{ URL::previous() }}" class="btn btn-info">{{ trans('links.no') }}</a>
        </form>
    </div>
@stop

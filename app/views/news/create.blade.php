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
    <form action="{{ action('NewsController@handleCreate') }}" enctype="multipart/form-data" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="title">{{ trans('news.title') }}</label>
            <input type="text" class="form-control" name="title" placeholder="{{ trans('news.news-title') }}" value="{{{ Input::old('title') }}}" />
            @if($errors->has('title'))
                <p class="text-danger">{{ $errors->get('title')[0] }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="body">{{ trans('news.body') }}</label>
            <textarea class="form-control" rows="6" name="body" placeholder="{{ trans('news.news-body') }}">{{{ Input::old('body') }}}</textarea>
            {{ $errors->first('body', '<p class="text-danger">:message</p>') }}
        </div>
        
        <div class="form-group">
            <label for="photo">{{ trans('news.image') }}</label>
            <input type="file" name="photo" id="photo" />
            <p class="help-block">{{ trans('news.format') }}</p>
        </div>
        
        <a href="{{ action('NewsController@index') }}" class="btn btn-danger">{{ trans('news.cancel') }}</a>
        <button type="reset" class="btn btn-warning">{{ trans('news.clean') }}</button>
        <input type="submit" value="{{ trans('news.publish') }}" class="btn btn-success" />
    </form>
    </div>
@stop

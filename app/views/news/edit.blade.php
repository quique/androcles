@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="page-header">
                <h1>{{ trans($title) }}</h1>
            </div>
        </div>
    </section>

    <div class="container">
    <form action="{{ action('NewsController@handleEdit') }}" enctype="multipart/form-data" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $news->id }}">

        <div class="form-group">
            <label for="title">{{ trans('news.title') }}</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="{{ trans('news.news-title') }}" value="{{{ $news->title }}}" />
            @if($errors->has('title'))
                <p class="text-danger">{{ $errors->get('title')[0] }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="body">{{ trans('news.body') }}</label>
            <textarea class="form-control" rows="6" name="body" id="body" placeholder="{{ trans('news.news-body') }}">{{{ $news->body }}}</textarea>
            {{ $errors->first('body', '<p class="text-danger">:message</p>') }}
        </div>

        <div class="form-group">
            <label for="photo">{{ trans('news.image') }}</label>
            <input type="file" name="photo" id="photo" />
            <p class="help-block">{{ trans('news.format') }}</p>
        </div>

        @if (count($pics) > 0)
            @foreach ($pics as $pic)
                <div class="form-group">
                <input name="picstodelete[]" type="checkbox" value='{{ $pic->id }}'>
                <label for="picstodelete[]">{{ trans('news.remove') }}</label>
                <img src='{{ asset("images/newsthumbs/$pic->filename") }}' alt="{{ trans('news.image') }}" />
                </div>
            @endforeach
        @endif

        <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('news.cancel') }}</a>
        <button type="reset" class="btn btn-warning">{{ trans('news.reset') }}</button>
        <input type="submit" value="{{ trans('news.save') }}" class="btn btn-success" />

    </form>
    </div>
@stop

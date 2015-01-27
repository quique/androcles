@extends('layout')

@section('content')

<div class="container">
    <div class="page-header">
        <h1>{{ trans($title) }}</h1>
    </div>

    <form action="{{ URL::route('links.update', $link->id) }}" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $link->id }}">

        <div class="form-group">
            <label for="name">{{ trans('links.name') }}</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="{{ trans('links.link-name') }}" value="{{{ $link->name }}}" required />
            @if($errors->has('name'))
                <p class="text-danger">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="url">{{ trans('links.url') }}</label>
            <input type="text" class="form-control" name="url" id="url" placeholder="{{ trans('links.link-url') }}" value="{{{ $link->url }}}" required />
            @if($errors->has('url'))
                <p class="text-danger">{{ $errors->first('url') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="description">{{ trans('links.description') }}</label>
            <textarea class="form-control" rows="6" name="description" id="description" placeholder="{{ trans('links.link-description') }}">{{{ $link->description }}}</textarea>
            {{ $errors->first('description', '<p class="text-danger">:message</p>') }}
        </div>

        <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('links.cancel') }}</a>
        <button type="reset" class="btn btn-warning">{{ trans('links.reset') }}</button>
        <input type="submit" value="{{ trans('links.save') }}" class="btn btn-success" />
    </form>
</div>
@stop

@extends('layout')

@section('content')

<div class="container">
    <div class="page-header">
        <h1>{{ trans($title) }}</h1>
    </div>

    <form action="{{ URL::route('volunteers.update', $volunteer->id) }}" enctype="multipart/form-data"  method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $volunteer->id }}">

        <div class="form-group">
            <label for="alias">{{ trans('volunteers.alias') }}</label>
            <input type="text" class="form-control" name="alias" id="alias" placeholder="{{ trans('volunteers.alias-long') }}" value="{{{ $volunteer->alias }}}" required />
            @if ($errors->has('alias'))
                <p class="text-danger">{{ $errors->first('alias') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="task">{{ trans('volunteers.task') }}</label>
            <input type="text" class="form-control" name="task" id="task" placeholder="{{ trans('volunteers.task-long') }}" value="{{{ $volunteer->task }}}" />
            @if ($errors->has('task'))
                <p class="text-danger">{{ $errors->first('task') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="description">{{ trans('volunteers.description') }}</label>
            <textarea class="form-control" rows="6" name="description" id="description" placeholder="{{ trans('volunteers.description-long') }}" required>{{{ $volunteer->description }}}</textarea>
            {{ $errors->first('description', '<p class="text-danger">:message</p>') }}
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    @if ($volunteer->publish)
                        <input type="checkbox" name="publish" id="publish" value="publish" checked>
                    @else
                        <input type="checkbox" name="publish" id="publish" value="publish">
                    @endif
                    <strong>{{ trans('volunteers.publish') }}</strong>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="photo">{{ trans('volunteers.photo') }}</label>
            <input type="file" name="photo" id="photo" />
            <p class="help-block">{{ trans('volunteers.format') }}</p>
        </div>

        <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('volunteers.cancel') }}</a>
        <button type="reset" class="btn btn-warning">{{ trans('volunteers.reset') }}</button>
        <input type="submit" value="{{ trans('volunteers.save') }}" class="btn btn-success" />
    </form>
</div>
@stop

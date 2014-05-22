@extends('layout')

@section('content')

<div class="container">

    <div class="page-header">
        <h1>{{ trans($title) }}</h1>
    </div>

    <form action="{{ URL::route('users.update', $user->id) }}" method="post" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $user->id }}">

        <div class="form-group">
            <label for="first_name" class="col-sm-1 control-label">{{ trans('users.first-name') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="{{ trans('users.first-name') }}" value="{{{ $user->first_name }}}" required />
            </div>
            @if($errors->has('first_name'))
                <p class="text-danger">{{ $errors->first('first_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="last_name" class="col-sm-1 control-label">{{ trans('users.last-name') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="{{ trans('users.last-name') }}" value="{{{ $user->last_name }}}" />
                </div>
            @if($errors->has('last_name'))
                <p class="text-danger">{{ $errors->first('last_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-1 control-label">{{ trans('users.email') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="email" id="email" placeholder="{{ trans('users.user-email') }}" value="{{{ $user->email }}}" required />
            </div>
            @if($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-11">
                <div class="checkbox">
                    <label>
                        @if ($user->inGroup(Sentry::getGroupProvider()->findByName('Editors')))
                            <input type="checkbox" name="editor" id="editor" value="editor" checked>
                        @else
                            <input type="checkbox" name="editor" id="editor" value="editor">
                        @endif
                        {{ trans('users.editor') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-offset-1">
            <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('users.cancel') }}</a>
            <button type="reset" class="btn btn-warning">{{ trans('users.reset') }}</button>
            <input type="submit" value="{{ trans('users.save') }}" class="btn btn-success" />
        </div>
    </form>
</div>
@stop

@extends('layout')

@section('content')

<div class="container">

    <div class="page-header">
        <h1>{{ trans($title) }}</h1>
    </div>

    <form action="{{ URL::route('users.passwd', $user) }}" method="post" class="form-horizontal" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $user }}">

        <div class="form-group">
            <label for="current_password" class="col-sm-2 control-label">{{ trans('users.current-password') }}:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="{{ trans('users.current-password') }}" required />
            </div>
            @if($errors->has('current_password'))
                <p class="text-danger">{{ trans($errors->first('current_password')) }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="new_password" class="col-sm-2 control-label">{{ trans('users.new-password') }}:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="{{ trans('users.new-password') }}" required />
            </div>
            @if($errors->has('new_password'))
                <p class="text-danger">{{ trans($errors->first('new_password')) }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="new_password_confirmation" class="col-sm-2 control-label">{{ trans('users.new-password') }}:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="{{ trans('users.new-password') }}" required />
            </div>
            @if($errors->has('new_password_confirmation'))
                <p class="text-danger">{{ trans($errors->first('new_password_confirmation')) }}</p>
            @endif
        </div>

        <div class="col-sm-offset-2">
            <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('users.cancel') }}</a>
            <button type="reset" class="btn btn-warning">{{ trans('users.clean') }}</button>
            <input type="submit" value="{{ trans('users.save') }}" class="btn btn-success" />
        </div>
    </form>

</div>
@stop

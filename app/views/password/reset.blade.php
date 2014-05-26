@extends('layout')

@section('content')

<!-- {{ $title = "users.password-reset" }} -->
<div class="container">

    <div class="page-header">
        <h1>{{ trans($title) }}</h1>
    </div>

<form action="{{ action('RemindersController@postReset') }}" method="POST" class="form-horizontal" role="form">
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">{{ trans('users.email') }}:</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="email" id="email" placeholder="{{ trans('users.user-email') }}" required />
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">{{ trans('users.new-password') }}:</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" name="password" id="password" placeholder="{{ trans('users.new-password') }}" required />
        </div>
    </div>

    <div class="form-group">
        <label for="password_confirmation" class="col-sm-2 control-label">{{ trans('users.new-password') }}:</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ trans('users.new-password') }}" required />
        </div>
    </div>

    <div class="col-sm-offset-2">
        <button type="reset" class="btn btn-warning">{{ trans('users.clean') }}</button>
        <input type="submit" value="{{ trans('users.save') }}" class="btn btn-success" />
    </div>
</form>

</div>
@stop

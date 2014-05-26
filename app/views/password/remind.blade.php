@extends('layout')

@section('content')

<!-- {{ $title = "users.password-reset" }} -->
<div class="container">

    <div class="page-header">
        <h1>{{ trans($title) }}</h1>
    </div>

<form action="{{ action('RemindersController@postRemind') }}" method="POST" class="form-horizontal" role="form">

    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">{{ trans('users.email') }}</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="email" id="email" placeholder="{{ trans('users.user-email') }}" required />
        </div>
    </div>

    <div class="col-sm-offset-2">
        <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('users.cancel') }}</a>
        <button type="reset" class="btn btn-warning">{{ trans('users.clean') }}</button>
        <input type="submit" value="{{ trans('users.send') }}" class="btn btn-success" />
    </div>
</form>

</div>
@stop

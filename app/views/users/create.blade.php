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
    <form action="{{ action('UsersController@store') }}" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="first_name">{{ trans('users.first-name') }}</label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="{{ trans('users.first-name') }}" value="{{{ Input::old('first_name') }}}" required />
            @if($errors->has('first_name'))
                <p class="text-danger">{{ $errors->first('first_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="last_name">{{ trans('users.last-name') }}</label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="{{ trans('users.last-name') }}" value="{{{ Input::old('last_name') }}}" />
            @if($errors->has('last_name'))
                <p class="text-danger">{{ $errors->first('last_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="email">{{ trans('users.email') }}</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="{{ trans('users.user-email') }}" value="{{{ Input::old('email') }}}" required />
            @if($errors->has('email'))
                <p class="text-danger">{{ trans($errors->first('email')) }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="password">{{ trans('users.password') }}</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="{{ trans('users.user-password') }}" required />
            @if($errors->has('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation">{{ trans('users.password-confirmation') }}</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="{{ trans('users.user-password') }}" required />
            @if($errors->has('password_confirmation'))
                <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
            @endif
        </div>


        <a href="{{ action('UsersController@index') }}" class="btn btn-danger">{{ trans('users.cancel') }}</a>
        <button type="reset" class="btn btn-warning">{{ trans('users.clean') }}</button>
        <input type="submit" value="{{ trans('users.create') }}" class="btn btn-success" />
    </form>
    </div>
@stop

@extends('layout')

@section('content')


<div class="container">

    <form action="#" method="post" class="form-signin" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <h2 class="form-signin-heading">{{ trans('users.sign-in') }}</h2>

        @if ($errors->has('login'))
            <div class="alert alert-error">{{ trans($errors->first('login', ':message')) }}</div>
        @endif

        <input type="email" class="form-control" name="email" id="email" placeholder="{{ trans('users.e-mail') }}" required autofocus>
        <input type="password" class="form-control" name="password" id="password" placeholder="{{ trans('users.password') }}" required>
        <label class="checkbox">
            <input type="checkbox" name="remember_me" id="remember_me" value="remember_me"> {{ trans('users.remember-me') }}
        </label>

        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ trans('users.log-in') }}</button>
    </form>

</div> <!-- /container -->


@stop

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
    <form action="{{ URL::route('users.update', $user->id) }}" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $user->id }}">

        <div class="form-group">
            <label for="first_name">{{ trans('users.first-name') }}</label>
            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="{{ trans('users.first-name') }}" value="{{{ $user->first_name }}}" required />
            @if($errors->has('first_name'))
                <p class="text-danger">{{ $errors->first('first_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="last_name">{{ trans('users.last-name') }}</label>
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="{{ trans('users.last-name') }}" value="{{{ $user->last_name }}}" />
            @if($errors->has('last_name'))
                <p class="text-danger">{{ $errors->first('last_name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="email">{{ trans('users.email') }}</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="{{ trans('users.user-email') }}" value="{{{ $user->email }}}" required />
            @if($errors->has('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('users.cancel') }}</a>
        <button type="reset" class="btn btn-warning">{{ trans('users.reset') }}</button>
        <input type="submit" value="{{ trans('users.save') }}" class="btn btn-success" />
    </form>
    </div>
@stop

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
        <p>{{{ trans('users.sure', ['email' => $user->email]) }}}</p>

        <form action="{{ action('UsersController@destroy', $user->id) }}" method="post" role="form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user" value="{{ $user->id }}" />
            <input type="submit" class="btn btn-danger" value="{{ trans('users.delete') }}" />
            <a href="{{ URL::previous() }}" class="btn btn-info">{{ trans('users.no') }}</a>
        </form>
    </div>
@stop

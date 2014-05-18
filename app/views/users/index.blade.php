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
        <div class="pull-right">
            <a href="{{ action('UsersController@create') }}" class="btn btn-primary">{{ trans('users.create') }}</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>{{ trans('users.first-name') }}</th>
                    <th>{{ trans('users.last-name') }}</th>
                    <th>{{ trans('users.email') }}</th>
                    <th>{{ trans('users.admin') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ action('UsersController@delete', $user->id) }}" class="btn btn-danger">{{ trans('users.delete') }}</a>
                            <a href="{{ action('UsersController@edit', $user->id) }}" class="btn btn-warning">{{ trans('users.edit') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@stop

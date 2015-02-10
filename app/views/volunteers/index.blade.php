@extends('layout')

@section('content')

    <div class="container">
        <div class="page-header">
            <h1>{{ trans($title) }}</h1>
        </div>

        @if ($volunteers->isEmpty())
            <p>{{ trans("volunteers.no-volunteers") }}</p>
        @else
            <dl>
                @foreach($volunteers as $volunteer)
                    <div class="page-header">
                        <h2><a href="{{ action('VolunteersController@show', $volunteer->id) }}">{{{ $volunteer->alias }}}</a> <small>{{{ $volunteer->task }}}</small></h2>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="{{ action('VolunteersController@show', $volunteer->id) }}">
                            <img src="{{ asset("/images/volunteerthumbs/".$volunteer->photo) }}" alt="{{ trans('volunteers.photo') }}"></a>
                        </div>
                    </div>

                    <div class="col-sm-8 col-lg-8 col-md-8">
                        <p>{{{ mb_substr($volunteer->description, 0, 900) }}}</p>
                    </div>

                    <p class="thumbfooter"><a href="{{ action('VolunteersController@show', $volunteer->id) }}">{{ trans('volunteers.more') }}</a></p>
                @endforeach
            </dl>
        @endif
    </div>
@stop

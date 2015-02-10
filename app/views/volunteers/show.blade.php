@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="page-header">
                <h1>{{{ $volunteer->alias }}} <small>{{{ $volunteer->task }}}</small></h1>
            </div>
        </div>
    </section>

    <div class="container">

        <div class="jumbotron text-center">
            <img src="{{ asset("images/volunteers/" . $volunteer->photo) }}" alt="{{ trans('volunteers.photo') }}">
        </div>

        <div class="container col-md-offset-2 col-md-8">
            <div id="fb-root"></div>
            <script type="text/javascript">(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-like" data-href="{{ URL::current() }}" data-send="true" data-width="450" data-show-faces="true"></div><br />

            <p style="margin-top: 20px; margin-bottom: 15px;">
                {{ str_replace(["\r\n", "\n", "\r"], '<br />', htmlspecialchars($volunteer->description, ENT_QUOTES, 'UTF-8')) }}
            </p>

            @if (Sentry::check() and Sentry::getUser()->id == $volunteer->id)
                <div style="margin-bottom: 20px;">
                    <a href="{{ action('VolunteersController@edit', $volunteer->id) }}" class="btn btn-warning">{{ trans('volunteers.edit') }}</a>
                </div>
            @endif
        </div>
    </div>
@stop

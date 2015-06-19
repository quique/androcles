@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="page-header">
                <img src="{{ asset('/images/logo_header.jpg') }}" style="max-width: 100%; height: auto; width: auto\9;" alt="<h1>{{ $shelter }} <small>{{ $motto }}</small></h1>">
            </div>
        </div>
    </section>

    <div class="container" style="text-align: right;">
        <a target="_blank" title="Síguenos en Facebook" href="https://www.facebook.com/pages/SPA-Amigo-Mio-de-Teruel/430114683706346"><img alt="Síguenos en Facebook" src="https://c866088.ssl.cf3.rackcdn.com/assets/facebook40x40.png" width="25" height="25" style="margin-top: -20px;"></a>&nbsp; &nbsp;

        <a href="https://twitter.com/AmigoMioProte" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="false">Seguir a @AmigoMioProte</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </div>

    <div class="container">
        @if (!$news->isEmpty())
            <div class="page-header">
                <h2>{{ trans('home.news') }}</h2>
            </div>

            @foreach($news as $piece)
                @if (!$piece->pic)
                    <!-- {{ $piece->pic = 'nopic.jpg' }} -->
                @endif
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <a href="{{ action('NewsController@show', $piece->id) }}">
                            <img src="{{ asset("/images/newsthumbs/".$piece->pic) }}"
                            alt="{{ trans('home.image') }}"></a>
                        <div class="caption">
                            <h3><a href="{{ action('NewsController@show', $piece->id) }}">{{{ $piece->title }}}</a></h3>
                            <p>{{{ $piece->body }}}</p>
                        </div>
                    </div>
                    <p class="thumbfooter"><a href="{{ action('NewsController@show', $piece->id) }}">{{ trans('home.more') }}</a></p>
                </div>
            @endforeach
        @endif
        <br style="clear: both;">


        @if (!$arrivals->isEmpty())
            <div class="page-header">
                <h2>{{ trans('home.arrivals') }}</h2>
            </div>

            @foreach($arrivals as $animal)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <a href="{{ action('AnimalsController@show', $animal->id) }}">
                            <img src="{{ asset("/images/animalthumbs/".$animal->pic) }}"
                            alt="Foto de {{{ $animal->name }}}"></a>
                        <div class="caption">
                            <p class="pull-right"><span style="font-size: 32px;">
                                @if ($animal->sex_id == 1)
                                    &#9794;
                                @elseif ($animal->sex_id == 3)
                                    &#9792;
                                @endif
                            </span></p>
                            <h3><a href="{{ action('AnimalsController@show', $animal->id) }}">{{{ $animal->name }}}</a></h3>
                            <p>{{{ $animal->comments }}}</p>
                        </div>
                    </div>
                    <p class="thumbfooter"><a href="{{ action('AnimalsController@show', $animal->id) }}">{{ trans('home.more') }}</a></p>
                </div>
            @endforeach
        @endif
        <br style="clear: both;">


        @if (!$adoptions->isEmpty())
            <div class="page-header">
                <h2>{{ trans('home.adoptions') }}</h2>
            </div>

            @foreach($adoptions as $animal)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <a href="{{ action('AnimalsController@show', $animal->id) }}">
                            <img src="{{ asset("/images/animalthumbs/".$animal->pic) }}"
                            alt="Foto de {{{ $animal->name }}}"></a>
                        <div class="caption">
                            <p class="pull-right"><span style="font-size: 32px;">
                                @if ($animal->sex_id == 1)
                                    &#9794;
                                @elseif ($animal->sex_id == 3)
                                    &#9792;
                                @endif
                            </span></p>
                            <h3><a href="{{ action('AnimalsController@show', $animal->id) }}">{{{ $animal->name }}}</a></h3>
                            <p>{{{ $animal->comments }}}</p>
                        </div>
                    </div>
                    <p class="thumbfooter"><a href="{{ action('AnimalsController@show', $animal->id) }}">{{ trans('home.more') }}</a></p>
                </div>
            @endforeach
        @endif
        <br style="clear: both;">

    </div>
@stop

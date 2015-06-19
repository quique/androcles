@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="page-header">
                <h1>{{{ $title }}}</h1>
            </div>
        </div>
    </section>

    <div class="container">
        @if (count($pics) == 1)
            <div class="jumbotron text-center">
                <img src="{{ asset("images/newspics/" . $pics->first()->filename) }}" alt="{{ trans('news.image') }}">
            </div>
        @elseif (count($pics) > 0)
        <div id="myCarousel" class="carousel slide">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @for ($i = 0; $i < count($pics); ++$i)
                    <li data-target="#myCarousel" data-slide-to="{{ $i }}" {{ $i == 0 ? 'class="active"' : '' }}></li>
                @endfor
            </ol>

            <div class="carousel-inner">
                @foreach($pics as $pic)
                    <div class="item {{ $pic == $pics->first() ? 'active' : '' }}">
                        <img src="{{ asset("images/newspics/$pic->filename") }}" class="img-responsive" alt="{{ trans('news.image') }}">
                    </div>
                @endforeach
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
        <!-- /.carousel -->
        @endif

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
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="AmigoMioProte" data-size="large">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <br />

            <p style="margin-top: 20px; margin-bottom: 15px;">
                {{ str_replace(["\r\n", "\n", "\r"], '<br />', htmlspecialchars($news->body, ENT_QUOTES, 'UTF-8')) }}
            </p>

            @if (Sentry::check())
                <div style="margin-bottom: 20px;">
                    @if (Sentry::getUser()->hasAccess('news.delete'))
                        <a href="{{ action('NewsController@delete', $news->id) }}" class="btn btn-danger">{{ trans('news.remove') }}</a>
                    @endif
                    @if (Sentry::getUser()->hasAccess('news.edit'))
                        <a href="{{ action('NewsController@edit', $news->id) }}" class="btn btn-warning">{{ trans('news.edit') }}</a>
                    @endif
                </div>
            @endif
        </div>
    </div>
@stop

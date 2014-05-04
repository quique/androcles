@extends('layout')

@section('content')
    <section class="header section-padding">
        <div class="container">
            <div class="header-text">
                <h1>{{{ $title }}}</h1>
            </div>
        </div>
    </section>

    <div class="container">
        @if (count($pics) > 0)
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

        {{ str_replace(["\r\n", "\n", "\r"], '<br />', htmlspecialchars($news->body, ENT_QUOTES, 'UTF-8')) }}

        <br><br><div>
            <a href="{{ action('NewsController@delete', $news->id) }}" class="btn btn-danger">{{ trans('news.remove') }}</a>
            <a href="{{ action('NewsController@edit', $news->id) }}" class="btn btn-warning">{{ trans('news.edit') }}</a>
        </div>
    </div>
@stop

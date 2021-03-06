@extends('layout')
@section('content')

<div class="container">
    <section class="section-padding">
        <div class="page-header">
            <h2>{{ trans($title) }}</h2>
        </div>

        @if ($animals->isEmpty())
            <p>Actualmente no hay ningún animal de esas características.</p>
        @else
            <!-- {{ $i = 1; }} -->
            @foreach($animals as $animal)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <a href={{ action('AnimalsController@show', $animal->id) }}>
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
                            <h3><a href={{ action('AnimalsController@show', $animal->id) }}>{{{ $animal->name }}}</a></h3>
                            <p>{{{ $animal->comments }}}</p>
                        </div>
                    </div>
                    <p class="thumbfooter"><a href={{ action('AnimalsController@show', $animal->id) }}>Sigue leyendo</a></p>
                </div>
                @if ($i++ % 3 == 0)
                    <br style="clear: both;">
                @endif
            @endforeach
        @endif
    </section>
</div>
@stop

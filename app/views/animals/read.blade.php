@extends('layout')
@section('content')

<div class="container">
    <section class="section-padding">
        <div class="jumbotron text-center">
            <h1>{{ $title }}</h1>
        </div>

        @if ($animals->isEmpty())
            <p>Actualmente no hay ningún animal de esas características.</p>
        @else
            <!-- {{ $i = 1; }} -->
            @foreach($animals as $animal)
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <!-- {{ $pic = $animal->animal_pics()->orderBy(DB::raw('RAND()'))->first() }} -->
                        @if ($pic)
                        <a href={{ url('/animals/'.$animal->id) }}><img src={{ url('/images/animalthumbs/'. $pic->filename) }} alt="Foto de {{ $animal->name }}"></a>
                        @endif
                        <div class="caption">
                            <p class="pull-right"><span style="font-size: 32px;">
                            @if ($animal->sex_id == 1)
                                &#9794;
                            @elseif ($animal->sex_id == 3)
                                &#9792;
                            @endif
                            </span></p>
                            <h4><a href={{ url('/animals/'.$animal->id) }}>{{ $animal->name }}</a></h4>
                            <p>{{ $animal->comments }}</p>
                        </div>
                    </div>
                    <p class="thumbfooter"><a href={{ url('/animals/'.$animal->id) }}>Sigue leyendo</a></p>
                </div>
                @if ($i++ % 3 == 0)
                    <br style="clear: both;">
                @endif
            @endforeach
        @endif
</section>
</div>
@stop

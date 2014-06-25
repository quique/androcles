@extends('layout')

@section('content')

<section class="header section-padding">
    <div class="background">&nbsp;</div>
    <div class="container">
        <div class="header-text">
            <h1>Androcles <small>{{ trans('layout.motto') }}</small></h1>
        </div>
    </div>
</section>

<div class="container">
    <section class="section-padding">
        <div class="jumbotron text-center">
            <img src="images/androcles_logo.jpg" alt="Logo">
        </div>
    </section>
</div>

@stop

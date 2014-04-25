@extends('layout')
@section('content')

<div class="container">
    <section class="section-padding">
        <div class="jumbotron text-center">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>List of all animals</h1>
                </div>

                @if ($animals->isEmpty())
                    <p>Currently, there is no animal!</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Species</th>
                                <th>Neutered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($animals as $animal)
                                <tr>
                                    <td>{{ $animal->id }} </td>
                                    <td>{{ $animal->name }}</td>
                                    <td>{{ $animal->species_id}}</td>
                                    <td>{{ $animal->neutered ? 'Yes' : 'No'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </section>
</div>
@stop

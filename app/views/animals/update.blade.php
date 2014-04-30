@extends('layout')
@section('content')

<div class="container">
    <div class="page-header">
        <h1>{{ $title }}</h1>
    </div>


    {{ Form::open(['url'=> '#', 'class'=>'form-horizontal', 'files' => true]) }}
        {{ Form::hidden('id', $animal->id) }}

        <div class="form-group">
            {{ Form::label('name', 'Nombre del animal:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-4">{{ Form::text('name', $animal->name, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('species_id', 'Especie:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::select('species_id', $species, $animal->species_id, ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('breed', 'Raza:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-4">{{ Form::text('breed', $animal->breed, ['class' => 'form-control', 'placeholder' => 'Raza(s)']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('size', 'Tamaño:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-4">{{ Form::text('size', $animal->size, ['class' => 'form-control', 'placeholder' => 'Tamaño']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('weight', 'Peso:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-4">{{ Form::text('weight', $animal->weight, ['class' => 'form-control', 'placeholder' => 'Peso aproximado']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('sex_id', 'Sexo:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::select('sex_id', $sexes, $animal->sex_id, ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('neutered', 'Esterilizado:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::select('neutered', ['0' => 'No', '1' => 'Sí', NULL => 'Desconocido'], $animal->neutered) }}
            </div>
        </div>

        {{ HTML::script('js/jquery.ui.datepicker-es.js') }}

        <div class="form-group">
            {{ Form::label('dateofbirth', 'Fecha de nacimiento:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::text('dateofbirth', $animal->dateofbirth, ['class' => 'form-control', 'placeholder' => 'Pulse aquí']) }}
                <script>
                    $(function() {
                        $.datepicker.setDefaults($.datepicker.regional["es"]);
                        $( "#dateofbirth" ).datepicker({
                            changeMonth: true,
                            changeYear: true,
                            yearRange: "-20:+0",
                            dateFormat: "yy-mm-dd",
                        });
                    });
                </script>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('dateofarrival', 'Fecha de ingreso:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::text('dateofarrival', $animal->dateofarrival, ['class' => 'form-control', 'placeholder' => 'Pulse aquí']) }}
                <script>
                    $(function() {
                        $( "#dateofarrival" ).datepicker({
                            dateFormat: "yy-mm-dd",
                        });
                    });
                </script>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('color_id', 'Color:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::select('color_id', $colors, $animal->color_id, ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('coat_id', 'Pelaje:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::select('coat_id', $coats, $animal->coat_id, ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('status_id', 'Situación:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::select('status_id', $statuses, $animal->status_id, ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('comments', 'Comentarios:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-7">{{ Form::textarea('comments', $animal->comments, ['class' => 'form-control', 'placeholder' => 'Información sobre el animal de interés para los potenciales adoptantes']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('youtube', 'ID de vídeo en Youtube:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-4">{{ Form::text('youtube', $animal->youtube, ['class' => 'form-control']) }}</div>
            <br style="clear: both">
            <p class="help-block col-sm-offset-2">&nbsp;Ej: si el vídeo está en http://www.youtube.com/watch?v=q0WBwq-qnb8, introduce q0WBwq-qnb8.</p>
        </div>

        <div class="form-group"><!-- FIXME: Show previous photos and allow its removal -->
            {{ Form::label('photo', 'Foto:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-4">
                {{ Form::file('photo') }}
                <p class="help-block">Formato: JPEG.</p>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('provenance', 'Lugar de procedencia:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-4">{{ Form::text('provenance', $animal->provenance, ['class' => 'form-control']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('deliverer', 'Persona y motivo de entrega:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-7">{{ Form::textarea('deliverer', $animal->deliverer, ['class' => 'form-control']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('dateofexit', 'Fecha de salida:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-2">
                {{ Form::text('dateofexit', $animal->dateofexit, ['class' => 'form-control']) }}
                <script>
                    $(function() {
                        $( "#dateofexit" ).datepicker({
                            dateFormat: "yy-mm-dd",
                        });
                    });
                </script>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('chipcode', 'Número de chip:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-4">{{ Form::text('chipcode', $animal->chipcode, ['class' => 'form-control']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('vaccinations', 'Vacunas:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-7">{{ Form::textarea('vaccinations', $animal->vaccinations, ['class' => 'form-control']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('diseases', 'Enfermedades:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-7">{{ Form::textarea('diseases', $animal->diseases, ['class' => 'form-control']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('surgeries', 'Operaciones:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-7">{{ Form::textarea('surgeries', $animal->surgeries, ['class' => 'form-control']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('treatment', 'Tratamiento:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-7">{{ Form::textarea('treatment', $animal->treatment, ['class' => 'form-control']) }}</div>
        </div>

        <div class="form-group">
            {{ Form::label('privatecomments', 'Observaciones:', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-7">{{ Form::textarea('privatecomments', $animal->privatecomments, ['class' => 'form-control']) }}</div>
        </div>

        <div class="col-sm-offset-2">
            <a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
            {{ Form::reset('Deshacer', ['class' => 'btn btn-warning']) }}
            {{ Form::submit('Guardar', ['class' => 'btn btn-success']) }}
        </div>
    {{ Form::close() }}

</div>

<br><br>

@stop

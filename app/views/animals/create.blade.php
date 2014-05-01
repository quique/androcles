@extends('layout')
@section('content')

<div class="container">
    <div class="page-header">
        <h1>{{ $title }}</h1>
    </div>

    <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
        {{ Form::token() }}

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nombre del animal:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{ Input::old('name') }}">
            </div>
            @if($errors->has('name'))
                <p class="text-danger">Verifique este campo.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="species_id" class="col-sm-2 control-label">Especie:</label>
            <div class="col-sm-2">
                {{ Form::select('species_id', $species, Input::old('species_id'), ['class'=>'form-control', 'id'=>'species_id']) }}
            </div>
            @if($errors->has('species_id'))
                <p class="text-danger">Verifique este campo.</p>
                {{-- $errors->get('species_id')[0] --}}
            @endif
        </div>

        <div class="form-group">
            <label for="breed" class="col-sm-2 control-label">Raza:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="breed" id="breed" placeholder="Raza(s)" value="{{ Input::old('breed') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="size" class="col-sm-2 control-label">Tamaño:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="size" id="size" placeholder="Tamaño" value="{{ Input::old('size') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">Peso:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="weight" id="weight" placeholder="Peso aproximado" value="{{ Input::old('weight') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="sex_id" class="col-sm-2 control-label">Sexo:</label>
            <div class="col-sm-2">
                {{ Form::select('sex_id', $sexes, Input::old('sex_id') ? Input::old('sex_id') : 2, ['class'=>'form-control', 'id'=>'sex_id']) }} {{-- 2: unknown --}}
            </div>
        </div>

        <div class="form-group">
            <label for="neutered" class="col-sm-2 control-label">Esterilizado:</label>
            <div class="col-sm-2">
                <select class="form-control" name="neutered" id="neutered">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                    <option value="NULL" selected='selected'>Desconocido</option>
                </select>
            </div>
        </div>

{{ HTML::script('js/jquery.ui.datepicker-es.js') }}

        <div class="form-group">
            <label for="dateofbirth" class="col-sm-2 control-label">Fecha de nacimiento:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="dateofbirth" id="dateofbirth" placeholder="Pulse aquí" value="{{ Input::old('dateofbirth') }}">
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
            <label for="dateofarrival" class="col-sm-2 control-label">Fecha de ingreso:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="dateofarrival" id="dateofarrival" placeholder="Pulse aquí" value="{{ Input::old('dateofarrival') }}">
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
            <label for="color_id" class="col-sm-2 control-label">Color:</label>
            <div class="col-sm-2">
                {{ Form::select('color_id', $colors, Input::old('color_id'), ['class'=>'form-control', 'id'=>'color_id']) }}
            </div>
            @if($errors->has('color_id'))
                <p class="text-danger">Verifique este campo.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="coat_id" class="col-sm-2 control-label">Pelaje:</label>
            <div class="col-sm-2">
                {{ Form::select('coat_id', $coats, Input::old('coat_id'), ['class'=>'form-control', 'id'=>'coat_id']) }}
            </div>
            @if($errors->has('coat_id'))
                <p class="text-danger">Verifique este campo.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="status_id" class="col-sm-2 control-label">Situación:</label>
            <div class="col-sm-2">
                {{ Form::select('status_id', $statuses, Input::old('status_id'), ['class'=>'form-control', 'id'=>'status_id']) }}
            </div>
            @if($errors->has('status_id'))
                <p class="text-danger">Verifique este campo.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="comments" class="col-sm-2 control-label">Comentarios:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="comments" id="comments" placeholder="Información sobre el animal de interés para los potenciales adoptantes">{{ Input::old('comments') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="youtube" class="col-sm-2 control-label">ID de vídeo en Youtube:</label>

            <div class="col-sm-2">
                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="q0WBwq-qnb8" value="{{ Input::old('youtube') }}">
            </div><br style="clear: both">
            <p class="help-block col-sm-offset-2">&nbsp;Ej: si el vídeo está en http://www.youtube.com/watch?v=q0WBwq-qnb8, introduce q0WBwq-qnb8.</p>
        </div>

        <div class="form-group">
            <label for="photo" class="col-sm-2 control-label">Foto:</label>
            <div class="col-sm-4">
                <!-- input type="hidden" name="MAX_FILE_SIZE" value="1572864" --> <!-- 1.5 MiB should be more than enough -->
                <input type="file" name="photo" id="photo" />
                <p class="help-block">Formato: JPEG.</p>
            </div>
        </div>

        <div class="form-group">
            <label for="provenance" class="col-sm-2 control-label">Lugar de procedencia:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="provenance" id="provenance" placeholder="Origen del animal" value="{{ Input::old('provenance') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="deliverer" class="col-sm-2 control-label">Persona y motivo de entrega:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="deliverer" id="deliverer" placeholder="Circunstancias de la entrega (persona, razón, etc)">{{ Input::old('deliverer') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="dateofexit" class="col-sm-2 control-label">Fecha de salida:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="dateofexit" id="dateofexit" placeholder="Pulse aquí" value="{{ Input::old('dateofexit') }}">
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
            <label for="chipcode" class="col-sm-2 control-label">Número de chip:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="chipcode" id="chipcode" placeholder="Número de identificación del animal" value="{{ Input::old('chipcode') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="vaccinations" class="col-sm-2 control-label">Vacunas:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="vaccinations" id="vaccinations" placeholder="Vacunas recibidas, junto con su fecha">{{ Input::old('vaccinations') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="diseases" class="col-sm-2 control-label">Enfermedades:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="diseases" id="diseases" placeholder="Enfermedades o síndromes que sufra">{{ Input::old('diseases') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="surgeries" class="col-sm-2 control-label">Operaciones:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="surgeries" id="surgeries" placeholder="Operaciones quirúrgicas a las que se haya sometido (excluyendo la esterilización)">{{ Input::old('surgeries') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="treatment" class="col-sm-2 control-label">Tratamiento:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="treatment" id="treatment" placeholder="Tratamientos médicos que deba seguir">{{ Input::old('treatment') }}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="privatecomments" class="col-sm-2 control-label">Observaciones:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="8" id="privatecomments" name="privatecomments" placeholder="Cualquier otra información de interés sobre este animal">{{ Input::old('privatecomments') }}</textarea>
            </div>
        </div>

        <div class="col-sm-offset-2">
            <a href="{{ URL::previous() }}" class="btn btn-danger">Cancelar</a>
            <button type="reset" class="btn btn-warning">Borrar</button>
            <button type="submit" class="btn btn-success">Añadir</button>
        </div>
    </form>

</div>

<br><br>

@stop

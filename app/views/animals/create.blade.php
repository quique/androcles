@extends('layout')
@section('content')

<div class="container">
    <div class="page-header">
        <h2>{{ trans($title) }}</h2>
    </div>

    <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
        {{ Form::token() }} <!-- Protection against cross-site request forgery attacks -->

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">{{ trans('animals.name') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name" id="name" placeholder="{{ trans('animals.name-animal') }}" value="{{{ Input::old('name') }}}">
            </div>
            @if($errors->has('name'))
                <p class="text-danger">{{ trans('animals.check') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="species_id" class="col-sm-2 control-label">{{ trans('animals.species') }}:</label>
            <div class="col-sm-2">
                {{ Form::select('species_id', $species, Input::old('species_id'), ['class'=>'form-control', 'id'=>'species_id']) }}
            </div>
            @if($errors->has('species_id'))
                <p class="text-danger">{{ trans('animals.check') }}</p>
                {{-- $errors->get('species_id')[0] --}}
            @endif
        </div>

        <div class="form-group">
            <label for="breed" class="col-sm-2 control-label">{{ trans('animals.breed') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="breed" id="breed" placeholder="{{ trans('animals.breed') }}" value="{{{ Input::old('breed') }}}">
            </div>
        </div>

        <div class="form-group">
            <label for="size" class="col-sm-2 control-label">{{ trans('animals.size') }}:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="size" id="size" placeholder="{{ trans('animals.size-animal') }}" value="{{{ Input::old('size') }}}">
            </div>
        </div>

        <div class="form-group">
            <label for="weight" class="col-sm-2 control-label">{{ trans('animals.weight') }}:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="weight" id="weight" placeholder="{{ trans('animals.weight-animal') }}" value="{{{ Input::old('weight') }}}">
            </div>
        </div>

        <div class="form-group">
            <label for="sex_id" class="col-sm-2 control-label">{{ trans('animals.sex') }}:</label>
            <div class="col-sm-2">
                {{ Form::select('sex_id', $sexes, Input::old('sex_id') ? Input::old('sex_id') : 2, ['class'=>'form-control', 'id'=>'sex_id']) }} {{-- 2: unknown --}}
            </div>
        </div>

        <div class="form-group">
            <label for="neutered" class="col-sm-2 control-label">{{ trans('animals.neutered') }}:</label>
            <div class="col-sm-2">
                <select class="form-control" name="neutered" id="neutered">
                    <option value="0">{{ trans('animals.no') }}</option>
                    <option value="1">{{ trans('animals.yes') }}</option>
                    <option value="NULL" selected='selected'>{{ trans('animals.unknown') }}</option>
                </select>
            </div>
        </div>

{{ HTML::script('js/jquery.ui.datepicker-es.js') }}

        <div class="form-group">
            <label for="dateofbirth" class="col-sm-2 control-label">{{ trans('animals.dateofbirth') }}:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="dateofbirth" id="dateofbirth" placeholder="{{ trans('animals.press') }}" value="{{ Input::old('dateofbirth') }}">
                <script>
                    $(function() {
                        $.datepicker.setDefaults($.datepicker.regional["es"]); // FIXME
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
            <label for="dateofarrival" class="col-sm-2 control-label">{{ trans('animals.dateofarrival') }}:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="dateofarrival" id="dateofarrival" placeholder="{{ trans('animals.press') }}" value="{{ Input::old('dateofarrival') }}">
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
            <label for="color_id" class="col-sm-2 control-label">{{ trans('animals.color') }}:</label>
            <div class="col-sm-2">
                {{ Form::select('color_id', $colors, Input::old('color_id'), ['class'=>'form-control', 'id'=>'color_id']) }}
            </div>
            @if($errors->has('color_id'))
                <p class="text-danger">{{ trans('animals.check') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="coat_id" class="col-sm-2 control-label">{{ trans('animals.coat') }}:</label>
            <div class="col-sm-2">
                {{ Form::select('coat_id', $coats, Input::old('coat_id'), ['class'=>'form-control', 'id'=>'coat_id']) }}
            </div>
            @if($errors->has('coat_id'))
                <p class="text-danger">{{ trans('animals.check') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="status_id" class="col-sm-2 control-label">{{ trans('animals.status') }}:</label>
            <div class="col-sm-2">
                {{ Form::select('status_id', $statuses, Input::old('status_id'), ['class'=>'form-control', 'id'=>'status_id']) }}
            </div>
            @if($errors->has('status_id'))
                <p class="text-danger">{{ trans('animals.check') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="comments" class="col-sm-2 control-label">{{ trans('animals.comments') }}:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="comments" id="comments" placeholder="{{ trans('animals.comments2') }}">{{{ Input::old('comments') }}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="youtube" class="col-sm-2 control-label">{{ trans('animals.youtube_id') }}:</label>

            <div class="col-sm-2">
                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="q0WBwq-qnb8" value="{{{ Input::old('youtube') }}}">
            </div><br style="clear: both">
            <p class="help-block col-sm-offset-2">&nbsp;{{ trans('animals.youtube_ex') }}</p>
        </div>

        <div class="form-group">
            <label for="photo" class="col-sm-2 control-label">{{ trans('animals.photo') }}:</label>
            <div class="col-sm-4">
                <!-- input type="hidden" name="MAX_FILE_SIZE" value="1572864" --> <!-- 1.5 MiB should be more than enough -->
                <input type="file" name="photo" id="photo" />
                <p class="help-block">{{ trans('animals.format') }}.</p>
            </div>
        </div>


        <h2>{{ trans('animals.private') }}</h2>

        <div class="form-group">
            <label for="provenance" class="col-sm-2 control-label">{{ trans('animals.provenance') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="provenance" id="provenance" placeholder="{{ trans('animals.provenance2') }}" value="{{{ Input::old('provenance') }}}">
            </div>
        </div>

        <div class="form-group">
            <label for="deliverer" class="col-sm-2 control-label">{{ trans('animals.deliverer') }}:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="deliverer" id="deliverer" placeholder="{{ trans('animals.deliverer2') }}">{{{ Input::old('deliverer') }}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="dateofexit" class="col-sm-2 control-label">{{ trans('animals.dateofexit') }}:</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="dateofexit" id="dateofexit" placeholder="{{ trans('animals.press') }}" value="{{{ Input::old('dateofexit') }}}">
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
            <label for="chipcode" class="col-sm-2 control-label">{{ trans('animals.chipcode') }}:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="chipcode" id="chipcode" placeholder="{{ trans('animals.chipcode2') }}" value="{{{ Input::old('chipcode') }}}">
            </div>
        </div>

        <div class="form-group">
            <label for="vaccinations" class="col-sm-2 control-label">{{ trans('animals.vaccinations') }}:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="vaccinations" id="vaccinations" placeholder="{{ trans('animals.vaccinations2') }}">{{{ Input::old('vaccinations') }}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="diseases" class="col-sm-2 control-label">{{ trans('animals.diseases') }}:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="diseases" id="diseases" placeholder="{{ trans('animals.diseases2') }}">{{{ Input::old('diseases') }}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="surgeries" class="col-sm-2 control-label">{{ trans('animals.surgeries') }}:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="surgeries" id="surgeries" placeholder="{{ trans('animals.surgeries2') }}">{{{ Input::old('surgeries') }}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="treatment" class="col-sm-2 control-label">{{ trans('animals.treatment') }}:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="4" name="treatment" id="treatment" placeholder="{{ trans('animals.treatment2') }}">{{{ Input::old('treatment') }}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="privatecomments" class="col-sm-2 control-label">{{ trans('animals.privatecomments') }}:</label>
            <div class="col-sm-7">
                <textarea class="form-control" rows="8" id="privatecomments" name="privatecomments" placeholder="{{ trans('animals.privatecomments2') }}">{{{ Input::old('privatecomments') }}}</textarea>
            </div>
        </div>

        <div class="col-sm-offset-2">
            <a href="{{ URL::previous() }}" class="btn btn-danger">{{ trans('animals.cancel') }}</a>
            <button type="reset" class="btn btn-warning">{{ trans('animals.clean') }}</button>
            <button type="submit" class="btn btn-success">{{ trans('animals.add') }}</button>
        </div>
    </form>

</div>

<br><br>

@stop

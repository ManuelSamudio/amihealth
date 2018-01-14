@extends('layouts.amihealth')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar perfil</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Perfil de {{ $user->nombre }} <a class="pull-right btn btn-primary" href="/" role="button"><i class="right fa fa-arrow-left" aria-hidden="true"></i> Regresar</a></h3></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                       <form class="form-horizontal" role="form" method="POST" action="/profile"  enctype="multipart/form-data" data-toggle="validator">
                           {{ csrf_field() }}


                           <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                               <label for="img" class="col-md-4 control-label">Foto de Perfil</label>

                               <div class="col-md-6">

                                   <img src="/uploads/avatars/{{ $user->img}}" style="width:100px; height:100px; float:left; border-radius:50%; margin-right:25px;">
                                   <input type="file" name="img" accept="image/*">

                                   <div class="help-block with-errors"></div>
                                   @if ($errors->has('img'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('img') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                               <label for="nombre" class="col-md-4 control-label">Nombre</label>

                               <div class="col-md-6">
                                   <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="{{ $user->nombre }}">
                                   <div class="help-block with-errors"></div>
                                   @if ($errors->has('nombre'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                               <label for="apellido" class="col-md-4 control-label">Apellido</label>

                               <div class="col-md-6">
                                   <input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" placeholder="{{ $user->apellido }}">
                                   <div class="help-block with-errors"></div>
                                   @if ($errors->has('apellido'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                               <label for="fecha_nacimiento" class="col-md-4 control-label">Fecha de Nacimiento</label>

                               <div class="col-md-6" style="height:130px;">

                                   <div class='input-group date' id="fecha">

                                       <input type='text' id="fecha" class="form-control" name="fecha_nacimiento" placeholder="{{ $paciente->fecha_nacimiento }}" value="{{ old('fecha_nacimiento') }}" onkeydown="return false" />
                                       <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                                   </div>

                                   @if ($errors->has('fecha_nacimiento'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('sexo') ? ' has-error' : '' }}">

                               <label for="sexo" class="col-md-4 control-label">Género</label>

                               <div class="col-md-4">

                                   <select id='sexo' name='sexo' class="form-control" value="{{ old('sexo') }}">
                                           @if($paciente->sexo == false)
                                               <option value="0" selected>Mujer</option>
                                               <option value="1">Hombre</option>
                                           @endif
                                            @if($paciente->sexo == true)
                                               <option value="0">Mujer</option>
                                               <option value="1" selected>Hombre</option>
                                           @endif
                                   </select>
                                   @if ($errors->has('sexo'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('sexo') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group{{ $errors->has('estatura') ? ' has-error' : '' }}">
                               <label for="estatura" class="col-md-4 control-label">Estatura (cm)</label>

                               <div class="col-md-4">
                                   <input id="estatura" type="number" class="form-control numbers" name="estatura" placeholder="{{ $estatura->estatura }}" value="{{ old('estatura') }}">

                                   @if ($errors->has('estatura'))
                                       <span class="help-block">
                                        <strong>{{ $errors->first('estatura') }}</strong>
                                    </span>
                                   @endif
                               </div>
                           </div>

                           <div class="form-group">
                               <div class="col-md-4 col-md-offset-4">
                                   <button type="submit" class="btn btn-success btn-block">Actualizar</button>
                               </div>
                           </div>
                       </form>
                       <!-- end form -->

                </div>
            </div>
        </div>
    </div>


    <link href="{{ asset('/dist/css/datetimepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('/dist/js/moment.js') }}"></script>
    <script src="{{ asset('/dist/js/datetimepicker.js') }}"></script>

    <script type="text/javascript">
        $(function () {//datetimepicker input

            $('#fecha').datetimepicker({
                maxDate: moment(),
                viewMode: 'years',
                format: 'YYYY/MM/DD',
            });
        });

        $('#fecha_nacimiento').on('dp.change',function(e) {//set datetimepicker data

            var yo = $('#fecha_nacimiento').find('input').val();
            $('#fecha').attr('value',yo);
        });

        document.querySelector(".numbers").addEventListener("keypress", function (evt) {
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
            {
                evt.preventDefault();
            }
        });
    </script>
@endsection

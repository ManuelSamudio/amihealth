@extends('layouts.doctor')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Añadir Nuevo Paciente</h1>
        </div>
    </div>
    <!-- /.col-lg-12 -->
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar Paciente</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="store-patient" data-toggle="validator">
                        {{ csrf_field() }}

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

                        <div class="form-group{{ $errors->has('ced', 'tomo', 'asiento') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Cédula</label>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group now">
                                    <div class="col-xs-3">

                                        <select id='ced' name='ced' class="form-control" value="{{ old('ced') }}" required autofocus>
                                            @foreach ($provincias as $provincia)
                                                <option value="{{$provincia->id_provincia}}">{{$provincia->id_provincia}}</option>
                                            @endforeach
                                            <option value="AV">AV</option>
                                            <option value="E">E</option>
                                            <option value="N">N</option>
                                            <option value="PE">PE</option>
                                            <option value="PI">PI</option>
                                            <option value="SB">SB</option>
                                        </select>

                                    </div>

                                    <div class="col-xs-4 col-md-4">
                                        <input  type="number" class="form-control" id="tomo" name="tomo" value="{{ old('tomo') }}" required autofocus>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <label for="asiento" class="col-xs-1">_</label>
                                    <div class="col-xs-4 col-md-4">
                                        <input  type="number" class="form-control" id="asiento" name="asiento" value="{{ old('asiento') }}" required autofocus>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                @if ($errors->has('ced'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('tomo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tomo') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('asiento'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('asiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus>
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
                                <input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required autofocus>
                                <div class="help-block with-errors"></div>
                                @if ($errors->has('apellido'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" data-error="Este correo electrónico es inválido" required autofocus>
                                <div class="help-block with-errors"></div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('movil') ? ' has-error' : '' }}">
                            <label for="movil" class="col-md-4 control-label">Móvil</label>

                            <div class="col-md-6">
                                <input id="movil" type="text" class="form-control movil" name="movil" value="{{ old('movil') }}" maxlength="15" required autofocus>
                                <div class="help-block with-errors"></div>
                                @if ($errors->has('movil'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('movil') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Dirección</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required autofocus>

                                @if ($errors->has('direccion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                            <label for="fecha_nacimiento" class="col-md-4 control-label">Fecha de Nacimiento</label>

                            <div class="col-md-6" style="height:130px;">
                                <div class='input-group date' id="fecha_nacimiento">
                                    <input type='text' id="fecha" class="form-control"name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required autofocus/>
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

                            <div class="col-md-6">

                                <select id='sexo' name='sexo' class="form-control" value="{{ old('sexo') }}" required autofocus>
                                    <option value=""selected disabled>-Seleccionar un genero -</option>
                                    <option value="0">Hombre</option>
                                    <<option value="1">Mujer</option>
                                </select>
                                @if ($errors->has('sexo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sexo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('id_provincia') ? ' has-error' : '' }}">
                            <label for="id_provincia" class="col-md-4 control-label">Provincia</label>

                            <div class="col-md-6">
                                <select id='id_provincia' name='id_provincia' class=" id_provincia form-control" value="{{ old('id_provincia') }}" required autofocus>
                                    <option value="0" disabled="true" selected="true">-Seleccionar una provincia-</option>
                                    @foreach ($provincias as $provincia)
                                        <option value="{{$provincia->id_provincia}}">{{$provincia->nombre}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_provincia'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('id_provincia') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="id_distrito form-group{{ $errors->has('id_distrito') ? ' has-error' : '' }}">
                            <label for="id_distrito" class="col-md-4 control-label">Distrito</label>

                            <div class="col-md-6">
                                <select id='id_distrito' name='id_distrito' class="id_distrito form-control" value="{{ old('id_distrito') }}" required autofocus>
                                    <option value="0" disabled="true" selected="true">-Seleccionar un distrito-</option>
                                </select>
                                @if ($errors->has('id_distrito'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('id_distrito') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="id_corregimiento form-group{{ $errors->has('id_corregimiento') ? ' has-error' : '' }}">
                            <label for="id_corregimiento" class="col-md-4 control-label">Corregimiento</label>

                            <div class="col-md-6">
                                <select id='id_corregimiento' name='id_corregimiento' class="id_corregimiento form-control" value="{{ old('id_corregimiento') }}" required autofocus>
                                    <option value="0" disabled="true" selected="true">-Seleccionar un corregimiento-</option>
                                </select>
                                @if ($errors->has('id_corregimiento'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('id_corregimiento') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('id_etnia') ? ' has-error' : '' }}">
                            <label for="id_etnia" class="col-md-4 control-label">Etnia</label>

                            <div class="col-md-6">
                                <select id='id_provincia' name='id_etnia' class=" id_etnia form-control" value="{{ old('id_etnia') }}" required autofocus>
                                    <option value="0" disabled="true" selected="true">-Seleccionar una etnia-</option>
                                    @foreach ($etnias as $etnia)
                                        <option value="{{$etnia->id}}">{{$etnia->nombre}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('id_etnia'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('id_etnia') }}</strong>
                                  </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('estatura') ? ' has-error' : '' }}">
                            <label for="estatura" class="col-md-4 control-label">Estatura (cm)</label>

                            <div class="col-md-6">
                                <input id="estatura" type="text" class="form-control" name="estatura" value="{{ old('estatura') }}" required>

                                @if ($errors->has('estatura'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('estatura') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('peso') ? ' has-error' : '' }}">
                            <label for="peso" class="col-md-4 control-label">Peso (kg)</label>

                            <div class="col-md-6">
                                <input id="peso" type="text" class="form-control" name="peso" value="{{ old('peso') }}" required>

                                @if ($errors->has('peso'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('peso') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){

            $('.movil').mask('(507) 9999-9999');
        });

        $(function () {//datetimepicker input

            $('#fecha_nacimiento').datetimepicker({
                maxDate: moment(),
                viewMode: 'years',
                format: 'YYYY/MM/DD'
            });
        });

        $('#fecha_nacimiento').on('dp.change',function(e) {//set datetimepicker data

            var yo = $('#fecha_nacimiento').find('input').val();
            $('#fecha').attr('value',yo);
        });

        $(document).on('change','.id_provincia', function(){//provincia dropdown

            var id_provincia=$(this).val();
            var div = $(this).parent();

            var op = " ";

            $.ajax({
                type: 'get',
                url:'{!!URL::to('ajax-distritos')!!}',
                data:{'id_provincia':id_provincia},
                success:function(data){

                    op+='<option value="0" selected disabled>-Seleccionar Distritos-</option>';
                    for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].id_distrito+'">'+data[i].nombre+'</option>';
                    }
                    $('#id_distrito').html(' ');
                    $('#id_corregimiento').html('<option value="0" selected disabled>-Seleccionar Corregimiento-</option>');
                    $('#id_distrito').html(op);

                },
                error:function() {

                }
            });
        });
        $(document).on('change','#id_distrito', function(){//distrito y corregimiento dropdown

            var id_distrito=$(this).val();
            var div = $(this).parent();

            var op = " ";

            $.ajax({
                type: 'get',
                url:'{!!URL::to('ajax-corregimientos')!!}',
                data:{'id_distrito':id_distrito},
                success:function(data){
                    op+='<option value="0" selected disabled>-Seleccionar Corregimiento-</option>';
                    for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].id_corregimiento+'">'+data[i].nombre+'</option>';
                    }
                    $('#id_corregimiento').html(' ');
                    $('#id_corregimiento').html(op);

                },
                error:function() {

                }
            });
        });
    </script>
@endsection
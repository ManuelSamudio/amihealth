@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Regístrate</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}" data-toggle="validator">
                        {{ csrf_field() }}

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

                                    <div class="col-xs-3 col-md-4">
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
                                        <strong>{{ $errors->first('ced') }}</strong>
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

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="off" minlength=" 6" required autofocus>
                                <div class="help-block with-errors"></div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off" data-match="#password" required autofocus>
                                <div class="help-block with-errors"></div>
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
                                      <input type='text' id="fecha" class="form-control"name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required autofocus onkeydown="return false"/>
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
                                    <option value=""selected disabled>-Seleccionar un género -</option>
                                    <option value="0">Mujer</option>
                                    <option value="1">Hombre</option>
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
                              <select id='id_etnia' name='id_etnia' class="form-control" value="{{ old('id_etnia') }}" required autofocus>
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
                                <input id="estatura" type="number" class="form-control estatura" name="estatura" value="{{ old('estatura') }}" required>

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
                                <input id="peso" type="number" class="form-control peso" name="peso" value="{{ old('peso') }}" required>

                                @if ($errors->has('peso'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('peso') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                            <label for="terms" class="col-md-4 control-label">Términos y Condiciones</label>

                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="terms" value="true" {{ !old('terms') ?: 'checked' }} required> Acepto
                                        <a href="/terms-and-conditions">términos y condiciones</a>
                                    </label>
                                </div>


                                @if ($errors->has('terms'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('terms') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Regístrate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="{{ asset('/dist/css/datetimepicker.css') }}" rel="stylesheet">
<script src="{{ asset('/dist/js/moment.js') }}"></script>
<script src="{{ asset('/dist/js/datetimepicker.js') }}"></script>


<script type="text/javascript">
      $(document).ready(function(){

          $('.movil').mask('9999-9999');
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

      document.querySelector(".estatura").addEventListener("keypress", function (evt) {
          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
          {
              evt.preventDefault();
          }
      });
      document.querySelector(".peso").addEventListener("keypress", function (evt) {
          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
          {
              evt.preventDefault();
          }
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

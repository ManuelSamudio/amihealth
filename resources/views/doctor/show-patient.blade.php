@extends('layouts.doctor')

@section('content')
    <link href="/css/event.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Paciente: {{$user->nombre . ' ' .$user->apellido . ', ' .$user->cedula}} <a class="pull-right btn btn-primary" href="/show-patients" role="button"><i class="right fa fa-arrow-left" aria-hidden="true"></i> Regresar</a></h1>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- /.col-lg-12 -->
    <div class="row">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#graph">Gráficas</a></li>
            <li><a data-toggle="tab" href="#list-bp">Medidas de Presión Arterial</a></li>
            <li><a data-toggle="tab" href="#weights">Pesos</a></li>
            <li><a data-toggle="tab" href="#waists">Cinturas</a></li>
            <li><a data-toggle="tab" href="#profile">Perfil</a></li>
        </ul>

        <div class="tab-content">

            <div id="graph" class="tab-pane fade in active">
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-line-chart fa-fw"></i> Presión Arterial
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div id="morris-lineal-blood-pressures"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-line-chart fa-fw"></i> Peso
                            </div>
                            <!-- /.panel-heading-->
                            <div class="panel-body">
                                <div id="morris-lineal-weight"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-line-chart fa-fw"></i> IMC
                            </div>
                            <!-- /.panel-heading-->
                            <div class="panel-body">
                                <div id="morris-lineal-imc"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-line-chart fa-fw"></i> Cintura
                            </div>
                            <!-- /.panel-heading-->
                            <div class="panel-body">
                                <div id="morris-lineal-cintura"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-line-chart fa-fw"></i> ICA
                            </div>
                            <!-- /.panel-heading-->
                            <div class="panel-body">
                                <div id="morris-lineal-ica"></div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.div -->

            <div id="list-bp" class="tab-pane fade ">
                <br>
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
                <div class="col-xs-12">
                    @if(count($blood_pressures) >= 1)
                        @foreach ($blood_pressures as $blood_pressure)
                            <ul class="event-list">
                                <li>
                                    <time style="background:{{$blood_pressure->rgb}}"datetime="{{$blood_pressure->created_at->format('Y-m-d')}}">
                                        <span class="day">{{$blood_pressure->created_at->format('d')}}</span>
                                        <span class="month">{{$blood_pressure->created_at->format('M')}}</span>
                                        <span class="year">{{$blood_pressure->created_at->format('Y')}}</span>
                                    </time>
                                    <time style="background-color:{{$blood_pressure->rgb}};opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>SYS</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$blood_pressure->SYS}}</h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">mmHg</div>
                                    </time>
                                    <time style="background-color:{{$blood_pressure->rgb}}; opacity: 0.85">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>DIS</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$blood_pressure->DIS}}</h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">mmHg</div>
                                    </time>
                                    <time style="background-color:{{$blood_pressure->rgb}}; opacity: 0.8">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Pulso</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$blood_pressure->pulso}}</h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">Bpm</div>
                                    </time>
                                    <div class="info">
                                        <h2 class="title">{{$blood_pressure->descrip}}</h2>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li class="facebook" style="width:33%;"><a href="/edit-hta-by-doc/{{$blood_pressure->id}}"><span class="fa fa-pencil"></span></a></li>
                                            <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal1"><span class="fa fa-info"></span></a></li>
                                            <li class="google-plus" style="width:33%;"><a href="/delete-hta-by-doc/{{$blood_pressure->id}}"><span class="fa fa-trash"></span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="event-details">
                                    <div class="info" style="height:auto">
                                        <p class="desc">{{ucwords($blood_pressure->created_at->format('l d, F Y, h:i A'))}}</p>
                                    </div>
                                </li>
                            </ul>
                        @endforeach

                            {{$blood_pressures->links()}}

                            <div class="col-xs-12">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-hta/{{$user->id}}">Agregar Nueva Medida</a>
                            </div>
                    @else
                        <div class="form-group">
                            <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                                <p class="bg-warning text-center">No hay Medidas de Presión Arterial disponibles</p>
                            </div>

                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-hta/{{$user->id}}">Agregar Nueva Medida</a>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
            <!-- /.div -->

            <div id="weights" class="tab-pane fade">
                <br>
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
                <div class="col-xs-12">
                    @if(count($weights) >= 1)
                        @foreach ($weights as $weight)
                            <ul class="event-list">
                                <li>
                                    <time style="background:{{$weight->rgb}}"datetime="{{$weight->created_at->format('Y-m-d')}}">
                                        <span class="day">{{$weight->created_at->format('d')}}</span>
                                        <span class="month">{{$weight->created_at->format('M')}}</span>
                                        <span class="year">{{$weight->created_at->format('Y')}}</span>
                                    </time>
                                    <time style="background-color:{{$weight->rgb}};opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Peso</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$weight->peso}}</h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">Kg</div>
                                    </time>
                                    <time style="background-color:{{$weight->rgb}}; opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>IMC</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$weight->imc}}</h1></span>

                                    </time>
                                    <div class="info">
                                        <h2 class="title">{{$weight->descrip}}</h2>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li class="facebook" style="width:33%;"><a href="/edit-weight-by-doc/{{$weight->id}}"><span class="fa fa-pencil"></span></a></li>
                                            <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal2"><span class="fa fa-info"></span></a></li>
                                            <li class="google-plus" style="width:33%;"><a href="/delete-weight-by-doc/{{$weight->id}}"><span class="fa fa-trash"></span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="event-details">
                                    <div class="info" style="height:auto">
                                        <p class="desc">{{ucwords($weight->created_at->format('l d, F Y, h:i A'))}}</p>
                                    </div>
                                </li>
                            </ul>
                        @endforeach

                            {{$weights->links()}}

                            <div class="col-xs-12">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-weight-by-doc/{{$user->id}}">Agregar Nueva Medida</a>
                            </div>

                    @else
                        <div class="form-group">
                            <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                                <p class="bg-warning text-center">No hay medidas de peso disponibles</p>
                            </div>

                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-weight-by-doc/{{$user->id}}">Agregar Nuevo Peso</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <!-- /.div -->

            <div id="waists" class="tab-pane fade">
                <br>
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
                <div class="col-xs-12">
                    @if(count($waists) >= 1)
                        @foreach ($waists as $waist)
                            <ul class="event-list">
                                <li>
                                    <time style="background:{{$waist->rgb}}"datetime="{{$waist->created_at->format('Y-m-d')}}">
                                        <span class="day">{{$waist->created_at->format('d')}}</span>
                                        <span class="month">{{$waist->created_at->format('M')}}</span>
                                        <span class="year">{{$waist->created_at->format('Y')}}</span>
                                    </time>
                                    <time style="background-color:{{$waist->rgb}};opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Cintura</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$waist->cintura}}</h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">cm</div>
                                    </time>
                                    <time style="background-color:{{$waist->rgb}}; opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>ICA</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;">{{$waist->ica}}</h1></span>

                                    </time>
                                    <div class="info">
                                        <h2 class="title">{{$waist->descrip}}</h2>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li class="facebook" style="width:33%;"><a href="/edit-waist-by-doc/{{ $waist->id }}"><span class="fa fa-pencil"></span></a></li>
                                            <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal3"><span class="fa fa-info"></span></a></li>
                                            <li class="google-plus" style="width:33%;"><a href="/delete-waist-by-doc/{{ $waist->id }}"><span class="fa fa-trash"></span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="event-details">
                                    <div class="info" style="height:auto">
                                        <p class="desc">{{ucwords($waist->created_at->format('l d, F Y, h:i A'))}}</p>
                                    </div>
                                </li>
                            </ul>
                        @endforeach

                            {{$waists->links()}}

                            <div class="col-xs-12">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-waist-by-doc/{{$user->id}}">Agregar Nueva Medida de Cintura</a>
                            </div>

                    @else
                        <div class="form-group">
                            <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                                <p class="bg-warning text-center">No hay medidas de peso disponibles</p>
                            </div>

                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-waist-by-doc/{{$user->id}}">Agregar Nueva Medida de Cintura</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.div -->

            <div id="profile" class="tab-pane fade">
                <br>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3> Perfil de {{ $user->nombre }} </h3></div>

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

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="img" class="col-md-4 control-label">Foto de Perfil</label>

                                                    <div class="col-md-6">
                                                        <img src="/uploads/avatars/{{ $user->img}}" style="width:100px; height:100px; float:left; border-radius:50%; margin-right:25px;">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre" class="col-md-4 control-label">Nombre</label>

                                                    <div class="col-md-6">
                                                        <input id="nombre" type="text" class="form-control" name="nombre" value="{{$user->nombre}}" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="apellido" class="col-md-4 control-label">Apellido</label>

                                                    <div class="col-md-6">
                                                        <input id="apellido" type="text" class="form-control" name="apellido" value="{{ $user->apellido }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="apellido" class="col-md-4 control-label">Fecha de Nacimeinto</label>

                                                    <div class="col-md-6">
                                                        <input type='text' id="fecha" class="form-control" name="fecha_nacimiento" value="{{ $paciente->fecha_nacimiento }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edad" class="col-md-4 control-label">Edad</label>

                                                    <div class="col-md-6">
                                                        <input id="edad" type="text" class="form-control" name="apellido" value="{{ $paciente->age }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edad" class="col-md-4 control-label">Dirección</label>

                                                    <div class="col-md-6">
                                                        <input id="direccion" type="text" class="form-control" name="direccion" value="{{ $paciente->direccion }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edad" class="col-md-4 control-label">Móvil</label>

                                                    <div class="col-md-6">
                                                        <input id="movil" type="text" class="form-control" name="movil" value="{{ $paciente->movil }}" disabled>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- ./div col-md-6 -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="etnia" class="col-md-4 control-label">Etnia</label>

                                                    <div class="col-md-6">
                                                        <input id="etnia" type="text" class="form-control" name="etnia" value="{{ $paciente->id_etnia }}" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <label for="sexo" class="col-md-4 control-label">Género</label>

                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="sexo"
                                                               @if($paciente->sexo == false)
                                                               value="Mujer" disabled
                                                               @endif
                                                               @if($paciente->sexo == true)
                                                               value="Hombre" disabled
                                                                @endif
                                                        >
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
                                            </div>
                                            <!-- ./div col-md-6 -->

                                        </form>
                                        <!-- end form -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.div -->

        </div>
        <!-- /.div row-->
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

    @include('doctor.modals-info')

    @include('doctor.graph-scripts')



@endsection
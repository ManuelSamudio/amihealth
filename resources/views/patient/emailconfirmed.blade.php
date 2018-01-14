@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro de Cuenta Confirmado</div>
                    <div class="panel-body">
                        Su Correo Electrónico se verificó correctamente. Haga clic aquí para <a href="{{url('/login')}}">Iniciar Sessión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

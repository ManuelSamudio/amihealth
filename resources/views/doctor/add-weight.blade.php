@extends('layouts.doctor')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Peso</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Peso</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/store-weight-by-doc" data-toggle="validator">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{$user->id}}">

                        <div class="form-group{{ $errors->has('peso') ? ' has-error' : '' }}">

                            <label for="peso" class="col-md-4 control-label">Peso (kg)</label>

                            <div class="col-md-4">
                                <input id="peso" type="number" step="0.1"class="form-control" name="peso" value="{{ old('peso') }}" required autofocus>
                                <div class="help-block with-errors"></div>

                                @if ($errors->has('peso'))
                                    <span class="help-block">
                                          <strong>{{ $errors->first('peso') }}</strong>
                                      </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-block">Guardar</button>
                            </div>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            </div>
        </div>
    </div>

@endsection

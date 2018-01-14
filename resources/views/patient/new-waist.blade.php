@extends('layouts.amihealth')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cintura</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo medida de  cintura</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="store-waist" data-toggle="validator">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('cintura') ? ' has-error' : '' }}">
                            <label for="cintura" class="col-md-4 control-label">Cintura (cm)</label>

                            <div class="col-md-4">
                                <input id="cintura" type="number" step="0.1"class="form-control" name="cintura" value="{{ old('cintura') }}" required autofocus>
                                <div class="help-block with-errors"></div>
                                @if ($errors->has('cintura'))
                                    <span class="help-block">
                                          <strong>{{ $errors->first('cintura') }}</strong>
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

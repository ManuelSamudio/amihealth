@extends('layouts.amihealth')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Temperatura</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nueva temperatura</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="store-temperature" data-toggle="validator">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('temperature') ? ' has-error' : '' }}">
                            <label for="peso" class="col-md-4 control-label">Temperatura (Cº)</label>

                            <div class="col-md-4">
                                <input id="peso" type="number" step="0.1"class="form-control" name="temperatura" value="{{ old('temperatura') }}" required autofocus>
                                <div class="help-block with-errors"></div>
                                @if ($errors->has('temperature'))
                                    <span class="help-block">
                                          <strong>{{ $errors->first('temperature') }}</strong>
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

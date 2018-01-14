@extends('layouts.amihealth')

@section('content')

      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">Presión Arterial</h1>
          </div>
          <!-- /.col-lg-12 -->
      </div>

      <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
              <div class="panel panel-default">
                  <div class="panel-heading">Nueva Medida de Presión Arterial</div>
                  <div class="panel-body">
                      <form class="form-horizontal" role="form" method="POST" action="store_blood_pressure" id="form-bp" data-toggle="validator">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('SYS') ? ' has-error' : '' }}">
                              <label for="SYS" class="col-md-4 control-label">SYS (mmHg)</label>

                              <div class="col-md-4">
                                  <input id="sys" type="number" class="form-control" name="SYS" max="350" value="{{ old('SYS') }}" required autofocus>
                                  <div class="help-block with-errors"></div>
                                  @if ($errors->has('SYS'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('SYS') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('DIS') ? ' has-error' : '' }}">
                              <label for="DIS" class="col-md-4 control-label">DIS (mmHg)</label>

                              <div class="col-md-4">
                                  <input id="dis" type="number" class="form-control" name="DIS" max="350" value="{{ old('DIS')}}" required>
                                  <div class="help-block with-errors"></div>
                                  @if ($errors->has('DIS'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('DIS') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('pulso') ? ' has-error' : '' }}">
                              <label for="pulso" class="col-md-4 control-label">Pulso (Bpm)</label>

                              <div class="col-md-4">
                                  <input id="pulso" type="number" class="form-control" name="pulso" max="350" value="{{ old('pulso')}}" required>
                                  <div class="help-block with-errors"></div>
                                  @if ($errors->has('pulso'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('pulso') }}</strong>
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

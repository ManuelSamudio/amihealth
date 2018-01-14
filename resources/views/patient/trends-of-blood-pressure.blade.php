@extends('layouts.amihealth')

@section('content')

          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header">Tendencias de Presión Arterial</h1>
              </div>
              <!-- /.col-lg-12 -->
          </div>
            <!-- /.row -->
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

  <script type="text/javascript">
          var blood_pressures = {!! $blood_pressures !!}

          if(blood_pressures.length == 0){
              Morris.Line({
                  element: 'morris-lineal-blood-pressures',
                  data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
                  xkey: 'label',
                  ykeys: ['value'],
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
              });
          }else{
              Morris.Line({
                  element: 'morris-lineal-blood-pressures',
                  data: blood_pressures,
                  xkey: 'created_at',
                  xLabels: 'day',
                  ykeys: ['SYS', 'DIS', 'pulso'],
                  labels: ['SYS', 'DIS', 'Pulso'],
                  pointSize: 8,
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
                  smooth: false
              });
          }

  </script>

@endsection

<?php $__env->startSection('content'); ?>

          <div class="row">
              <div class="col-lg-12">
                  <h1 class="page-header">Dashboard</h1>
              </div>
              <!-- /.col-lg-12 -->
          </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12">
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
                  <div class="col-xs-6">
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
                    <div class="col-xs-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <i class="fa fa-line-chart fa-fw"></i> Índice de Masa Coorporal (IMC)
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
                  <div class="col-xs-6">
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
                  <div class="col-xs-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <i class="fa fa-line-chart fa-fw"></i> Índice de Cintura - Altura (ICA)
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

  <script type="text/javascript">

          var blood_pressures = <?php echo $blood_pressures; ?>;
          var pesos = <?php echo $pesos; ?>;
          var cinturas = <?php echo $cinturas; ?>;

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

          }
          else{

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
                  smooth: false,
              });
          }
          if(pesos.length == 0){

              Morris.Line({
                  element: 'morris-lineal-weight',
                  data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
                  xkey: 'label',
                  ykeys: ['value'],
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
              });

              Morris.Line({
                  element: 'morris-lineal-imc',
                  data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
                  xkey: 'label',
                  ykeys: ['value'],
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
              });
          }
          else{

              Morris.Line({
                  element: 'morris-lineal-weight',
                  data: pesos,
                  xkey: 'created_at',
                  xLabels: 'day',
                  ykeys: ['peso'],
                  labels: ['Peso'],
                  pointSize: 8,
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
                  smooth: false,
                  yLabelFormat: function(y) {return y = y.toFixed(2);},
              });

              Morris.Line({
                  element: 'morris-lineal-imc',
                  data: pesos,
                  xkey: 'created_at',
                  xLabels: 'day',
                  ykeys: ['imc'],
                  labels: ['IMC'],
                  lineColors: ['#673AB7'],
                  pointFillColors: ['#7E57C2'],
                  pointSize: 8,
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
                  smooth: false,
                  yLabelFormat: function(y) {return y = y.toFixed(2);},
              });
          }

          if (cinturas.length == 0 ){

              Morris.Line({
                  element: 'morris-lineal-cintura',
                  data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
                  xkey: 'label',
                  ykeys: ['value'],
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
              });

              Morris.Line({
                  element: 'morris-lineal-ica',
                  data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
                  xkey: 'label',
                  ykeys: ['value'],
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
              });

          }
          else{

              Morris.Line({
                  element: 'morris-lineal-cintura',
                  data: cinturas,
                  xkey: 'created_at',
                  xLabels: 'day',
                  ykeys: ['cintura'],
                  labels: ['Cinturas'],
                  pointSize: 8,
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
                  smooth: false,
                  yLabelFormat: function(y) {return y = y.toFixed(2);},

              });

              Morris.Line({
                  element: 'morris-lineal-ica',
                  data: cinturas,
                  xkey: 'created_at',
                  xLabels: 'day',
                  ykeys: ['ica'],
                  labels: ['ICA'],
                  lineColors: ['#673AB7'],
                  pointFillColors: ['#7E57C2'],
                  pointSize: 8,
                  hideHover: 'auto',
                  resize: true,
                  ymin: 'auto',
                  smooth: false,
                  yLabelFormat: function(y) {return y = y.toFixed(2);},
              });
          }

  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.amihealth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
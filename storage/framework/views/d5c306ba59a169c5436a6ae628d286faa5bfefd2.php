<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tendencias de Temperaturas</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-line-chart fa-fw"></i> Temperatura
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-lineal-temperature"></div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>

    <!-- /.row -->
    <script type="text/javascript">
        var temperatura = <?php echo $temperaturas; ?>;

        if(temperatura.length == 0){
            Morris.Line({
                element: 'morris-lineal-temperature',
                data: [{"label":"DATOS NO DISPONIBLES", "value":"100"}],
                xkey: 'label',
                ykeys: ['value'],
                hideHover: 'auto',
                resize: true,
                ymin: 'auto',
            });

        }else{
            Morris.Line({
                element: 'morris-lineal-temperature',
                data: temperatura,
                xkey: 'created_at',
                xLabels: 'day',
                ykeys: ['temperatura'],
                labels: ['Temperatura'],
                lineColors: ['#33691E'],
                pointFillColors: ['#558B2F'],
                pointSize: 8,
                hideHover: 'auto',
                resize: true,
                ymin: 'auto',
                smooth: false,
                yLabelFormat: function(y) {return y = y.toFixed(1);},
            });

        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amihealth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
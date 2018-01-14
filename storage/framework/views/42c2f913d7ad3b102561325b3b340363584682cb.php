<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tendencias de Índice Cintura - Altura</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-line-chart fa-fw"></i> Cintura
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-lineal-cintura"></div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-line-chart fa-fw"></i> Índice Cintura - Altura
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
        var cintura = JSON.parse('<?php echo $cintura; ?>');

        if(cintura.length === 0){

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
                data: cintura,
                xkey: 'created_at',
                xLabels: 'day',
                ykeys: ['cintura'],
                labels: ['Cintura'],
                lineColors: ['#33691E'],
                pointFillColors: ['#558B2F'],
                pointSize: 8,
                hideHover: 'auto',
                resize: true,
                ymin: 'auto',
                smooth: false,
                yLabelFormat: function(y) {return y = y.toFixed(2);},
            });

            Morris.Line({
                element: 'morris-lineal-ica',
                data: cintura,
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
<?php $__env->startSection('content'); ?>
    <link href="/css/event.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Paciente: <?php echo e($user->nombre . ' ' .$user->apellido . ', ' .$user->cedula); ?> <a class="pull-right btn btn-primary" href="/show-patients" role="button"><i class="right fa fa-arrow-left" aria-hidden="true"></i> Regresar</a></h1>

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
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('warning')): ?>
                    <div class="alert alert-warning">
                        <?php echo e(session('warning')); ?>

                    </div>
                <?php endif; ?>
                <div class="col-xs-12">
                    <?php if(count($blood_pressures) >= 1): ?>
                        <?php $__currentLoopData = $blood_pressures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blood_pressure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <ul class="event-list">
                                <li>
                                    <time style="background:<?php echo e($blood_pressure->rgb); ?>"datetime="<?php echo e($blood_pressure->created_at->format('Y-m-d')); ?>">
                                        <span class="day"><?php echo e($blood_pressure->created_at->format('d')); ?></span>
                                        <span class="month"><?php echo e($blood_pressure->created_at->format('M')); ?></span>
                                        <span class="year"><?php echo e($blood_pressure->created_at->format('Y')); ?></span>
                                    </time>
                                    <time style="background-color:<?php echo e($blood_pressure->rgb); ?>;opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>SYS</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;"><?php echo e($blood_pressure->SYS); ?></h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">mmHg</div>
                                    </time>
                                    <time style="background-color:<?php echo e($blood_pressure->rgb); ?>; opacity: 0.85">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>DIS</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;"><?php echo e($blood_pressure->DIS); ?></h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">mmHg</div>
                                    </time>
                                    <time style="background-color:<?php echo e($blood_pressure->rgb); ?>; opacity: 0.8">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Pulso</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;"><?php echo e($blood_pressure->pulso); ?></h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">Bpm</div>
                                    </time>
                                    <div class="info">
                                        <h2 class="title"><?php echo e($blood_pressure->descrip); ?></h2>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li class="facebook" style="width:33%;"><a href="/edit-hta-by-doc/<?php echo e($blood_pressure->id); ?>"><span class="fa fa-pencil"></span></a></li>
                                            <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal1"><span class="fa fa-info"></span></a></li>
                                            <li class="google-plus" style="width:33%;"><a href="/delete-hta-by-doc/<?php echo e($blood_pressure->id); ?>"><span class="fa fa-trash"></span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="event-details">
                                    <div class="info" style="height:auto">
                                        <p class="desc"><?php echo e(ucwords($blood_pressure->created_at->format('l d, F Y, h:i A'))); ?></p>
                                    </div>
                                </li>
                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php echo e($blood_pressures->links()); ?>


                            <div class="col-xs-12">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-hta/<?php echo e($user->id); ?>">Agregar Nueva Medida</a>
                            </div>
                    <?php else: ?>
                        <div class="form-group">
                            <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                                <p class="bg-warning text-center">No hay Medidas de Presión Arterial disponibles</p>
                            </div>

                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-hta/<?php echo e($user->id); ?>">Agregar Nueva Medida</a>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
            <!-- /.div -->

            <div id="weights" class="tab-pane fade">
                <br>
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('warning')): ?>
                    <div class="alert alert-warning">
                        <?php echo e(session('warning')); ?>

                    </div>
                <?php endif; ?>
                <div class="col-xs-12">
                    <?php if(count($weights) >= 1): ?>
                        <?php $__currentLoopData = $weights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <ul class="event-list">
                                <li>
                                    <time style="background:<?php echo e($weight->rgb); ?>"datetime="<?php echo e($weight->created_at->format('Y-m-d')); ?>">
                                        <span class="day"><?php echo e($weight->created_at->format('d')); ?></span>
                                        <span class="month"><?php echo e($weight->created_at->format('M')); ?></span>
                                        <span class="year"><?php echo e($weight->created_at->format('Y')); ?></span>
                                    </time>
                                    <time style="background-color:<?php echo e($weight->rgb); ?>;opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Peso</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;"><?php echo e($weight->peso); ?></h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">Kg</div>
                                    </time>
                                    <time style="background-color:<?php echo e($weight->rgb); ?>; opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>IMC</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;"><?php echo e($weight->imc); ?></h1></span>

                                    </time>
                                    <div class="info">
                                        <h2 class="title"><?php echo e($weight->descrip); ?></h2>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li class="facebook" style="width:33%;"><a href="/edit-weight-by-doc/<?php echo e($weight->id); ?>"><span class="fa fa-pencil"></span></a></li>
                                            <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal2"><span class="fa fa-info"></span></a></li>
                                            <li class="google-plus" style="width:33%;"><a href="/delete-weight-by-doc/<?php echo e($weight->id); ?>"><span class="fa fa-trash"></span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="event-details">
                                    <div class="info" style="height:auto">
                                        <p class="desc"><?php echo e(ucwords($weight->created_at->format('l d, F Y, h:i A'))); ?></p>
                                    </div>
                                </li>
                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php echo e($weights->links()); ?>


                            <div class="col-xs-12">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-weight-by-doc/<?php echo e($user->id); ?>">Agregar Nueva Medida</a>
                            </div>

                    <?php else: ?>
                        <div class="form-group">
                            <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                                <p class="bg-warning text-center">No hay medidas de peso disponibles</p>
                            </div>

                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-weight-by-doc/<?php echo e($user->id); ?>">Agregar Nuevo Peso</a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- /.div -->

            <div id="waists" class="tab-pane fade">
                <br>
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('warning')): ?>
                    <div class="alert alert-warning">
                        <?php echo e(session('warning')); ?>

                    </div>
                <?php endif; ?>
                <div class="col-xs-12">
                    <?php if(count($waists) >= 1): ?>
                        <?php $__currentLoopData = $waists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <ul class="event-list">
                                <li>
                                    <time style="background:<?php echo e($waist->rgb); ?>"datetime="<?php echo e($waist->created_at->format('Y-m-d')); ?>">
                                        <span class="day"><?php echo e($waist->created_at->format('d')); ?></span>
                                        <span class="month"><?php echo e($waist->created_at->format('M')); ?></span>
                                        <span class="year"><?php echo e($waist->created_at->format('Y')); ?></span>
                                    </time>
                                    <time style="background-color:<?php echo e($waist->rgb); ?>;opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Cintura</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;"><?php echo e($waist->cintura); ?></h1></span>
                                        <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">cm</div>
                                    </time>
                                    <time style="background-color:<?php echo e($waist->rgb); ?>; opacity: 0.9">
                                        <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>ICA</label></h3></span>
                                        <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;"><?php echo e($waist->ica); ?></h1></span>

                                    </time>
                                    <div class="info">
                                        <h2 class="title"><?php echo e($waist->descrip); ?></h2>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li class="facebook" style="width:33%;"><a href="/edit-waist-by-doc/<?php echo e($waist->id); ?>"><span class="fa fa-pencil"></span></a></li>
                                            <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal3"><span class="fa fa-info"></span></a></li>
                                            <li class="google-plus" style="width:33%;"><a href="/delete-waist-by-doc/<?php echo e($waist->id); ?>"><span class="fa fa-trash"></span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="event-details">
                                    <div class="info" style="height:auto">
                                        <p class="desc"><?php echo e(ucwords($waist->created_at->format('l d, F Y, h:i A'))); ?></p>
                                    </div>
                                </li>
                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php echo e($waists->links()); ?>


                            <div class="col-xs-12">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-waist-by-doc/<?php echo e($user->id); ?>">Agregar Nueva Medida de Cintura</a>
                            </div>

                    <?php else: ?>
                        <div class="form-group">
                            <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                                <p class="bg-warning text-center">No hay medidas de peso disponibles</p>
                            </div>

                            <div class="col-xs-12 col-md-8 col-md-offset-2">
                                <a class="btn btn-primary btn-lg btn-block" href="/new-waist-by-doc/<?php echo e($user->id); ?>">Agregar Nueva Medida de Cintura</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /.div -->

            <div id="profile" class="tab-pane fade">
                <br>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3> Perfil de <?php echo e($user->nombre); ?> </h3></div>

                            <div class="panel-body">
                                <?php if(session('status')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                <?php endif; ?>
                                <?php if(session('warning')): ?>
                                    <div class="alert alert-warning">
                                        <?php echo e(session('warning')); ?>

                                    </div>
                                <?php endif; ?>

                                        <form class="form-horizontal" role="form" method="POST" action="/profile"  enctype="multipart/form-data" data-toggle="validator">
                                            <?php echo e(csrf_field()); ?>


                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="img" class="col-md-4 control-label">Foto de Perfil</label>

                                                    <div class="col-md-6">
                                                        <img src="/uploads/avatars/<?php echo e($user->img); ?>" style="width:100px; height:100px; float:left; border-radius:50%; margin-right:25px;">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nombre" class="col-md-4 control-label">Nombre</label>

                                                    <div class="col-md-6">
                                                        <input id="nombre" type="text" class="form-control" name="nombre" value="<?php echo e($user->nombre); ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="apellido" class="col-md-4 control-label">Apellido</label>

                                                    <div class="col-md-6">
                                                        <input id="apellido" type="text" class="form-control" name="apellido" value="<?php echo e($user->apellido); ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="apellido" class="col-md-4 control-label">Fecha de Nacimeinto</label>

                                                    <div class="col-md-6">
                                                        <input type='text' id="fecha" class="form-control" name="fecha_nacimiento" value="<?php echo e($paciente->fecha_nacimiento); ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edad" class="col-md-4 control-label">Edad</label>

                                                    <div class="col-md-6">
                                                        <input id="edad" type="text" class="form-control" name="apellido" value="<?php echo e($paciente->age); ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edad" class="col-md-4 control-label">Dirección</label>

                                                    <div class="col-md-6">
                                                        <input id="direccion" type="text" class="form-control" name="direccion" value="<?php echo e($paciente->direccion); ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edad" class="col-md-4 control-label">Móvil</label>

                                                    <div class="col-md-6">
                                                        <input id="movil" type="text" class="form-control" name="movil" value="<?php echo e($paciente->movil); ?>" disabled>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- ./div col-md-6 -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="etnia" class="col-md-4 control-label">Etnia</label>

                                                    <div class="col-md-6">
                                                        <input id="etnia" type="text" class="form-control" name="etnia" value="<?php echo e($paciente->id_etnia); ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <label for="sexo" class="col-md-4 control-label">Género</label>

                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="sexo"
                                                               <?php if($paciente->sexo == false): ?>
                                                               value="Mujer" disabled
                                                               <?php endif; ?>
                                                               <?php if($paciente->sexo == true): ?>
                                                               value="Hombre" disabled
                                                                <?php endif; ?>
                                                        >
                                                    </div>
                                                </div>

                                                <div class="form-group<?php echo e($errors->has('estatura') ? ' has-error' : ''); ?>">
                                                    <label for="estatura" class="col-md-4 control-label">Estatura (cm)</label>

                                                    <div class="col-md-4">
                                                        <input id="estatura" type="number" class="form-control numbers" name="estatura" placeholder="<?php echo e($estatura->estatura); ?>" value="<?php echo e(old('estatura')); ?>">

                                                        <?php if($errors->has('estatura')): ?>
                                                            <span class="help-block">
                                                         <strong><?php echo e($errors->first('estatura')); ?></strong>
                                                    </span>
                                                        <?php endif; ?>
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


    <link href="<?php echo e(asset('/dist/css/datetimepicker.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('/dist/js/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('/dist/js/datetimepicker.js')); ?>"></script>

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

    <?php echo $__env->make('doctor.modals-info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('doctor.graph-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.doctor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
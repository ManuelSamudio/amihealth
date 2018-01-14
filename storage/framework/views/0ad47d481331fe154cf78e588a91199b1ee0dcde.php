<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Doctores</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Agregar Nuevo Doctor(a)</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="store-doctor" data-toggle="validator">
                            <?php echo e(csrf_field()); ?>

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

                            <div class="form-group<?php echo e($errors->has('ced', 'tomo', 'asiento') ? ' has-error' : ''); ?>">
                                <label for="name" class="col-md-4 control-label">Cédula</label>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group now">
                                        <div class="col-xs-3">

                                            <select id='ced' name='ced' class="form-control" value="<?php echo e(old('ced')); ?>" required autofocus>
                                                <?php $__currentLoopData = $provincias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provincia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($provincia->id_provincia); ?>"><?php echo e($provincia->id_provincia); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <option value="AV">AV</option>
                                                <option value="E">E</option>
                                                <option value="N">N</option>
                                                <option value="PE">PE</option>
                                                <option value="PI">PI</option>
                                                <option value="SB">SB</option>
                                            </select>

                                        </div>

                                        <div class="col-xs-4 col-sm-4 col-md-4">
                                            <input  type="number" class="form-control" id="tomo" name="tomo" value="<?php echo e(old('tomo')); ?>" required autofocus>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <label for="asiento" class="col-xs-1">_</label>
                                        <div class="col-xs-4  col-sm-4 col-md-4">
                                            <input  type="number" class="form-control" id="asiento" name="asiento" value="<?php echo e(old('asiento')); ?>" required autofocus>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <?php if($errors->has('ced')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('cedula')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    <?php if($errors->has('tomo')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('tomo')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                    <?php if($errors->has('asiento')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('asiento')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo e($errors->has('idoneidad') ? ' has-error' : ''); ?>">
                                <label for="nombre" class="col-md-4 control-label">Idoneidad</label>

                                <div class="col-md-6">
                                    <input id="idoneidad" type="text" class="form-control" name="idoneidad" value="<?php echo e(old('idoneidad')); ?>" required autofocus>
                                    <div class="help-block with-errors"></div>
                                    <?php if($errors->has('idoneidad')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('idoneidad')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo e($errors->has('nombre') ? ' has-error' : ''); ?>">
                                <label for="nombre" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control" name="nombre" value="<?php echo e(old('nombre')); ?>" required autofocus>
                                    <div class="help-block with-errors"></div>
                                    <?php if($errors->has('nombre')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('nombre')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo e($errors->has('apellido') ? ' has-error' : ''); ?>">
                                <label for="apellido" class="col-md-4 control-label">Apellido</label>

                                <div class="col-md-6">
                                    <input id="apellido" type="text" class="form-control" name="apellido" value="<?php echo e(old('apellido')); ?>" required autofocus>
                                    <div class="help-block with-errors"></div>
                                    <?php if($errors->has('apellido')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('apellido')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" data-error="Este correo electrónico es inválido" required autofocus>
                                    <div class="help-block with-errors"></div>
                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                          <strong><?php echo e($errors->first('email')); ?></strong>
                                      </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Regístrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
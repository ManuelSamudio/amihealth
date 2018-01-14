<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cambiar Contraseña</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Actualizar <a class="pull-right btn btn-primary" href="/" role="button"><i class="right fa fa-arrow-left" aria-hidden="true"></i> Regresar</a></h3></div>

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

                    <form class="form-horizontal" role="form" method="POST" action="/update-password"  enctype="multipart/form-data" data-toggle="validator">

                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('current_password') ? ' has-error' : ''); ?>">
                            <label for="current_password" class="col-md-4 control-label">Contraseña anterior</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" value="<?php echo e(old('current_password')); ?>" required>
                                <div class="help-block with-errors"></div>
                                <?php if($errors->has('current_password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('current_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="off" required>
                                <div class="help-block with-errors"></div>
                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off" data-match="#password" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-success btn-block">Actualizar</button>
                            </div>
                        </div>
                    </form>
                    <!-- end form -->

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.amihealth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
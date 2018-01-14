<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro de Cuenta Confirmado</div>
                    <div class="panel-body">
                        Su Correo Electrónico se verificó correctamente. Haga clic aquí para <a href="<?php echo e(url('/login')); ?>">Iniciar Sessión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
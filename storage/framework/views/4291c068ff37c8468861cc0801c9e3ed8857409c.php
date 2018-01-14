<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cintura</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo medida de  cintura</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="store-waist" data-toggle="validator">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group<?php echo e($errors->has('cintura') ? ' has-error' : ''); ?>">
                            <label for="cintura" class="col-md-4 control-label">Cintura (cm)</label>

                            <div class="col-md-4">
                                <input id="cintura" type="number" step="0.1"class="form-control" name="cintura" value="<?php echo e(old('cintura')); ?>" required autofocus>
                                <div class="help-block with-errors"></div>
                                <?php if($errors->has('cintura')): ?>
                                    <span class="help-block">
                                          <strong><?php echo e($errors->first('cintura')); ?></strong>
                                      </span>
                                <?php endif; ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.amihealth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
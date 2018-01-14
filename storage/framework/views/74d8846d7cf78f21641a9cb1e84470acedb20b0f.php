<?php $__env->startSection('content'); ?>
    <link href="/css/event.css" rel="stylesheet">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Lista de Temperaturas</h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="row">
            <div class="col-xs-12 col-md-offset-2 col-md-8">

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

                <?php if(count($temperatures) >= 1): ?>
                    <?php $__currentLoopData = $temperatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temperature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <ul class="event-list">
                            <li>
                                <time style="background:<?php echo e($temperature->rgb); ?>"datetime="<?php echo e($temperature->created_at->format('Y-m-d')); ?>">
                                    <span class="day"><?php echo e($temperature->created_at->format('d')); ?></span>
                                    <span class="month"><?php echo e($temperature->created_at->format('M')); ?></span>
                                    <span class="year"><?php echo e($temperature->created_at->format('Y')); ?></span>
                                </time>
                                <time style="background-color:<?php echo e($temperature->rgb); ?>;opacity: 0.9">
                                    <span class="month"style="color:#fff"><h3 style="margin-bottom:0px; margin-top:20px;"><label>Temp</label></h3></span>
                                    <span class="day" style="color:#fff"><h1  style="margin-bottom:0px; margin-top:0px;"><?php echo e($temperature->temperatura); ?></h1></span>
                                    <div style="text-transform: none; letter-spacing: 2px;font-style: italic;">Cº</div>
                                </time>
                                <div class="info">
                                    <h2 class="title"><?php echo e($temperature->descrip); ?></h2>
                                </div>
                                <div class="social">
                                    <ul>
                                        <li class="facebook" style="width:33%;"><a href="edit-temperature/<?php echo e($temperature->id); ?>"><span class="fa fa-pencil"></span></a></li>
                                        <li class="twitter" style="width:34%;"><a href="" data-toggle="modal" data-target="#myModal"><span class="fa fa-info"></span></a></li>
                                        <li class="google-plus" style="width:33%;"><a href="delete-temperature/<?php echo e($temperature->id); ?>"><span class="fa fa-trash"></span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="event-details">
                                <div class="info" style="height:auto">
                                    <p class="desc"><?php echo e(ucwords($temperature->created_at->format('l d, F Y, h:i A'))); ?></p>
                                </div>
                            </li>
                        </ul>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($temperatures->links()); ?>


                <?php else: ?>
                    <div class="form-group">
                        <div class="alert alert-warning col-xs-12 col-md-8 col-md-offset-2">
                            <p class="bg-warning text-center">No hay medidas de peso disponibles</p>
                        </div>

                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <a class="btn btn-primary btn-lg btn-block" href="/new-temperature">Agregar nueva temperatura</a>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Temperatura</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Clasificación</th>
                                <th>Rango</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Hipotermia</th>
                                <th>< 35</th>
                                <th></th>
                                <th style="background-color: #B71C1C"></th>
                            </tr>
                            <tr>
                                <th>Temperatura levemente baja</th>
                                <th>35 - 36.4</th>
                                <th></th>
                                <th style="background-color: #FFAB00"></th>
                            </tr>
                            <tr>
                                <th>Temperatura normal</th>
                                <th>36.5 - 37.5</th>
                                <th></th>
                                <th style="background-color: #33691E"></th>
                            </tr>
                            <tr>
                                <th>Fiebre</th>
                                <th>37.6 - 38.3</th>
                                <th></th>
                                <th style="background-color: #FFAB00"></th>
                            </tr>
                            <tr>
                                <th>Hipertermia</th>
                                <th>38.4 - 39.9</th>
                                <th></th>
                                <th style="background-color: #EF6C00"></th>
                            </tr>
                            <tr>
                                <th>Hiperpirexia</th>
                                <th>≥ 40</th>
                                <th></th>
                                <th style="background-color: #B71C1C"></th>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.event-details').css('display','none');
                $('.event-details').css('height','auto');
                $('.event-details').css('margin-top','-17px');
                $('.event-details > .info').css('height','auto');
                $('.disabled').prev().css('cursor','default');

                $('.event-list > li').click(function() {
                    if (!$(this).nextAll('.event-details').first().hasClass('disabled')) {
                        //$(this).nextAll('.event-details').first().height('auto');
                        $(this).nextAll('.event-details').first().nextAll('.info').first().height('auto');
                        $(this).nextAll('.event-details').first().slideToggle();
                    }
                });
            })
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.amihealth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
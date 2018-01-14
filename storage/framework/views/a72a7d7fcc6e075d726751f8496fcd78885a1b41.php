<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Regístrate</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('register')); ?>" data-toggle="validator">
                        <?php echo e(csrf_field()); ?>


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

                                    <div class="col-xs-3 col-md-4">
                                      <input  type="number" class="form-control" id="tomo" name="tomo" value="<?php echo e(old('tomo')); ?>" required autofocus>
                                      <div class="help-block with-errors"></div>
                                    </div>
                                  <label for="asiento" class="col-xs-1">_</label>
                                    <div class="col-xs-4 col-md-4">
                                      <input  type="number" class="form-control" id="asiento" name="asiento" value="<?php echo e(old('asiento')); ?>" required autofocus>
                                      <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <?php if($errors->has('ced')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('ced')); ?></strong>
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

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="off" minlength=" 6" required autofocus>
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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off" data-match="#password" required autofocus>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('movil') ? ' has-error' : ''); ?>">
                            <label for="movil" class="col-md-4 control-label">Móvil</label>

                            <div class="col-md-6">
                                <input id="movil" type="text" class="form-control movil" name="movil" value="<?php echo e(old('movil')); ?>" maxlength="15" required autofocus>
                                <div class="help-block with-errors"></div>
                                <?php if($errors->has('movil')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('movil')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('direccion') ? ' has-error' : ''); ?>">
                            <label for="direccion" class="col-md-4 control-label">Dirección</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="<?php echo e(old('direccion')); ?>" required autofocus>

                                <?php if($errors->has('direccion')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('direccion')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('fecha_nacimiento') ? ' has-error' : ''); ?>">
                            <label for="fecha_nacimiento" class="col-md-4 control-label">Fecha de Nacimiento</label>

                            <div class="col-md-6" style="height:130px;">
                              <div class='input-group date' id="fecha_nacimiento">
                                      <input type='text' id="fecha" class="form-control"name="fecha_nacimiento" value="<?php echo e(old('fecha_nacimiento')); ?>" required autofocus onkeydown="return false"/>
                                      <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                      </span>
                              </div>

                                <?php if($errors->has('fecha_nacimiento')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('fecha_nacimiento')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('sexo') ? ' has-error' : ''); ?>">
                            <label for="sexo" class="col-md-4 control-label">Género</label>

                            <div class="col-md-6">

                                <select id='sexo' name='sexo' class="form-control" value="<?php echo e(old('sexo')); ?>" required autofocus>
                                    <option value=""selected disabled>-Seleccionar un género -</option>
                                    <option value="0">Mujer</option>
                                    <option value="1">Hombre</option>
                                </select>
                                <?php if($errors->has('sexo')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('sexo')); ?></strong>
                                    </span>
                                <?php endif; ?>
                              </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('id_provincia') ? ' has-error' : ''); ?>">
                            <label for="id_provincia" class="col-md-4 control-label">Provincia</label>

                            <div class="col-md-6">
                              <select id='id_provincia' name='id_provincia' class=" id_provincia form-control" value="<?php echo e(old('id_provincia')); ?>" required autofocus>
                                  <option value="0" disabled="true" selected="true">-Seleccionar una provincia-</option>
                                  <?php $__currentLoopData = $provincias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provincia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($provincia->id_provincia); ?>"><?php echo e($provincia->nombre); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              <?php if($errors->has('id_provincia')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('id_provincia')); ?></strong>
                                  </span>
                              <?php endif; ?>
                            </div>
                        </div>
                        <div class="id_distrito form-group<?php echo e($errors->has('id_distrito') ? ' has-error' : ''); ?>">
                            <label for="id_distrito" class="col-md-4 control-label">Distrito</label>

                            <div class="col-md-6">
                              <select id='id_distrito' name='id_distrito' class="id_distrito form-control" value="<?php echo e(old('id_distrito')); ?>" required autofocus>
                                  <option value="0" disabled="true" selected="true">-Seleccionar un distrito-</option>
                              </select>
                              <?php if($errors->has('id_distrito')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('id_distrito')); ?></strong>
                                  </span>
                              <?php endif; ?>
                            </div>
                        </div>
                        <div class="id_corregimiento form-group<?php echo e($errors->has('id_corregimiento') ? ' has-error' : ''); ?>">
                            <label for="id_corregimiento" class="col-md-4 control-label">Corregimiento</label>

                            <div class="col-md-6">
                              <select id='id_corregimiento' name='id_corregimiento' class="id_corregimiento form-control" value="<?php echo e(old('id_corregimiento')); ?>" required autofocus>
                                  <option value="0" disabled="true" selected="true">-Seleccionar un corregimiento-</option>
                              </select>
                              <?php if($errors->has('id_corregimiento')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('id_corregimiento')); ?></strong>
                                  </span>
                              <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('id_etnia') ? ' has-error' : ''); ?>">
                            <label for="id_etnia" class="col-md-4 control-label">Etnia</label>

                            <div class="col-md-6">
                              <select id='id_etnia' name='id_etnia' class="form-control" value="<?php echo e(old('id_etnia')); ?>" required autofocus>
                                  <option value="0" disabled="true" selected="true">-Seleccionar una etnia-</option>
                                  <?php $__currentLoopData = $etnias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etnia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($etnia->id); ?>"><?php echo e($etnia->nombre); ?></option>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              <?php if($errors->has('id_etnia')): ?>
                                  <span class="help-block">
                                      <strong><?php echo e($errors->first('id_etnia')); ?></strong>
                                  </span>
                              <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('estatura') ? ' has-error' : ''); ?>">
                            <label for="estatura" class="col-md-4 control-label">Estatura (cm)</label>

                            <div class="col-md-6">
                                <input id="estatura" type="number" class="form-control estatura" name="estatura" value="<?php echo e(old('estatura')); ?>" required>

                                <?php if($errors->has('estatura')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('estatura')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('peso') ? ' has-error' : ''); ?>">
                            <label for="peso" class="col-md-4 control-label">Peso (kg)</label>

                            <div class="col-md-6">
                                <input id="peso" type="number" class="form-control peso" name="peso" value="<?php echo e(old('peso')); ?>" required>

                                <?php if($errors->has('peso')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('peso')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('terms') ? ' has-error' : ''); ?>">
                            <label for="terms" class="col-md-4 control-label">Términos y Condiciones</label>

                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="terms" value="true" <?php echo e(!old('terms') ?: 'checked'); ?> required> Acepto
                                        <a href="/terms-and-conditions">términos y condiciones</a>
                                    </label>
                                </div>


                                <?php if($errors->has('terms')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('terms')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Regístrate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="<?php echo e(asset('/dist/css/datetimepicker.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('/dist/js/moment.js')); ?>"></script>
<script src="<?php echo e(asset('/dist/js/datetimepicker.js')); ?>"></script>


<script type="text/javascript">
      $(document).ready(function(){

          $('.movil').mask('9999-9999');
      });

      $(function () {//datetimepicker input

             $('#fecha_nacimiento').datetimepicker({
                 maxDate: moment(),
                 viewMode: 'years',
                 format: 'YYYY/MM/DD'
             });
        });

      $('#fecha_nacimiento').on('dp.change',function(e) {//set datetimepicker data

               var yo = $('#fecha_nacimiento').find('input').val();
               $('#fecha').attr('value',yo);
      });

      document.querySelector(".estatura").addEventListener("keypress", function (evt) {
          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
          {
              evt.preventDefault();
          }
      });
      document.querySelector(".peso").addEventListener("keypress", function (evt) {
          if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
          {
              evt.preventDefault();
          }
      });

      $(document).on('change','.id_provincia', function(){//provincia dropdown

        var id_provincia=$(this).val();
        var div = $(this).parent();

        var op = " ";

        $.ajax({
              type: 'get',
              url:'<?php echo URL::to('ajax-distritos'); ?>',
              data:{'id_provincia':id_provincia},
              success:function(data){

                      op+='<option value="0" selected disabled>-Seleccionar Distritos-</option>';
                      for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].id_distrito+'">'+data[i].nombre+'</option>';
                      }
                $('#id_distrito').html(' ');
                $('#id_corregimiento').html('<option value="0" selected disabled>-Seleccionar Corregimiento-</option>');
                $('#id_distrito').html(op);

              },
              error:function() {

              }
        });
      });
      $(document).on('change','#id_distrito', function(){//distrito y corregimiento dropdown

        var id_distrito=$(this).val();
        var div = $(this).parent();

        var op = " ";

        $.ajax({
              type: 'get',
              url:'<?php echo URL::to('ajax-corregimientos'); ?>',
              data:{'id_distrito':id_distrito},
              success:function(data){
                      op+='<option value="0" selected disabled>-Seleccionar Corregimiento-</option>';
                      for(var i=0; i<data.length; i++){
                        op+='<option value="'+data[i].id_corregimiento+'">'+data[i].nombre+'</option>';
                      }
                $('#id_corregimiento').html(' ');
                $('#id_corregimiento').html(op);

              },
              error:function() {

              }
        });
      });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
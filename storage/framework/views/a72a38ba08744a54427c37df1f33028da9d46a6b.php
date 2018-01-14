<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AmIHEALTH: Desarrollo de una solución móvil para entornos de salud y dependencia. Caso de estudio en Hipertensión Arterial">
    <meta name="author" content="Manuel Samudio, Mel Nielsen, Vladimir Villareal">
    <meta name="keywords" content="amihealth, salud, hipertensión, saludmovil, healthcare">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name','AmIHEALTH')); ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href=" <?php echo e(asset('/template/bootstrap/css/bootstrap.min.css')); ?>" />

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- MetisMenu CSS -->
    <link href="<?php echo e(asset('/metisMenu/metisMenu.min.css')); ?>" rel="stylesheet"/>

    <!-- Custom CSS -->
    <link href="<?php echo e(asset('/dist/css/sb-admin-2.css')); ?>" rel="stylesheet"/>

    <!-- Morris Charts CSS -->
    <link href="<?php echo e(asset('/morrisjs/morris.css')); ?>" rel="stylesheet"/>

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script type="text/javascript" src="<?php echo e(asset('/dist/js/jquery.min.js')); ?>"></script>
<!--<script type="text/javascript" src="<?php echo e(asset('/template/jquery/jquery.min.js')); ?>"></script>-->
    <script type="text/javascript" src="<?php echo e(asset('/template/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/dist/js/validator.min.js')); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script type="text/javascript" src="<?php echo e(asset('/metisMenu/metisMenu.min.js')); ?>"></script>

    <!-- Morris Charts JavaScript -->
    <script type="text/javascript" src="<?php echo e(asset('/raphael/raphael.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('/morrisjs/morris.min.js')); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="<?php echo e(asset('/dist/js/sb-admin-2.js')); ?>"></script>

    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>;
    </script>
</head>
<body>
  <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" style="padding: inherit" href="<?php echo e(url('/')); ?>">
                    <img class="img-responsive" style="margin-left: 50px; margin-right: 50px;" width="160" height="50" src="/amihealth-logo.png" >
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                  <!-- Authentication Links -->
                  <?php if(Auth::guest()): ?>
                      <li><a href="<?php echo e(route('login')); ?>">Iniciar sesión</a></li>
                      <li><a href="<?php echo e(route('register')); ?>">Regístrate</a></li>
                  <?php else: ?>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                          <img src="/uploads/avatars/<?php echo e(Auth::user()->img); ?>" style="width:32px; height:32px; float:left; position:absolute; top:10px; left:10px; border-radius:50%; margin-right:25px;">
                          <?php echo e(Auth::user()->nombre); ?> <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu dropdown-user" role="menu">
                          <li>
                              <a href="<?php echo e(url('/profile')); ?>"><i class="fa fa-btn fa-user"></i> Perfil</a>
                          </li>
                          <li class="divider"></li>
                          <li>
                              <a href="<?php echo e(route('logout')); ?>"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"><i class="fa fa-btn fa-sign-out"></i> Cerrar Sessión
                              </a>

                              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                  <?php echo e(csrf_field()); ?>

                              </form>
                          </li>
                      </ul>
                  </li>
                  <?php endif; ?>
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="/home"><i class="fa fa-dashboard fa-fw" class="active"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-heartbeat fa-fw"></i> Presion Arterial<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/new-measurement"><i class="fa fa-plus-circle fa-fw"></i> Añadir nueva presión arterial</a>
                                </li>
                                <li>
                                    <a href="/show-measurements"><i class="fa fa-list-ul fa-fw"></i> Lista de medidas</a>
                                </li>
                                <li>
                                    <a href="/trends-of-blood-pressure"><i class="fa fa-bar-chart fa-fw"></i> Tendencias de presión arterial</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href=""><i class="fa fa-balance-scale fa-fw"></i> Peso<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/new-weight"><i class="fa fa-plus-circle fa-fw"></i> Añadir nuevo peso</a>
                                </li>
                                <li>
                                    <a href="/show-weights"><i class="fa fa-list-ul fa-fw"></i> Lista de pesos</a>
                                </li>
                                <li>
                                    <a href="/trends-of-weights"><i class="fa fa-bar-chart fa-fw"></i> Tendencias de pesos</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href=""> <i class="fa fa-line-chart fa-fw"></i> Índice cintura - altura<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/new-waist"><i class="fa fa-plus-circle fa-fw"></i>Añadir nueva medida</a>
                                </li>
                                <li>
                                    <a href="/show-waist"><i class="fa fa-list-ul fa-fw"></i> Lista de medidas</a>
                                </li>
                                <li>
                                    <a href="/trends-of-waist"><i class="fa fa-bar-chart fa-fw"></i> Tendencias de ICA</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-cog fa-fw"></i> Configuraciones<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="#"><i class="fa fa-user fa-tw"></i> Perfil<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/profile"><i class="fa fa-angle-right fa-fw"></i> Editar perfil</a>
                                        </li>
                                        <li>
                                            <a href="/change-password"><i class="fa fa-angle-right fa-fw"></i> Cambiar Contraseña</a>
                                        </li>

                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-question-circle"></i> Ayuda<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/terms-and-conditions"><i class="fa fa-angle-right fa-fw"></i> Términos y Condiciones</a>
                                        </li>
                                        <li>
                                            <a href="/privicy-policy"><i class="fa fa-angle-right fa-fw"></i> Política de Privacidad</a>
                                        </li>
                                        <li>
                                            <a href="/disclaimer"><i class="fa fa-angle-right fa-fw"></i> Disclaimer</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="https://goo.gl/forms/Cuk8nuAv8sgxBAeF2" target="_blank"><i class="fa fa-life-ring fa-fw"></i> Sugerencias</a>
                        </li>

                      </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

  </div>
</body>
</html>

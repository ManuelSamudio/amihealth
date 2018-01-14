<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AmIHEALTH: Desarrollo de una solución móvil para entornos de salud y dependencia. Caso de estudio en Hipertensión Arterial">
    <meta name="author" content="Manuel Samudio, Mel Nielsen, Vladimir Villareal">
    <meta name="keywords" content="amihealth, salud, hipertensión, saludmovil, healthcare">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name','AmIHEALTH') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href=" {{ asset('/template/bootstrap/css/bootstrap.min.css')}}" />

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
    <link href="{{ asset('/metisMenu/metisMenu.min.css') }}" rel="stylesheet"/>

    <!-- DataTables CSS -->
    <link href="{{ asset ('/template/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('/template/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('/dist/css/sb-admin-2.css')}}" rel="stylesheet"/>

    <!-- Morris Charts CSS -->
    <link href="{{asset('/morrisjs/morris.css')}}" rel="stylesheet"/>

    <!-- Custom Fonts -->
    <link  href="{{ asset('/template/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('/template/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/template/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script type="text/javascript" src="{{ asset('/metisMenu/metisMenu.min.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ asset('/template/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/template/datatables-plugins/dataTables.bootstrap.min.js') }} "></script>
    <script src="{{ asset('/template/datatables-responsive/dataTables.responsive.js') }} "></script>

    <!-- Morris Charts JavaScript -->
    <script type="text/javascript" src="{{ asset('/raphael/raphael.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/morrisjs/morris.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="{{ asset('/dist/js/sb-admin-2.js') }}"></script>

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};
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

            <a class="navbar-brand" style="padding: inherit" href="{{ url('/') }}">
                <img class="img-responsive" style="margin-left: 50px;  margin-right: 50px;" width="160" height="50" src="/amihealth-logo.png" >
            </a>
            <a class="navbar-brand"  style="padding: inherit; margin-right: 50px;" href="http://www.utp.ac.pa">
                <img class="img-responsive" width="50" height="50" src="/img/logo_utp.png" >
            </a>
            <a class="navbar-brand" style="padding: inherit; mix-blend-mode: multiply; margin-right: 50px;" href="http://www.senacyt.gob.pa/">
                <img class="img-responsive" width="150" height="50" src="/img/senacyt-logo.png" >
            </a>

        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">

            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                <li><a href="{{ route('register') }}">Regístrate</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
                        <img src="/uploads/avatars/{{ Auth::user()->img}}" style="width:32px; height:32px; float:left; position:absolute; top:10px; left:10px; border-radius:50%; margin-right:25px;">
                        {{ Auth::user()->nombre }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"><i class="fa fa-btn fa-sign-out"></i> Cerrar Sessión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="/home"><i class="fa fa-dashboard fa-fw" class="active"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-user-md fa-fw"></i> Doctores<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/new-doctor"><i class="fa fa-plus-circle fa-fw"></i>Agregar Nuevo Doctor</a>
                            </li>
                            <li>
                                <a href="/show-doctors"><i class="fa fa-list-ul fa-fw"></i>Lista de Doctores</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-area-chart fa-fw"></i> Estadísticas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-life-ring fa-fw"></i> Soporte</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cogs fa-fw"></i> Configuraciones</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-envelope fa-fw"></i> Contactanos</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        @yield('content')
    </div>

</div>
</body>
</html>

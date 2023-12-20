<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/demo/bs4/Template/layout_1/LTR/default/full/table_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 02 Nov 2019 03:14:27 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Diagramador c4 model</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('global_assets/css/icons/icomoon/styles.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset('global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->
    <script src="{{asset('global_assets/js/demo_pages/form_select2.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/extensions/jquery_ui/interactions.min.js')}}"></script>
    <script src="{{asset('global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <!-- Theme JS files -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <!-- /theme JS files -->
    @stack('styles')
</head>

<body>

    <!-- Main navbar -->
    <div class="navbar navbar-expand-md navbar-dark 
    @auth()
        @switch(auth()->user()->tema)
            @case('Infantil')
                bg-warning
            @break
            @case('Juvenil')
                bg-danger
            @break
            @case('Adultos')
                bg-secondary
            @break
            @default
                bg-white
        @endswitch
    @endauth
    ">
        <div class="navbar-brand">
            <a href="index.html" class="d-inline-block">
                <img src="{{asset('assets/logo.png')}}" alt="">
            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                   
                </li>
            </ul>

            <span class="badge bg-success ml-md-3 mr-md-auto" >Online</span>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                   
                    <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-300">
                     
                    </div>
                </li>

                <li class="nav-item dropdown">
                    
                </li>

                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ auth()->user()->perfil }}" class="rounded-circle mr-2" height="34" alt="">
                        <span>{{ auth()->user()->name }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Cerrar sesion</a>
                    </div>
                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md
        @auth()
        @switch(auth()->user()->tema)
            @case('Infantil')
                bg-warning
            @break
            @case('Juvenil')
                bg-danger
            @break
            @case('Adultos')
                bg-secondary
            @break
            @default
                bg-white
        @endswitch
    @endauth
        ">

            <!-- Sidebar mobile toggler -->
            <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-main-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                Navigation
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>
            <!-- /sidebar mobile toggler -->


            <!-- Sidebar content -->
            <div class="sidebar-content
            @auth()
        @switch(auth()->user()->tema)
            @case('Infantil')
                bg-warning
            @break
            @case('Juvenil')
                bg-danger
            @break
            @case('Adultos')
                bg-secondary
            @break
            @default
                bg-white
        @endswitch
    @endauth
            ">

                <!-- User menu -->
                <div class="sidebar-user ">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <a href="#"><img src="{{ auth()->user()->perfil }}" width="38" height="38" class="rounded-circle" alt=""></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold">{{ auth()->user()->name }}</div>
                                <div class="font-size-xs opacity-50">
                                    <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                                </div>
                            </div>

                            <div class="ml-3 align-self-center">
                                <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->


                <!-- Main navigation -->
                <div class="card card-sidebar-mobile
                @auth()
        @switch(auth()->user()->tema)
            @case('Infantil')
                bg-warning
            @break
            @case('Juvenil')
                bg-danger
            @break
            @case('Adultos')
                bg-secondary
            @break
            @default
                bg-white
        @endswitch
    @endauth
                ">
                    <ul class="nav nav-sidebar 
                    " data-nav-type="accordion">

                        <!-- Main -->
                        <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                        <li id="navUser" class="nav-item">
                            <a href="{{url('user')}}" class="nav-link">
                                <i class="icon-user"></i>
                                <span>
                                    Usuarios
                                </span>
                            </a>
                        </li>
                        <li id="navPuzzle" class="nav-item">
                            <a href="{{url('perfil')}}" class="nav-link">
                                <i class="icon-calendar"></i>
                                <span>
                                    Perfil
                                </span>
                            </a>
                        </li>
                        <li id="navPuzzle" class="nav-item">
                            <a href="{{url('almacen')}}" class="nav-link">
                                <i class="icon-calendar"></i>
                                <span>
                                    Almacen
                                </span>
                            </a>
                        </li>
                        <li id="navPuzzle" class="nav-item">
                            <a href="{{url('producto')}}" class="nav-link">
                                <i class="icon-calendar"></i>
                                <span>
                                    Producto
                                </span>
                            </a>
                        </li>
                        <li id="navPuzzle" class="nav-item">
                            <a href="{{url('reporte')}}" class="nav-link">
                                <i class="icon-calendar"></i>
                                <span>
                                    Estadisticas
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->
            
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper  
        @auth()
            @switch(auth()->user()->is_dia)
                @case(true)
                    bg-white
                @break
                @case(false)
                    bg-dark
                @break
                @default
                    bg-white
            @endswitch
        @endauth
        ">

            <!-- Content area -->
            <div class="content">
                @yield('content')

            </div>
            <!-- /content area -->

            <!-- Footer -->
            <div class="navbar navbar-expand-lg navbar-light">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                        <i class="icon-unfold mr-2"></i>
                        Footer
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-footer">
                    <span class="navbar-text">
                        &copy; 
                        <span>
                            @isset($_COOKIE['contador'])
                                {{setcookie('contador', $_COOKIE['contador']+1, time()+30*24*60*60)}}
                                {{"Visitas: " . $_COOKIE['contador']}}
                            @else
                                {{setcookie('contador', 41, time()+30*24*60*60)}}
                                {{"Visitas: 41"}}
                            @endisset
                        </span> 
                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    <script>
    $(document).ready(function () {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
          }
        });

    });

    </script>
    @stack('scripts')
</body>

<!-- Mirrored from demo.interface.club/limitless/demo/bs4/Template/layout_1/LTR/default/full/table_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 02 Nov 2019 03:14:27 GMT -->
</html>

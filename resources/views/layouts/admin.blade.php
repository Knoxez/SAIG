<!DOCTYPE html>
<html lang="es" dir="ltr">
   <head>

      <!-- Title -->
      <title>Admin | @yield('title')</title>

      <meta content="width=device-width, initial-scale=1" name="viewport">
      <meta charset="utf-8">
      <meta name="description" content="Sistema Administrador de Információn General">
      <meta name="keywords" content="saig, SAIG, CAM">
      <meta name="author" content="Universidad Tecnológica Metropolitana">

      <!-- Styles -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
      <link href="{{ asset('admin/plugins/pace-master/themes/blue/pace-theme-flash.css') }}" rel="stylesheet"/>
      <link href="{{ asset('admin/plugins/uniform/css/uniform.default.min.css') }}" rel="stylesheet"/>
      <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/plugins/fontawesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/plugins/line-icons/simple-line-icons.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/plugins/offcanvasmenueffects/css/menu_cornerbox.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/plugins/waves/waves.min.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/plugins/switchery/switchery.min.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/plugins/3d-bold-navigation/css/style.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/plugins/slidepushmenus/css/component.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css"/>
      @yield('css')

      <!-- Theme Styles -->
      <link href="{{ asset('admin/css/modern.min.css') }}" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/css/themes/green.css') }}" class="theme-color" rel="stylesheet" type="text/css"/>
      <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css"/>

      <script src="{{ asset('admin/plugins/3d-bold-navigation/js/modernizr.js') }}"></script>
      <script src="{{ asset('admin/plugins/offcanvasmenueffects/js/snap.svg-min.js') }}"></script>
      <link rel="shortcut icon" href="{{ 'home/img/favicon.png' }}">

   </head>
   <body class="page-header-fixed page-sidebar-fixed">
      <div class="overlay"></div>
      <form class="search-form" action="#" method="get">
         <div class="input-group">
            <input type="text" name="search" class="form-control search-input" placeholder="Buscar...">
            <span class="input-group-btn">
               <button type="button" class="btn btn-default close-search waves-effect waves-button waves-classic">
                  <i class="fa fa-times"></i>
               </button>
            </span>
         </div>
         <!-- Input Group -->
      </form>
      <!-- Search Form -->
      <main class="page-content content-wrap">
         <div class="navbar">
            <div class="navbar-inner">
               <div class="sidebar-pusher">
                  <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                     <i class="fa fa-bars"></i>
                  </a>
               </div>
               <div class="logo-box">
                  <a href="{{ route('dashboard') }}" class="logo-text">
                     <span>SAIG</span>
                  </a>
               </div>
               <!-- Logo Box -->
               <div class="search-button">
                  <a href="javascript:void(0);" class="waves-effect waves-button waves-classic show-searchs">
                     <i class="fa fa-search"></i>
                  </a>
               </div>
               <div class="topmenu-outer">
                  <div class="top-menu">
                     <ul class="nav navbar-nav navbar-left">
                        <li>
                           <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                        </li>
                        <li>
                           <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                        </li>
                     </ul>
                     <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="javascript:void(0)" class="waves-effect waves-button waves-classic show-search"><i class="fa fa-search"></i></a>
                        </li>
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-success pull-right"></span></a>
                           <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                              <li>
                                 <p class="drop-title">Tienes 3 tareas pendientes !</p>
                              </li>
                              <li class="dropdown-menu-list slimscroll task">
                                 <ul class="list-unstyled">
                                    <li>
                                       <a href="#">
                                          <div class="task-icon badge badge-success"><i class="icon-user"></i></div>
                                          <span class="badge badge-roundless badge-default pull-right">hace 1min</span>
                                          <p class="task-details">Nuevo usuario registrado.</p>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="#">
                                          <div class="task-icon badge badge-danger"><i class="icon-energy"></i></div>
                                          <span class="badge badge-roundless badge-default pull-right">hace 24min</span>
                                          <p class="task-details">Error de Servidor.</p>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="#">
                                          <div class="task-icon badge badge-info"><i class="icon-heart"></i></div>
                                          <span class="badge badge-roundless badge-default pull-right">hace 1h</span>
                                          <p class="task-details">Alcanzaste los 24 mil me gusta.</p>
                                       </a>
                                    </li>
                                 </ul>
                              </li>
                              <li class="drop-all"><a href="#" class="text-center">Todas las tareas</a></li>
                           </ul>
                        </li>
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                              <span class="user-name">{{auth()->user()->email}}<i class="fa fa-angle-down"></i></span>
                              <img src="{{ asset('admin/images/avatar1.png') }}" class="img-circle avatar" width="40" height="40" alt="">
                           </a>
                           <ul class="dropdown-menu dropdown-list" role="menu">
                              <li role="presentation"><a href="profile.html"><i class="fa fa-user"></i>Perfil</a></li>
                              <li role="presentation"><a href="calendar.html"><i class="fa fa-calendar"></i>Calendar</a></li>
                              <li role="presentation"><a href="inbox.html"><i class="fa fa-envelope"></i>Inbox<span class="badge badge-success pull-right">4</span></a></li>
                              <li role="presentation" class="divider"></li>
                              <li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>
                              <li role="presentation"><a href="{{route('logout')}}"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                           </ul>
                        </li>
                        <li>
                           <a href="{{route('logout')}}" class="log_out waves-effect waves-button waves-classic">
                              <span><i class="fa fa-sign-out m-r-xs"></i>Cerrar Sesión</span>
                           </a>
                        </li>
                     </ul>
                     <!-- Nav -->
                  </div>
                  <!-- Top Menu -->
               </div>
            </div>
         </div>
         <!-- Navbar -->
         <div class="page-sidebar sidebar">
            <div class="page-sidebar-inner slimscroll">
               <div class="sidebar-header">
                  <div class="sidebar-profile">
                     <a href="">
                        <div class="sidebar-profile-image">
                           <img src="{{ asset('admin/images/profile-menu-image.png') }}" class="img-circle img-responsive" alt="">
                        </div>
                        <div class="sidebar-profile-details">
                           <span>{{auth()->user()->username}}<br><small>
                              @if (auth()->user()->role_id == 1)
                                 Administrador
                              @elseif (auth()->user()->role_id == 2)
                                 Escuela
                              @else
                                 Instituto
                              @endif
                           </small></span>
                        </div>
                     </a>
                  </div>
               </div>
               <ul class="menu accordion-menu">
                  <li class="active" id="dashboard"><a href="{{ URL('admin/inicio') }}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Inicio</p></a></li>
                  <li class="" id="editor"><a href="{{ URL('admin/editor') }}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-envelope"></span><p>Editor del Sitio</p></a></li>
                  <li class="" id=""><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-briefcase"></span><p>UI Kits</p></a></li>
                  <li class="" id=""><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-th"></span><p>Layouts</p></a></li>
                  <li class="" id="course"><a href="{{ URL('admin/cursos') }}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-list"></span><p>Cursos</p></a></li>
                  <li class=""><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-edit"></span><p>Forms</p></a></li>
                  <li class=""><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-stats"></span><p>Charts</p></a></li>
                  <li class=""><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-log-in"></span><p>Login</p></a></li>
                  <li class=""><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-map-marker"></span><p>Maps</p></a></li>
                  <li class=""><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-gift"></span><p>Extra</p></a></li>
                  <li class=""><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-flash"></span><p>Levels</p></a></li>
               </ul>
            </div>
            <!-- Page Sidebar Inner -->
         </div>
         <!-- Page Sidebar -->
         <div class="page-inner">

            @yield('main')


            <div class="page-footer">
               <p class="no-s">2018 &copy; Modern by Steelcoders.</p>
            </div>
         </div>
         <!-- Page Inner -->
      </main>
      <!-- Page Content -->

      <div class="cd-overlay"></div>

      <!-- Javascripts -->
      <script src="{{ asset('admin/plugins/jquery/jquery-2.1.4.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/pace-master/pace.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/jquery-blockui/jquery.blockui.js') }}"></script>
      <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/switchery/switchery.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/uniform/jquery.uniform.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/offcanvasmenueffects/js/classie.js') }}"></script>
      <script src="{{ asset('admin/plugins/offcanvasmenueffects/js/main.js') }}"></script>
      <script src="{{ asset('admin/plugins/waves/waves.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/3d-bold-navigation/js/main.js') }}"></script>
      <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
      <script src="{{ asset('admin/js/modern.js') }}"></script>
      @yield('scripts')

   </body>
</html>

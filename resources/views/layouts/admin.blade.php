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
      {{-- <script src="{{ asset('admin/plugins/offcanvasmenueffects/js/snap.svg-min.js') }}"></script> --}}
      <link rel="shortcut icon" href="{{ asset('home/img/favicon.png') }}">

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
                  <a href="{{ route('bienvenido') }}" class="logo-text">
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
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                              <span class="user-name">{{auth()->user()->email}}<i class="fa fa-angle-down"></i></span>
                              <img src="{{ asset('images/'.auth()->user()->username.'/'.$inst->image) }}" id="user_avatar" class="avatar" width="40" height="40" alt="">
                           </a>
                           <ul class="dropdown-menu dropdown-list" role="menu">
                              <li role="presentation"><a href="{{route('perfil.index')}}"><i class="fa fa-user"></i>Perfil</a></li>
                              <li role="presentation"><a href="calendar.html"><i class="fa fa-calendar"></i>Calendar</a></li>
                              <li role="presentation"><a href="inbox.html"><i class="fa fa-envelope"></i>Inbox<span class="badge badge-success pull-right">4</span></a></li>
                              <li role="presentation" class="divider"></li>
                              <li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>
                              <li role="presentation"><a href="{{route('logout')}}"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                           </ul>
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
                     <a>
                        <div class="sidebar-profile-image avatar-content">
                           <img src="{{asset('images/'.auth()->user()->username.'/'.$inst->image)}}" id="user_logo" alt="">
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
                  <li class="" id="inicio"><a href="{{ URL('admin/bienvenido') }}" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-home"></span><p>Inicio</p></a></li>
                  <li class="droplink">
                      <a href="#" class="waves-effect waves-button">
                          <span class="menu-icon fa fa-graduation-cap"></span>
                          @if (auth()->user()->role_id == 1)
                              <p>Administrador</p>
                              <span class="arrow"></span>
                          @elseif (auth()->user()->role_id == 2)
                              <p>Escuela</p>
                              <span class="arrow"></span>
                          @else
                              <p>Instituto</p>
                              <span class="arrow"></span>
                          @endif
                      </a>
                      <ul class="sub-menu">
                          <li class="" id="perfil"><a href="{{route('perfil.index')}}">Perfil</a></li>
                          <li class="" id="cursos"><a href="{{route('curso.index')}}">Cursos</a></li>
                          <li class="" id="horarios"><a href="{{route('horarios.index')}}">Horarios</a></li>
                          <li class="" id="metodos"><a href="{{route('method.index')}}">Métodos</a></li>
                          <li class="" id="comida"><a href="{{route('comida.index')}}">Menú de Comida</a></li>
                          <li class="" id="sponsor"><a href="{{route('sponsor.index')}}">Patrocinadores</a></li>
                      </ul>
                  </li>
                  <li class="" id="site"><a href="#" class="waves-effect waves-button"><span class="menu-icon icon-screen-desktop"></span><p>Sitio</p></a></li>
                  <li class="" id="publicaciones"><a href="{{route('publications.index')}}" class="waves-effect waves-button"><span class="menu-icon icon-globe"></span><p>Publicaciones</p></a></li>
                  <li class="" id="gallery"><a href="#" class="waves-effect waves-button"><span class="menu-icon glyphicon glyphicon-picture"></span><p>Galeria</p></a></li>
                  <li class="" id="students"><a href="#" class="waves-effect waves-button"><span class="menu-icon fa fa-graduation-cap"></span><p>Alumnos</p></a></li>
                  <li class="" id="diverso"><a href="{{ URL('admin/miscellaneous')}}" class="waves-effect waves-button"><span class="menu-icon icon-settings"></span><p>Configuración</p></a></li>
               </ul>
            </div>
            <!-- Page Sidebar Inner -->
         </div>
         <!-- Page Sidebar -->
         <div class="page-inner">

             <div class="reload">
                 @yield('main')
             </div>

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
      <script src="{{ asset('admin/plugins/waves/waves.min.js') }}"></script>
      <script src="{{ asset('admin/plugins/3d-bold-navigation/js/main.js') }}"></script>
      <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
      <script src="{{ asset('admin/js/modern.js') }}"></script>
      @yield('scripts')

   </body>
</html>

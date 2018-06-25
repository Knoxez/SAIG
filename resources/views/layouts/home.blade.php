<!DOCTYPE html>
<html lang="es">
<!-- Mirrored from themes.iamabdus.com/kidz/1.4/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Feb 2018 04:40:38 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->

<head>
   <!-- SITE TITTLE -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Centro de Atención Múltiple del Sur</title>

   <link href="{{asset('home/plugins/jquery-ui/jquery-ui.css')}}" rel="stylesheet">
   <link href="{{asset('home/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
   <link href="{{asset('home/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
   <link href="{{asset('home/plugins/rs-plugin/css/settings.css')}}" rel="stylesheet" media="screen">
   <link href="{{asset('home/plugins/selectbox/select_option1.css')}}" rel="stylesheet">
   <link href="{{asset('home/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" media="screen">
   <link href="{{asset('home/plugins/isotope/jquery.fancybox.css')}}" rel="stylesheet">
   <link href="{{asset('home/plugins/isotope/isotope.css')}}" rel="stylesheet">
   <link href="{{asset('home/css/custom.css')}}" rel="stylesheet">

   <!-- GOOGLE FONT -->
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet'>
   <link href='https://fonts.googleapis.com/css?family=Dosis:400,300,600,700' rel='stylesheet'>

   <!-- CUSTOM CSS -->
   <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">
   <link href="{{ asset('home/css/default.css') }}" rel="stylesheet" id="option_color">

   <!-- Icons -->
   <link href="{{ asset('home/img/favicon.png')}}" rel="shortcut icon">

   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body class="body-wrapper">


   <div class="main-wrapper">
      <!-- HEADER -->
      <header id="pageTop" class="header-wrapper">
         <!-- COLOR BAR -->
         <div class="container-fluid color-bar top-fixed clearfix">
            <div class="row">
               <div class="col-sm-1 col-xs-2 bg-color-1">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-2">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-3">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-4">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-5">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-6">fix bar</div>
               <div class="col-sm-1 bg-color-1 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-2 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-3 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-4 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-5 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-6 hidden-xs">fix bar</div>
            </div>
         </div>

         <!-- TOP INFO BAR -->
         <div class="top-info-bar bg-color-7 hidden-xs">
            <div class="container">
               <div class="row">
                  <div class="col-sm-7">
                     <ul class="list-inline topList">
                        <li>
                           <i class="fa fa-envelope bg-color-1" aria-hidden="true"></i>
                           <a href="mailto:info@yourdomain.com">info@yourdomain.com</a>
                        </li>
                        <li>
                           <i class="fa fa-phone bg-color-2" aria-hidden="true"></i> +1 234 567 8900</li>
                        <li>
                           <i class="fa fa-clock-o bg-color-6" aria-hidden="true"></i> Open: 9am - 6pm</li>
                     </ul>
                  </div>
                  <div class="col-sm-3 col-sm-offset-2">
                     <ul class="list-inline functionList">
                        <li>
                           <i class="fa fa-unlock-alt bg-color-5" aria-hidden="true"></i>
                           <a href='#loginModal' data-toggle="modal">Iniciar Sesión</a>
                           <span>o</span>
                           <a href="{{ URL('registro') }}" data-toggle="modal">Registrate</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>

         <!-- NAVBAR -->
         <nav id="menuBar" class="navbar navbar-default lightHeader" role="navigation">
            <div class="container">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="{{ url('/') }}">
                     <img src="{{ asset('home/img/logo-school.png') }}" alt="Kidz School">
                  </a>
               </div>

               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse navbar-ex1-collapse">
                  <ul class="nav navbar-nav navbar-right">

                     <!--INICIO-->
                     <li class="dropdown singleDrop color-2">
                        <a href="{{ url('/') }}">
                           <i class="fa fa-home bg-color-2" aria-hidden="true"></i>
                           <span class="active">Inicio</span>
                        </a>
                     </li>

                     <!--CONOCENOS-->
                     <li class="dropdown singleDrop color-3 ">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-list-ul bg-color-3" aria-hidden="true"></i>
                           <span>Conócenos</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left">
                           <li class=" ">
                              <a href="about_us.html">Nosotros</a>
                           </li>
                           <li class=" ">
                              <a href="teachers.html">Directorio</a>
                           </li>
                           <li class=" ">
                              <a href="teachers-details.html">Contacto</a>
                           </li>
                        </ul>
                     </li>

                     <!--EVENTOS-->
                     <li class=" dropdown singleDrop color-1 ">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="300" data-close-others="true" aria-expanded="false">
                           <i class="fa fa-file-text-o bg-color-1" aria-hidden="true"></i>
                           <span>Eventos</span>
                        </a>
                        <ul class="row dropdown-menu">
                           <li class="">
                              <a href="course-grid-full.html">Eventos</a>
                           </li>
                           <li class="">
                              <a href="course-grid-left-sidebar.html">Noticias</a>
                           </li>
                        </ul>
                     </li>

                     <!--BLOG-->
                     <li class="dropdown singleDrop color-4 ">
                        <a href="#">
                           <i class="fa fa-pencil-square-o bg-color-4" aria-hidden="true"></i>
                           <span>Blog</span>
                        </a>
                     </li>

                     <!--GALERIA-->
                     <li class="dropdown singleDrop color-5  ">
                        <a href="#">
                           <i class="fa fa-calendar bg-color-5" aria-hidden="true"></i>
                           <span>Galeria</span>
                        </a>
                     </li>

                  </ul>
               </div>

            </div>
         </nav>
      </header>

      @yield('main')

      <!-- FOOTER -->
      <footer>
         <!-- COLOR BAR -->
         <div class="container-fluid color-bar clearfix">
            <div class="row">
               <div class="col-sm-1 col-xs-2 bg-color-1">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-2">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-3">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-4">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-5">fix bar</div>
               <div class="col-sm-1 col-xs-2 bg-color-6">fix bar</div>
               <div class="col-sm-1 bg-color-1 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-2 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-3 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-4 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-5 hidden-xs">fix bar</div>
               <div class="col-sm-1 bg-color-6 hidden-xs">fix bar</div>
            </div>
         </div>
         <!-- FOOTER INFO AREA -->
         <div class="footerInfoArea full-width clearfix" style="background-image: url({{ asset('home/img/footer/footer-bg-1.png') }});">
            <div class="container">
               <div class="row">
                  <div class="col-sm-3 col-xs-12">
                     <div class="footerTitle">
                        <a href="index-2.html">
                           <img src="{{ asset('home/img/logo-footer.png') }}">
                        </a>
                     </div>
                     <div class="footerInfo">
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa officia.Lorem ipsum dolor sit amet.</p>
                        <p>consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                     </div>
                  </div>
                  <div class="col-sm-3 col-xs-12">
                     <div class="footerTitle">
                        <h4>Useful Links</h4>
                     </div>
                     <div class="footerInfo">
                        <ul class="list-unstyled footerList">
                           <li>
                              <a href="index-2.html">
                                 <i class="fa fa-angle-double-right" aria-hidden="true"></i>Kidz School
                              </a>
                           </li>
                           <li>
                              <a href="about_us.html">
                                 <i class="fa fa-angle-double-right" aria-hidden="true"></i>About Kidz School
                              </a>
                           </li>
                           <li>
                              <a href="index-v2.html">
                                 <i class="fa fa-angle-double-right" aria-hidden="true"></i>Kidz Store
                              </a>
                           </li>
                           <li>
                              <a href="index-v3.html">
                                 <i class="fa fa-angle-double-right" aria-hidden="true"></i>Kidz Daycare
                              </a>
                           </li>
                           <li>
                              <a href="photo-gallery.html">
                                 <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                 Photo Gallery
                              </a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-sm-3 col-xs-12">
                     <div class="footerTitle">
                        <h4>Recent Post</h4>
                     </div>
                     <div class="footerInfo">
                        <ul class="list-unstyled postLink">
                           <li>
                              <div class="media">
                                 <a class="media-left" href="single-blog.html">
                                    <img class="media-object img-rounded border-color-1" src="{{ asset('home/img/footer/footer-img-1.png') }}" alt="Image">
                                 </a>
                                 <div class="media-body">
                                    <h5 class="media-heading">
                                       <a href="single-blog.html">A Clean Website Gives More Experience To The Visitors</a>
                                    </h5>
                                    <p>July 7 - 2016</p>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="media">
                                 <a class="media-left" href="single-blog-left-sidebar.html">
                                    <img class="media-object img-rounded border-color-2" src="{{ asset('home/img/footer/footer-img-2.png') }}" alt="Image">
                                 </a>
                                 <div class="media-body">
                                    <h5 class="media-heading">
                                       <a href="single-blog-left-sidebar.html">A Clean Website Gives More Experience To The Visitors</a>
                                    </h5>
                                    <p>July 7 - 2016</p>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="media">
                                 <a class="media-left" href="single-blog-left-sidebar.html">
                                    <img class="media-object img-rounded border-color-4" src="{{ asset('home/img/footer/footer-img-3.png') }}" alt="Image">
                                 </a>
                                 <div class="media-body">
                                    <h5 class="media-heading">
                                       <a href="single-blog-left-sidebar.html">A Clean Website Gives More Experience To The Visitors</a>
                                    </h5>
                                    <p>July 7 - 2016</p>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-sm-3 col-xs-12">
                     <div class="footerTitle">
                        <h4>Mailing List</h4>
                     </div>
                     <div class="footerInfo">
                        <p>Sign up for our mailing list to get latest updates and offers.</p>
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="Email address" aria-describedby="basic-addon21">
                           <button type="submit" class="input-group-addon" id="basic-addon21">
                              <i class="fa fa-check" aria-hidden="true"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- COPY RIGHT -->
         <div class="copyRight clearfix">
            <div class="container">
               <div class="row">
                  <div class="col-sm-5 col-sm-push-7 col-xs-12">
                     <ul class="list-inline">
                        <li>
                           <a href="#" class="bg-color-1">
                              <i class="fa fa-facebook" aria-hidden="true"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" class="bg-color-2">
                              <i class="fa fa-twitter" aria-hidden="true"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" class="bg-color-3">
                              <i class="fa fa-google-plus" aria-hidden="true"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" class="bg-color-4">
                              <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" class="bg-color-5">
                              <i class="fa fa-vimeo" aria-hidden="true"></i>
                           </a>
                        </li>
                     </ul>
                  </div>
                  <div class="col-sm-7 col-sm-pull-5 col-xs-12">
                     <div class="copyRightText">
                        <p>© 2016 Copyright Kidz School Bootstrap Template by
                           <a href="https://www.iamabdus.com/">Abdus</a>.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
   </div>

   <div class="scrolling">
      <a href="#pageTop" class="backToTop hidden-xs" id="backToTop">
         <i class="fa fa-arrow-up" aria-hidden="true"></i>
      </a>
   </div>

   <!-- LOGIN MODAL -->
   <div class="modal fade customModal" id="loginModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="panel panel-default formPanel">
               <div class="panel-heading bg-color-1 border-color-1 not-rounded">
                  <h3 class="panel-title">Iniciar Sesión</h3>
               </div>
               <div class="panel-body not-rounded">
                  <form role="form" id="form-login">
                     @csrf
                     <div class="form-group login_false">

                     </div>
                     <div class="form-group" id="group-email_log">
                        <label for="email" class="control-label">Correo Electrónico</label>
                        <input type="text" name="email" id="email_log" class="form-control" placeholder="example@gmail.com" value="{{ old('email') }}">
                        <span class="text-danger"><strong class="error-email_log"></strong></span>
                     </div>
                     <br>
                     <div class="form-group" id="group-password_log">
                        <label for="password" class="control-lable">Contraseña</label>
                        <input type="password" name="password" id="password_log" class="form-control" placeholder="">
                        <span class="text-danger"><strong class="error-password_log"></strong></span>
                     </div>
                     <br>
                     <span class="invalid-feedback text-danger"><strong class="error-text"></strong></span>
                     <div class="form-group formField">
                        <input type="submit" class="btn btn-primary btn-block bg-color-3 border-color-3 not-rounded" id="login" value="Iniciar Sesión">
                     </div>
                     <div class="form-group formField">
                        <p class="help-block">
                           <a href="#">Forgot password?</a>
                        </p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="{{ asset('home/plugins/jquery/jquery-min.js') }}"></script>
   <script src="{{ asset('home/plugins/jquery-ui/jquery-ui.js') }}"></script>
   <script src="{{ asset('home/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('home/plugins/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
   <script src="{{ asset('home/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
   <script src="{{ asset('home/plugins/selectbox/jquery.selectbox-0.1.3.min.js') }}"></script>
   <script src="{{ asset('home/plugins/owl-carousel/owl.carousel.js') }}"></script>
   <script src="{{ asset('home/plugins/counter-up/jquery.counterup.min.js') }}"></script>
   <script src="{{ asset('home/plugins/isotope/isotope.min.js') }}"></script>
   <script src="{{ asset('home/plugins/isotope/jquery.fancybox.pack.js') }}"></script>
   <script src="{{ asset('home/plugins/isotope/isotope-triger.js') }}"></script>
   <script src="{{ asset('home/plugins/countdown/jquery.syotimer.js') }}"></script>
   <script src="{{ asset('home/plugins/velocity/velocity.min.js') }}"></script>
   <script src="{{ asset('home/plugins/smoothscroll/SmoothScroll.js') }}"></script>
   <script src="{{ asset('home/js/custom.js') }}"></script>
   <script src="{{ asset('home/js/login.js') }}"></script>
   @yield('scripts')
   <script type="text/javascript">
      let token = "{{ Session::token() }}";
      let sesion = "{{action('Auth\LoginController@login')}}";
      let admin = "{{route('dashboard')}}";
   </script>
</body>

<!-- Mirrored from themes.iamabdus.com/kidz/1.4/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Feb 2018 04:42:49 GMT -->

</html>

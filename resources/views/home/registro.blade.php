@extends('layouts.home') @section('main')
<section class="mainContent full-width clearfix">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="tabCommon tabLeft">
               <form role="form" action="{{action('HomeController@store')}}" id="form-store" enctype="multipart/form-data">
               <div class="tab-content">
                     <div id="leftHome" class="tab-pane fade in active">
                        <div class="media">
                           <a class="media-left">
                              <img class="media-object img-rounded" src="{{ asset('home/img/register-form.png') }}" style="width:524px; height: 445px;" alt="Image">
                           </a>
                           <div class="media-body">
                              <h3 class="media-heading" style="overflow:visible;">Registro de cuenta</h3>
                              <div class="form-group row" id="form-group-username">
                                 <label for="username" style="padding-top:5px;" class="col-sm-4 col-form-label">Nombre</label>
                                 <div class="col-sm-8">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Nombre del Instituto" required>
                                    <span class="text-danger"><strong class="error-username"></strong></span>
                                 </div>
                              </div>
                              <div class="form-group row" id="form-group-email">
                                 <label style="padding-top: 5px;" class="col-sm-4 col-form-label" for="email">Correo electrónico</label>
                                 <div class="col-sm-8">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="example@gmail.com" required>
                                    <span class="text-danger"><strong class="error-email"></strong></span>
                                 </div>
                              </div>
                              <div class="form-group row" id="form-group-password">
                                 <label style="padding-top: 5px;" class="col-sm-4 col-form-label" for="password" required>Contraseña</label>
                                 <div class="col-sm-8">
                                    <input type="password" id="password" name="password" class="form-control" maxlength="12" required>
                                    <span class="text-danger"><strong class="error-password"></strong></span>
                                 </div>
                              </div>
                              <div class="form-group row" id="form-group-password-confirmation">
                                 <label class="col-sm-4 col-form-label" style="padding-top:5px;" for="password-confirmation">Repetir contraseña</label>
                                 <div class="col-sm-8">
                                    <input type="password" id="password-confirmation" name="password_confirmation" class="form-control">
                                    <span class="text-danger"><strong class="error-confirmation"></strong></span>
                                 </div>
                              </div>
                              <a href="#nextForm" data-toggle="tab" class="btn btn-primary" id="next" name="next">Siguiente<i class="fa fa-chevron-right"></i></a>
                           </div>
                        </div>
                     </div>
                     <div id="nextForm" class="tab-pane fade">
                        <div class="media">
                           <div class="media-left">
                              <div class="form-group formField">
                                 <div class="container-img" id="input-file">
                                    <center>
                                       <img src="{{asset('home/img/icons/picture.png')}}" class="responsive-img" id="img" alt="image">
                                    </center>
                                 </div>
                                 <input type="file" name="image" id="img_inst" accept="image/png" style="display:none" value="">
                              </div>
                           </div>
                           <div class="media-body">
                              <h3 class="media-heading" style="overflow:visible;">Registro de cuenta</h3>
                              <div class="form-group row">
                                 <label class="col-sm-4 col-form-label" style="padding-top: 5px;" for="role">Tipo de Institución</label>
                                 <div id="div-roles"></div>
                              </div>
                              <div class="form-group row">
                                 <label for="schoolkey" style="padding-top: 5px;" class="col-sm-4 col-form-label">Clave Escolar</label>
                                 <div class="col-sm-8">
                                    <input type="text" name="schoolkey" id="schoolkey" class="form-control">
                                    <span class="text-danger"><strong class="error-school"></strong> </span>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label style="padding-top:5px;" class="col-sm-4 col-form-label" for="address">Dirección</label>
                                 <div class="col-sm-8">
                                    <input class="form-control" type="text" name="address" id="address">
                                    <span class="text-danger"><strong class="error-address"></strong> </span>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label style="padding-top:5px;" class="col-sm-4 col-form-label" for="phone">Teléfono</label>
                                 <div class="col-sm-8">
                                    <input class="form-control" type="text" name="phone" id="phone" placeholder="(999) 999 9999">
                                    <span class="text-danger"><strong class="error-phone"></strong> </span>
                                 </div>
                              </div>
                              <a href="#leftHome" data-toggle="tab" class="btn btn-primary"><span class="fa fa-fa fa-chevron-left"></span> Atrás</a>
                              <input type="submit" name="agregar" onclick="create_user(); return false;" class="btn btn-success right" value="Registrar">
                           </div>
                        </div>
                     </div>
               </div>
            </form>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection

@section('scripts')
<script src="{{asset('home/plugins/imask/imask.js')}}"></script>
<script src="{{ asset('home/js/home.js') }}"></script>
<script type="text/javascript">
   const store = "{{ action('HomeController@store') }}";
</script>
@endsection

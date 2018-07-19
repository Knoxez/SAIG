@extends('layouts.admin')

@section('title','Bienvenido!!')

@section('main')
   <div class="page-title">
      <h3>Bienvenido al Sistema Administrador de Información General (SAIG).</h3>
   </div>

   <div id="main-wrapper">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-white">
               <div class="panel-heading">
                  <h3 class="panel-title">
                     El Sistema Administrador de Información General (SAIG)...
                  </h3>
               </div>
               <div class="panel-body">
                  <p>
                     ¿Qué es SAIG?, su propósito, su alcance y objetivos...
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@section('scripts')
<script src="{{asset('admin/plugins/3d-bold-navigation/js/main.js')}}"></script>
      <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>
@endsection

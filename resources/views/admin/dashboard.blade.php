@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
   <link href="{{ asset('admin/plugins/weather-icons-master/css/weather-icons.min.css') }}" rel="stylesheet" type="text/css"/>
   <link href="{{ asset('admin/plugins/metrojs/MetroJs.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('main')
   <div class="page-title">
      <h3>Dashboard</h3>
   </div>

<div id="main-wrapper">
   <div class="row">
      <div class="col-lg-3 col-md-6">
         <div class="panel info-box panel-white">
            <div class="panel-body">
               <div class="info-box-icon">
                  <i class="icon-users"></i>
               </div>
               <div class="info-box-stats">
                  <p class="counter">1,562</p>
                  <span class="info-box-title">Usuarios Registrados</span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6">
         <div class="panel info-box panel-white">
            <div class="panel-body">
               <div class="info-box-icon">
                  <i class="icon-eye"></i>
               </div>
               <div class="info-box-stats">
                  <p class="counter">340,230</p>
                  <span class="info-box-title">Page views</span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6">
         <div class="panel info-box panel-white">
            <div class="panel-body">
               <div class="info-box-icon">
                  <i class="icon-basket"></i>
               </div>
               <div class="info-box-stats">
                  <p>$
                     <span class="counter">653,000</span>
                  </p>
                  <span class="info-box-title">Monthly revenue goal</span>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6">
         <div class="panel info-box panel-white">
            <div class="panel-body">
               <div class="info-box-icon">
                  <i class="icon-envelope"></i>
               </div>
               <div class="info-box-stats">
                  <p class="counter">47,500</p>
                  <span class="info-box-title">New emails recieved</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Main Wrapper -->

@endsection

@section('scripts')
<script src="{{ asset('admin/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jquery-counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('admin/plugins/flot/jquery.flot.min.js') }}"></script>
<script src="{{ asset('admin/plugins/flot/jquery.flot.time.min.js') }}"></script>
<script src="{{ asset('admin/plugins/flot/jquery.flot.symbol.min.js') }}"></script>
<script src="{{ asset('admin/plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('admin/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/curvedlines/curvedLines.js') }}"></script>
<script src="{{ asset('admin/plugins/metrojs/MetroJs.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>
@endsection

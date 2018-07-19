@extends('layouts.admin')
@section('title', 'Perfil')
@section('css')

@endsection
@section('main')
<div class="page-title">
   <h3>Perfil de usuario</h3>
</div>

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-8 col-lg-4">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">Datos de la Escula</h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="img-content" data-toggle="tooltip" title="Editar imagen" data-placement="top">
                        <form action="{{route('image')}}" id="imageForm">
                            @csrf
                            <input type="file" id="imageInput" accept="image/*" name="image">
                        </form>
                        <img src="{{asset('images/'.$image)}}" id="imageLogo">
                        <div class="edit-image" >
                            <i class="fa fa-pencil icon-center"></i>
                        </div>
                    </div>
                    <div class="">
                        <h3 class="text-center">{{auth()->user()->username}}</h3>
                        <p class="text-center">
                        @if (auth()->user()->role_id == 1)
                            Administrador
                        @elseif (auth()->user()->role_id == 2)
                            Escuela
                        @else
                            Instituto
                        @endif
                        </p>
                        <div class="hl"></div>
                        <ul class="list-unstyled text-center">
                            <li>
                                <p id="p-address">
                                    <i class="fa fa-map-marker" id="i-address"></i>
                                    {{$inst->address}}
                                </p>
                            </li>
                            <li>
                                <p>
                                    <i class="fa fa-key"></i>
                                    Clave Escolar: {{$inst->schoolkey}}
                                </p>
                            </li>
                            <li>
                                <p>
                                    <i class="fa fa-calendar"></i>
                                    Desde: {{auth()->user()->created_at->format('d-M-Y')}}
                                </p>
                            </li>
                            <li>
                                <p>
                                    <i class="fa fa-phone m-r-xs" id="i-phone"></i>
                                    {{$inst->phone}}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-8">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">Información General</h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <form id="form-edit-profile" action="{{action('PerfilController@update', 'id')}}" class="form-horizontal">
                        @method('put')@csrf
                        <div class="form-group" id="form-group-address">
                            <label class="control-label col-sm-2" for="address">Dirección</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="address" id="address" value="{{$inst->address}}" readonly>
                            </div>
                        </div>
                        <div class="form-group" id="form-group-phone">
                            <label for="phone" class="control-label col-sm-2">Teléfono</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" id="phone" value="{{$inst->phone}}" readonly>
                            </div>
                        </div>
                        <div class="form-group" id="form-group-history">
                            <label for="history" class="control-label col-sm-2">Historia</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="history" id="history" rows="8" maxlength="500" readonly>{{$inst->history}}</textarea>
                            </div>
                        </div>
                        <div class="form-group" id="form-group-mision">
                            <label for="mision" class="control-label col-sm-2">Mision</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="mision" id="mision" rows="4" maxlength="500" readonly>{{$inst->mision}}</textarea>
                            </div>
                        </div>
                        <div class="form-group" id="form-group-vision">
                            <label for="vision" class="control-label col-sm-2">Vision</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="vision" id="vision" rows="4" maxlength="500" readonly>{{$inst->vision}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-info" id="edit" name="Editar">Editar</button>
                                <input type="button" class="btn btn-success" id="save-changes" value="Guardar">
                                <button type="button" class="btn btn-default disabled">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{asset('admin/js/pages/profile.js')}}"></script>
<script type="text/javascript">
    let id = "{{$inst->id}}";
    let GetInstURL = "{{action('PerfilController@create')}}";
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Metodos')

@section('css')
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"rel="stylesheet">
@endsection

@section('main')
<div class="page-title">
    <h3>Escuela</h3>
</div>

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">Métodos</h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="tbl_metodos" class="display table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Método</th>
                                    <th>Detalle</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Método</th>
                                    <th>Detalle</th>
                                    <th>Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="#modal-metodo" onclick="ClearMethod()" class="btn btn-info" data-toggle="modal">Crear</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-metodo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title-metodo">Agregar Método</h4>
                <hr>
            </div>
            <div class="modal-body">
                <form action="{{route('method.store')}}" id="form-metodo" class="form-horizontal">
                    @method('post')
                    @csrf
                    <input type="hidden" id="metodo-id">
                    <div class="form-group" id="form-metodo-name">
                        <label for="name" class="control-label col-sm-2">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" id="method_name" class="form-control"placeholder="Nombre del Curso">
                            <span class="help-block error-msg"></span>
                        </div>
                    </div>
                    <div class="form-group" id="form-metodo-content">
                        <label for="content" class="control-label col-sm-2">Detalle</label>
                        <div class="col-sm-10">
                            <textarea id="content" rows="5" class="form-control" placeholder="Describe el método"></textarea>
                            <span class="help-block error-msg"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Guardar" class="btn btn-success" id="metodo-edit" style="display:none;">
                <input type="submit" value="Guardar" class="btn btn-success" id="metodo-store">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<form action="{{route('method.update', 'id')}}" id="form-metodo-update">
    @method('put') @csrf
</form>

<form action="{{route('method.destroy', 'id')}}" id="form-metodo-delete">
    @method('delete') @csrf
</form>

@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin/js/bootstrap-notify.js')}}"></script>
    <script src="{{asset('admin/js/pages/DataTable.js')}}"></script>
    <script src="{{asset('admin/js/pages/Method.js')}}" charset="utf-8"></script>
    <script type="text/javascript">
        let metodoShowURL = "{{route('method.show', 'id')}}"
    </script>
@endsection

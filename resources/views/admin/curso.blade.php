@extends('layouts.admin')
@section('title', 'Cursos')

@section('css')
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"rel="stylesheet">
<link href="{{ asset('admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
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
                    <h3 class="panel-title">Cursos</h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="tbl_cursos" class="display table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Horas</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Horas</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <a href="#modal-curso" onclick="ClearCurso()" class="btn btn-info" data-toggle="modal">Crear</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-curso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title-curso">Crear Curso</h4>
                <hr>
            </div>
            <div class="modal-body">
                <form action="{{route('curso.store')}}" id="form-curso" class="form-horizontal">
                    @method('post')
                    @csrf
                    <input type="hidden" id="curso-id">
                    <div class="form-group" id="form-curso-name">
                        <label for="name" class="control-label col-sm-2">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" id="curso_name" class="form-control"placeholder="Nombre del Curso">
                            <span class="help-block error-msg"></span>
                        </div>
                    </div>
                    <div class="form-group" id="form-curso-hours">
                        <label for="hours" class="control-label col-sm-2">Horas</label>
                        <div class="col-sm-10">
                            <input type="number" id="hours" class="form-control" placeholder="Horas del Curso">
                            <span class="help-block error-msg"></span>
                        </div>
                    </div>
                    <div class="form-group" id="form-curso-groups">
                        <label for="group" class="control-label col-sm-2">Grupo(s)</label>
                        <div class="col-sm-10">
                            <select class="js-states form-control" id="group" multiple="multiple" tabindex="-1" style="display:none; width: 100%"></select>
                            <span class="help-block error-msg"></span>
                        </div>
                    </div>
                    <div class="form-group" id="form-curso-description">
                        <label for="details" class="control-label col-sm-2">Detalle</label>
                        <div class="col-sm-10">
                            <textarea id="details" rows="5" class="form-control" placeholder="Detalla de lo que va el curso"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Guardar" class="btn btn-success" id="curso-edit" style="display:none;">
                <input type="submit" value="Guardar" class="btn btn-success" id="curso-store">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<form action="{{route('curso.update', 'id')}}" id="form-curso-update">
    @method('put')  @csrf
</form>

<form action="{{route('curso.destroy', 'id')}}" id="form-curso-delete">
    @method('delete')   @csrf
</form>
@endsection

@section('scripts')
    <script src="{{asset('admin/js/bootstrap-notify.js')}}"></script>
    <script src="{{asset('admin/js/pages/DataTable.js')}}"></script>
    <script src="{{asset('admin/js/pages/cursos.js')}}"></script>
    <script src="{{asset('admin/js/pages/Select2.js')}}"></script>
    <script src="{{asset('admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        let cursosEdit = "{{action('CursoController@show', 'id')}}";
    </script>
@endsection

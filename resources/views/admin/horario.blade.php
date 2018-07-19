@extends('layouts.admin')
@section('title', 'Horarios de Clase')

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
                        <h3 class="panel-title">Horarios de Clase</h3>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tbl_horarios" class="display table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Horario</th>
                                        <th>Archivo</th>
                                        <th>Grupo</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Horario</th>
                                        <th>Archivo</th>
                                        <th>Grupo</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="#modal-horario" onclick="ClearHorario()" class="btn btn-info" data-toggle="modal">Crear</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-horario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="title-horario">Agregar Horario</h4>
                    <hr>
                </div>
                <div class="modal-body">
                    <form action="{{route('horarios.store')}}" id="form-horario-store" enctype="multipart/form-data" class="form-horizontal">
                        @method('post')
                        @csrf
                        <input type="hidden" id="curso-id">
                        <div class="form-group" id="form-horario-name">
                            <label for="name" class="control-label col-sm-2">Nombre</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Título del Horario" required>
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                        <div class="form-group" id="form-horario-file">
                            <label for="file" class="control-label col-sm-2">Archivo</label>
                            <div class="col-sm-10">
                                <input type="text" id="file-text" readonly class="form-control" placeholder="Elige un archivo" required>
                                <input type="file" name="doc" id="file" accept="application/*" required style="Display:none;">
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                        <div class="form-group" id="form-curso-groups">
                            <label for="group" class="control-label col-sm-2">Grupo(s)</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="group" id="group" style="width:100%;"></select>
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Guardar" class="btn btn-success" id="horario-edit" style="display:none;">
                    <input type="submit" value="Guardar" class="btn btn-success" id="horario-store">
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
    <script src="{{asset('admin/js/bootstrap-notify.js')}}"></script>
    <script src="{{asset('admin/js/pages/DataTable.js')}}"></script>
    <script src="{{asset('admin/js/pages/Horario.js')}}"></script>
    <script src="{{asset('admin/js/pages/Select2.js')}}"></script>
    <script src="{{asset('admin/plugins/file-style/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        let cursosEdit = "{{action('CursoController@show', 'id')}}";
        let horarioDOC = "{{route('documentDownload', 'id')}}";
    </script>
@endsection

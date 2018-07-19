@extends('layouts.admin')
@section('title','Comida')

@section('css')
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"rel="stylesheet">
<link href="{{asset('admin/plugins/bootstrap-datepicker/css/datepicker3.css')}}">
@endsection

@section('main')
    <div class="page-title">
        <h3>Escuela</h3>
    </div>

    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="pane panel-white">
                    <div class="panel-heading">
                        <h3 class="panel-title">Menú de Comida</h3>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tbl_comida" class="display table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fech Fin</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="#modal-comida" class="btn btn-info" onclick="cleanComida()" data-toggle="modal">Crear</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-comida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="title-comida">Editar menú de comida</h4>
                    <hr>
                </div>
                <div class="modal-body">
                    <form action="{{route('comida.store')}}" id="form-comida-store" class="form-horizontal">
                        @method('post')
                        @csrf
                        <input type="hidden" id="comida-id">
                        <div class="form-group" id="form-comida-title">
                            <label for="titulo" class="control-label col-sm-2">Título</label>
                            <div class="col-sm-10">
                                <input type="text" id="title" class="form-control" placeholder="Asignale un título al menu de la semana">
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="form-comida-fecha_ini">
                                <label for="fecha_ini" class="control-label col-sm-2">Fecha Inicio</label>
                                <div class="col-sm-4">
                                    <input type="text" id="fecha_ini" class="form-control date-picker">
                                    <span class="help-block error-msg"></span>
                                </div>
                            </div>
                            <div id="form-comida-fecha_fin">
                                <label for="fecha_fin" class="control-label col-sm-2">Fecha Fin</label>
                                <div class="col-sm-4">
                                    <input type="text" id="fecha_fin" class="form-control date-picker">
                                    <span class="help-block error-msg"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="form-comida-monday">
                            <label for="monday" class="control-label col-sm-2">Lunes</label>
                            <div class="col-sm-10">
                                <textarea id="monday" rows="4" class="form-control" placeholder="Menú del día Lunes"></textarea>
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                        <div class="form-group" id="form-comida-thuesday">
                            <label for="thuesday" class="control-label col-sm-2">Martes</label>
                            <div class="col-sm-10">
                                <textarea id="thuesday" rows="4" class="form-control" placeholder="Menú del día Martes"></textarea>
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                        <div class="form-group" id="form-comida-wednesday">
                            <label for="wednesday" class="control-label col-sm-2">Miércoles</label>
                            <div class="col-sm-10">
                                <textarea id="wednesday" rows="4" class="form-control" placeholder="Menú del día Miércoles"></textarea>
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                        <div class="form-group" id="form-comida-thursday">
                            <label for="thursday" class="control-label col-sm-2">Jueves</label>
                            <div class="col-sm-10">
                                <textarea id="thursday" rows="4" class="form-control" placeholder="Menú del día Jueves"></textarea>
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                        <div class="form-group" id="form-comida-friday">
                            <label for="friday" class="control-label col-sm-2">Viernes</label>
                            <div class="col-sm-10">
                                <textarea id="friday" rows="4" class="form-control" placeholder="Menú del día Viernes"></textarea>
                                <span class="help-block error-msg"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Guardar" class="btn btn-success" id="comida-edit" style="display:none;">
                    <input type="submit" value="Guardar" class="btn btn-success" id="comida-store">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('comida.update', 'id_comida')}}" id="form-comida-update">
        @method('put')  @csrf
    </form>
    <form action="{{route('comida.destroy', 'id_comida')}}" id="form-comida-delete">
        @method('delete')   @csrf
    </form>
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-notify.js')}}"></script>
    <script src="{{asset('admin/js/pages/DataTable.js')}}"></script>
    <script src="{{asset('admin/js/pages/Comida.js')}}" charset="utf-8"></script>
    <script type="text/javascript">
        let comidaURLShow = "{{route('comida.show', 'id_comida')}}";
        let comidaPDF = "{{route('comida.pdf', 'id_comida')}}";
    </script>
@endsection

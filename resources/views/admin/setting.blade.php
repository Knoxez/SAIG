@extends('layouts.admin')
@section('title', 'Miscellaneous')

@section('css')
<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('main')
    <div class="page-title">
        <h3>Miscellaneous</h3>
    </div>

    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <div class="panel-title">Grupos</div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tbl_grupo" class="displpay table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Grupo</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <th>ID</th>
                                    <th>Grupo</th>
                                    <th>Acción</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="#modal-grupo" class="btn btn-info" data-toggle="modal">Crear</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <div class="pabel-title">Tipos de Eventos</div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tbl_type" class="display table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="#modal-type" class="btn btn-info" onclick="ClearType()" data-toggle="modal">Crear</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <div class="panel-title">Tags</div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tbl_tag" class="displpay table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tag</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <th>ID</th>
                                    <th>Tag</th>
                                    <th>Acción</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="#modal-tag" class="btn btn-info" onclick="cleanTag()" data-toggle="modal">Crear</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="modal-grupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title-modal">Crear Grupo</h4>
                <hr>
            </div>
            <div class="modal-body">
                <form action="{{route('grupo.store')}}" id="form-grp" class="form-horizontal">
                    @method('post')
                    @csrf
                    <input type="hidden" id="grp-id">
                    <div class="form-group" id="form-group-name">
                        <label for="name" class="control-label col-sm-3">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" id="group_name" class="form-control">
                            <span class="help-block error-msg"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Guardar" class="btn btn-success" id="grp-edit">
                <input type="submit" value="Guardar" class="btn btn-success" id="grupo">
                <button type="button" class="btn btn-default" onclick="clearGrp();" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title-type">Crear Tipo de Publicación</h4>
                <hr>
            </div>
            <div class="modal-body">
                <form action="{{route('type.store')}}" id="form-type" class="form-horizontal">
                    @method('post')
                    @csrf
                    <input type="hidden" id="type-id">
                    <div class="form-group" id="form-type-name">
                        <label for="name" class="control-label col-sm-3">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" id="type_name" class="form-control">
                            <span class="help-block error-msg"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Guardar" class="btn btn-success" id="type-edit" style="display:none;">
                <input type="submit" value="Guardar" class="btn btn-success id="type-store">
                <button type="button" class="btn btn-default" onclick="ClearType();" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title-tag">Crear Tag</h4>
                <hr>
            </div>
            <div class="modal-body">
                <form action="{{route('tags.store')}}" id="form-tag-store" class="form-horizontal">
                    @method('post')
                    @csrf
                    <input type="hidden" id="tag-id">
                    <div class="form-group" id="form-group-name">
                        <label for="tag_name" class="control-label col-sm-3">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" id="tag_name" class="form-control">
                            <span class="help-block error-msg"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Guardar" class="btn btn-success" id="tag-edit">
                <input type="submit" value="Guardar" class="btn btn-success" id="tag-store">
                <button type="button" class="btn btn-default" onclick="cleanTag();" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<form action="{{route('grupo.update', 'id')}}" id="form-grp-update">
    @method('put')  @csrf
</form>

<form action="{{route('grupo.destroy', 'id')}}" id="form-grp-delete">
    @method('delete')   @csrf
</form>

<form action="{{route('type.update', 'id')}}" id="form-type-update">
    @method('put')  @csrf
</form>

<form action="{{route('type.destroy', 'id')}}" id="form-type-delete">
    @method('delete')   @csrf
</form>

<form action="{{route('tags.update', 'id')}}" id="form-tag-update">
    @method('put')  @csrf
</form>

<form action="{{route('tags.destroy', 'id')}}" id="form-tag-delete">
    @method('delete')   @csrf
</form>

@endsection

@section('scripts')
<script src="{{asset('admin/js/bootstrap-notify.js')}}"></script>
<script src="{{asset('admin/js/pages/DataTable.js')}}"></script>
<script src="{{asset('admin/js/pages/Group.js')}}"></script>
<script src="{{asset('admin/js/pages/Type.js')}}"></script>
<script src="{{asset('admin/js/pages/Tag.js')}}"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $('.active').removeClass('active');
    $('#diverso').addClass('active');

    let GrpEdit = "{{action('GroupsController@show', 'id_group')}}";
    let typeEdit = "{{action('TypeController@show', 'id_type')}}";
    let tagShow = "{{route('tags.show', 'id_tag')}}";
</script>
@endsection

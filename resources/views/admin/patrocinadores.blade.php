@extends('layouts.admin')

@section('title', 'Patrocinadores')

@section('css')
<link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('main')
    <div class="page-title">
        <h3>Escuela</h3>
    </div>

    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <div class="panel-title">Datos del patrocinador</div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <form action="{{route('sponsor.store')}}" id="form-sponsor-store" enctype="multipart/form-data">
                            @method('post') @csrf
                            <div class="img-container" id="file-input">
                                <img src="" id="sponsor_image">
                                <div class="icon-image" style="background-image: url('{{asset('admin/images/icons/picture.png')}}'); width:32px; height:32px;"></div>
                            </div>
                            <input type="file" id="sponsor_file" name="image" accept="image/*" style="display:none;">
                            <div class="">
                                <input type="hidden" id="id_sponsor" value="">
                                <input type="text" name="sponsor_name" id="sponsor_name" class="form-control" placeholder="Nombre del patrocinador">
                            </div>
                            <div class="">
                                <input type="submit" class="btn btn-block btn-success" id="btn-update" value="Guardar">
                                <input type="submit" class="btn btn-block btn-success" id="btn-store" value="Crear">
                                <input type="button" class="btn btn-block btn-default" id="btn-cancel" value="Cancelar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h3 class="panel-title">Patrocinadores</h3>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tbl_sponsor" class="display table" style="with:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patrocinador</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patrocinador</th>
                                        <th>Acción</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{route('sponsor.act', 'id_sponsor')}}" enctype="multipart/form-data" id="form-sponsor-update">
        @method('post')  @csrf
    </form>
    <form action="{{route('sponsor.destroy', 'id_sponsor')}}" id="form-sponsor-delete">
        @method('delete')   @csrf
    </form>
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin/js/bootstrap-notify.js')}}"></script>
    <script src="{{asset('admin/js/pages/DataTable.js')}}" charset="utf-8"></script>
    <script src="{{asset('admin/js/pages/Sponsor.js')}}" charset="utf-8"></script>
    <script type="text/javascript">
        let sponsorShowURL = "{{route('sponsor.show', 'id_sponsor')}}";
    </script>
@endsection

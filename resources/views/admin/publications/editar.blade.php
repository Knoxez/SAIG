@extends('layouts.admin')
@section('title', 'Editar Publicación')

@section('css')
    <link href="{{ asset('admin/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('admin/plugins/summernote-master/summernote.css') }}" rel="stylesheet">
@endsection

@section('main')
    <div class="page-title">
        <h3>Editar publicación</h3>
    </div>

    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{route('publication.act', $public->id )}}" id="form-publications">
                            @method('post') @csrf
                            <div class="col-md-3 col-lg-6">
                                <div class="img-container" id="file-input">
                                    <img src="{{asset('/images/'.auth()->user()->username.'/publications/'.$public->title.'/'.$public->image)}}" id="publication-img">
                                    <div class="icon-image" style="background-image: url('{{asset('admin/images/icons/picture.png')}}'); width:32px; height:32px;"></div>
                                </div>
                                <input type="file" name="image" id="publication_file" accept="image/*" style="Display:none">
                            </div>
                            <div class="col-md-3 col-lg-6">
                                <div class="form-group" id="form-publication-title">
                                    <label for="Title" class="control-label col-sm-2">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" id="title" class="form-control" value="{{$public->title}}">
                                    </div>
                                </div>
                                <div class="form-group" id="form-publication-description">
                                    <label for="description" class="control-label col-sm-2">Descripción</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" rows="5" class="form-control">{{$public->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group" id="form-publication-type">
                                    <label for="type" class="control-label col-sm-2">Categoria</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="type" id="type" tabindex="-1">
                                            @foreach ($type as $type)
                                                <option value="{{$type->id}}">{{$type->type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="form-publication-tags">
                                    <label for="tags" class="control-label col-sm-2">Tags</label>
                                    <div class="col-sm-10">
                                        <select name="tags[]" id="tags" class="form-control" multiple>
                                            @foreach ($tag as $tags)
                                                <option value="{{$tags->id}}">{{$tags->tag_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group" id="form-publication-content">
                                    <div class="col-sm-12">
                                        <label for="content" class="control-label">Contenido</label>
                                        <hr>
                                        <textarea name="content" class="form-control" id="content">

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" name="btn-store" class="btn btn-success" id="btn-store">Guardar</button>
                        <a href="{{route('publications.index')}}" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('admin/js/pages/Publications.js')}}"></script>
    <script src="{{asset('admin/js/pages/Select2.js')}}"></script>
    <script src="{{asset('admin/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{asset('admin/plugins/summernote-master/summernote.min.js')}}"></script>
    <script src="{{asset('admin/js/pages/Summernote.js')}}"></script>
    <script type="text/javascript">
        let tag = [
            @foreach ($my_tags as $tags)
                "{{$tags}}",
            @endforeach
        ];
        $('#type').val({{$public->type_id}}).trigger('change');
        $('#tags').val(tag).trigger('change');
        let code = {!! json_encode($public->content) !!};
        $('#content').code(code);
        let categoryPublication = "{{route('selectType')}}";
        let tagPublication = "{{route('selectTag')}}";
        let index = "{{route('publications.index')}}";
    </script>
@endsection

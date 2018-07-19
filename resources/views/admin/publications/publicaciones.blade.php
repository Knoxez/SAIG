@extends('layouts.admin')
@section('title', 'Publicaciones')

@section('css')
<link href="{{asset('admin/plugins/checkoutconcepts/css/checkout-cornerflat.css')}}" rel="stylesheet"/>
<link href="{{asset('admin/plugins/product-preview-slider/css/style.css')}}" rel="stylesheet">
@endsection

@section('main')
    <div class="page-title">
        <div class="row">
            <div class="col-md-8 col-lg-8">
                <h3>Publicaciones</h3>
            </div>
            <div class="col-md-2 col-lg-offset-2 col-lg-2">
                <a href="{{route('publications.create')}}" class="btn btn-info btn-block">Crear</a>
            </div>
        </div>
    </div>

    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <ul class="cd-gallery" id="load">
                @foreach ($publications as $publication)
                    <li style="height:350px;" id="{{$publication->id}}">
                        <div class="public-container">
                            <img src="{{asset('/images/'.auth()->user()->username.'/publications/'.$publication->title.'/'.$publication->image)}}" alt="None">
                        </div>
                        <div class="cd-item-info">
                            <b><a>{{$publication->title}}</a></b>
                            <em class="cd-price">{{ date('d/ M/ Y', strtotime($publication->updated_at)) }}</em>
                        </div>
                        <div class="cd-item-details">
                                <a href="{{route('publications.show', $publication->id) }}" class="pull-left edit"><i class="icon-pencil"></i>Editar</a>
                            @if ($publication->status == "ON")
                                <a href="javascript:void(0);" class="pull-right btn_on off" id="{{$publication->id}}"><i class="icon-power"></i>Desactivar</a>
                            @else
                                <a href="javascript:void(0);" class="pull-right btn_on on" id="{{$publication->id}}"><i class="icon-power"></i>Activar</a>
                            @endif
                        </div>
                    </li>
                @endforeach
                </ul>
                <center>
                    {{$publications->render()}}
                </center>
            </div>
        </div>
    </div>
    <form action="{{route('publications.change', 'id')}}" id="form-public-update">
        @method('put') @csrf
    </form>
@endsection

@section('scripts')
<script src="{{asset('admin/js/pages/Publications.js')}}"></script>
<script type="text/javascript">
    let publicationShow = "{{route('publications.show', 'id')}}";
    let index = "{{route('publications.index')}}";
</script>
@endsection

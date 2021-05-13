@extends('auth.layouts.app')
@isset($gallery)
@section('title', 'Редактировать галерею '. $gallery->name)
@else
@section('title', 'Создать галерею')
@endisset

@section('content')
<div @isset($gallery) ng-app="appGallery" @endisset class="container-fluid">

    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    @yield('title')
                    @isset($gallery) 
                    <a class="btn btn-primary btn-sm float-right" href="{{route('gallery.create')}}"><i class="far fa-plus-square mr-2"></i>Создать галерею</a>
                    @endisset
                </div>


                <div class="card-body">
                    @isset($gallery)
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content-tab" aria-selected="true">Контент</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images-tab" aria-selected="false">Изображения</a>
                        </li>
                    </ul>
                    @endisset


                    @if(session()->has('message'))
                    <div class="alert alert-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session() -> get('message')}}

                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error}}</li>
                            @endforeach
                        </ul>

                    </div>
                    @endif

                    <form 
                        @isset($gallery)
                        action="{{ route('gallery.update', $gallery)}}" 
                        @else
                        action="{{ route('gallery.store')}}"  
                        @endisset



                        method="POST" enctype='multipart/form-data'>
                        @csrf


                        <div class="tab-content mt-4" id="myTabContent">


                            @isset($gallery)
                            <!--------------------- TAB IMAGES ------------------------->
                            <div ng-controller="dropzoneUploadsCtrl" class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Выберите изображения</h6>
                                    </div>
                                    <div class="panel-body">
                                        <!------------- Dropzone MultiUploads ------------------>
                                        <ng-dropzone class="dropzone" options="dzOptions" callbacks="dzCallbacks" methods="dzMethods"></ng-dropzone>
                                        <!------------- END Dropzone MultiUploads ------------------>
                                    </div>


                                    <div class="d-flex flex-row mt-2 align-items-center">
                                        <a style="color: #fff" ng-click="dzMethods.processQueue();" class="btn btn-primary btn-lg m-auto button-upload"><i class="fas fa-download mr-2"></i>Загрузить файлы</a>
                                    </div>
                                </div>



                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Загруженные изображения</h6>
                                    </div>
                                    <div class="panel-body" id="uploaded_images">
                                        <list-imgs></list-imgs>
                                    </div>
                                </div>


                            </div>
                            <!--------------------- END TAB IMAGES ------------------------->
                            @endisset


                            <!------------- TAB CONTENT ----------------->
                            <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">

                                @isset($gallery) 
                                @method('PUT') 
                                <input id="galleryId" type='hidden' name='galleryId' value='{{$gallery -> id}}'>
                                @endisset





                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="">Название <span class="required">*</span></label>
                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   value='{{old('name', isset($gallery)? $gallery -> name: null)}}' placeholder="Название">
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="">Заголовок в описании <span class="required">*</span></label>
                                            <input name="header" type="text" class="form-control @error('header') is-invalid @enderror" 
                                                   value='{{old('header', isset($gallery)? $gallery -> header: null)}}' placeholder="Заголовок">
                                        </div>
                                    </div>


                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="">Класс Галереи </label>
                                            <input name="class" type="text" class="form-control @error('class') is-invalid @enderror" 
                                                   value='{{old('class', isset($gallery)? $gallery -> class: null)}}' placeholder="Класс галереи">
                                        </div>
                                    </div>

                                </div>





                                <div class="row">





                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="">Описание</label>
                                            <textarea rows='12' class="form-control @error('description') is-invalid @enderror editor" name="description">{{old('description', isset($gallery)? $gallery -> description: null)}}</textarea>
                                        </div>
                                    </div>


                                </div>


                                @isset($gallery)
                                <div class="row">
                                    @foreach(
                                    [
                                    'hidden' => 'Показать/Скрыть галерею' ] as $field=>$title)
                                    <div class="col-xl-3">

                                        <div class="form-check">
                                            <input 
                                                @if(isset($gallery) && $gallery->$field == 1 || old($field) == 'on')
                                            checked=checked 
                                            @endif
                                            type="checkbox" name="{{$field}}" id="{{$field}}" class="form-check-input">
                                            <label class="form-check-label">{{$title}}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endisset
                                
                                
                            </div>
                            <!------------- END TAB CONTENT ----------------->



                        </div>


                        <div class="row mt-3">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Сохранить</button>  
                                    <button type="reset" class="btn btn-primary">Сбросить</button>
                                </div>
                            </div>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@isset($gallery)
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
<script src="https://rawgit.com/enyo/dropzone/d8ef7a82e6ab5447c1f2d9512c8e1bfd4de5ac9e/dist/dropzone.js"></script>
<link href="{{ mix('css/admin/ng-dropzone.css')}}" rel="stylesheet">
<script src="{{ mix("js/admin/ng-dropzone.js")}}" defer></script>
<script src="{{ asset('js/admin/angular/appGallery.js?v2')}}" defer></script>
<script src="{{ asset('js/admin/angular/appGalleryScripts.js?v1')}}" defer></script>
@endisset

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ mix("js/admin/bundle.js")}}"></script>
<script type='text/javascript'>

//Cyrillic To translite
//var inputTitle = $('input[name=name]');
//var inputUrl = $('input[name=url]');
//inputTitle.on('blur focus keyup keypress', function (event) {
//    inputUrl.val(cyrillicToTranslit().transform(inputTitle.val().toLowerCase(), "_"));
//});

    var editor_config = {
    path_absolute: "/",
            selector: "textarea.editor",
            plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function (field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;
            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
            } else {
            cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
            file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
            });
            }
    };
    tinymce.init(editor_config);
</script>
@endsection


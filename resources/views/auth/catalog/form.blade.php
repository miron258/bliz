@extends('auth.layouts.app')
@isset($catalog)
@section('title', 'Редактировать каталог '. $catalog->name)
@else
@section('title', 'Создать каталог')
@endisset

@section('content')
<div class="container-fluid">

    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    @yield('title')
                    @isset($catalog) 
                    <a target="_blank" class="btn btn-success btn-sm mr-5" href="{{route('catalog_site.index', $catalog->url)}}"><i class="fas fa-eye mr-2"></i>Просмотреть каталог</a>
                    <a class="btn btn-primary btn-sm float-right" href="{{route('catalog.create')}}"><i class="far fa-plus-square mr-2"></i>Создать каталог</a>
                    @endisset
                </div>


                <div class="card-body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content-tab" aria-selected="true">Контент</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images-tab" aria-selected="false">Изображения</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings-tab" aria-selected="false">Настройки</a>
                        </li>
                    </ul>



                    @if(session()->has('message'))
                    <div class="alert alert-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session()->get('message') }}

                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                    @endif

                    <form 
                        @isset($catalog)
                        action="{{ route('catalog.update', $catalog) }}" 
                        @else
                        action="{{ route('catalog.store') }}"  
                        @endisset



                        method="POST" enctype='multipart/form-data'>
                        @csrf


                        <div class="tab-content mt-4" id="myTabContent">


                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="row">

                                    <div class="col-xl-12">
                                        <div>
                                            @if(!empty($catalog->img))
                                            <img style="width:250px;" class="img-rounded img-fluid" alt="{{$catalog->name}}" src="{{Storage::url($catalog->img)}}">
                                            @endif
                                        </div>
                                        <label>Выберите изображение</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>

                                </div>
                            </div>


                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="row">

                                    <div class='col-xl-6'>
                                        <div class='form-group'>
                                            <label>Позиция</label>
                                            <input class='form-control' type='text' name='position' value='{{old('position', isset($catalog)? $catalog->position: 0)}}'> 
                                        </div>  
                                    </div>
                                    <div class='col-xl-6'>
                                        <div class='form-group'>
                                            <label>Записей на страницу</label>
                                            <input class='form-control' type='text' name='per_page' value='{{old('per_page', isset($catalog)? $catalog->per_page: 10)}}'> 
                                        </div>  
                                    </div>


                                </div>


                                <div class="row">

                                    <div class='col-xl-6'>
                                        <div class='form-group'>
                                            <label>Сортировать по</label>
                                            <select class='form-control' name='sort'>
                                                <option 
                                                    @if(old('sort') == 1) selected="selected" @endif 
                                                    @if(isset($catalog) && $catalog->sort == 1) selected="selected" @endif 
                                                    value='1'>Дате публикации/ID
                                                </option>

                                                <option 
                                                    @if(old('sort') == 2) selected="selected" @endif 
                                                    @if(isset($catalog) && $catalog->sort == 2) selected="selected" @endif 
                                                    value='2'>Алфавиту
                                                </option>

                                                <option 
                                                    @if(old('sort') == 3) selected="selected" @endif 
                                                    @if(isset($catalog) && $catalog->sort == 3) selected="selected" @endif 
                                                    value='3'>Позиции
                                                </option>
                                            </select>
                                        </div>  
                                    </div>
                                    <div class='col-xl-6'>
                                        <div class='form-group'>
                                            <label>Порядок сортировки</label>
                                            <select class='form-control' name='sort_order'>
                                                <option 
                                                    @if(old('sort_order') == 1) selected="selected" @endif 
                                                    @if(isset($catalog) && $catalog->sort_order == 1) selected="selected" @endif 
                                                    value='1'>В порядке убывания
                                                </option>

                                                <option 
                                                    @if(old('sort_order') == 2) selected="selected" @endif 
                                                    @if(isset($catalog) && $catalog->sort_order == 2) selected="selected" @endif 
                                                    value='2'>В порядке возрастания
                                                </option>
                                            </select>
                                        </div>  
                                    </div>


                                </div>

                            </div>

                            <!------------- TAB CONTENT ----------------->
                            <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">

                                <div class="row">
                                    @isset($catalog) 
                                    @method('PUT') 
                                    <input type='hidden' name='catalogId' value='{{$catalog->id}}'>
                                    @endisset
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="">Meta title <span class="required">*</span></label>
                                            <input class="form-control @error('meta_tag_title') is-invalid @enderror" type="text" 
                                                   value='{{old('meta_tag_title', isset($catalog)? $catalog->meta_tag_title: null)}}' name="meta_tag_title">     
                                        </div>  
                                    </div>


                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="">Meta description</label>
                                            <input class="form-control" type="text" 
                                                   value='{{old('meta_tag_description', isset($catalog)? $catalog->meta_tag_description: null)}}' name="meta_tag_description">     
                                        </div>  
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="">Meta Keywords</label>
                                            <input class="form-control" type="text" value='{{old('meta_tag_keywords', isset($catalog)? $catalog->meta_tag_keywords: null)}}' name="meta_tag_keywords">     
                                        </div>  
                                    </div>

                                </div>



                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="">Название <span class="required">*</span></label>
                                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                                   value='{{old('name', isset($catalog)? $catalog->name: null)}}' placeholder="Название">
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="">URL адрес <span class="required">*</span></label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" 
                                                   value='{{old('url', isset($catalog)? $catalog->url: null)}}' placeholder="Url адрес">
                                        </div>
                                    </div>


                                    <div class='col-xl-4'>

                                        <div class='form-group'>
                                            <label>Родительский каталог</label>
                                            <select class='form-control' name='parent_id'>
                                                <option value=''>Корневой каталог</option>
                                                @if (isset($catalog))
                                                @php
                                                buildTreeSelectOptions($catalogs,$catalog);
                                                @endphp  
                                                @else
                                                @php
                                                buildTreeSelectOptions($catalogs);
                                                @endphp
                                                @endif
                                            </select>
                                        </div>

                                    </div>

                                </div>





                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="">Анонс</label>
                                            <textarea class="form-control editor" name="anons">{{old('anons', isset($catalog)? $catalog->anons: null)}}</textarea>
                                        </div>

                                    </div>


                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="">Описание <span class="required">*</span></label>
                                            <textarea rows='12' class="form-control @error('description') is-invalid @enderror editor" name="description">{{old('description', isset($catalog)? $catalog->description: null)}}</textarea>
                                        </div>
                                    </div>


                                </div>


                                @isset($catalog)
                                <div class="row">
                                    @foreach(
                                    [
                                    'hidden' => 'Показать/Скрыть каталог', 
                                    'index' => 'Показать/Скрыть из поиска'] as $field=>$title)

                                    <div class="col-xl-3">

                                        <div class="form-check">
                                            <input 
                                                @if(isset($catalog) && $catalog->$field == 1 || old($field) == 'on')
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ mix("js/admin/bundle.js") }}"></script>
<script type='text/javascript'>

//Cyrillic To translite
var inputTitle = $('input[name=name]');
var inputUrl = $('input[name=url]');
inputTitle.on('blur focus keyup keypress', function (event) {
    inputUrl.val(cyrillicToTranslit().transform(inputTitle.val().toLowerCase(), "_"));
});

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


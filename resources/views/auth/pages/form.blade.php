@extends('auth.layouts.app')
@isset($page)
@section('title', 'Редактировать страницу '. $page->name)
@else
@section('title', 'Создать страницу')
@endisset

@section('content')
<style type="text/css">
    .CodeMirror {
        border: 1px solid #eee;
        height: auto;
    }

    .CodeMirror-scroll
    {
        resize: vertical;
    }
</style>
<div class="container-fluid">

    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    @yield('title')
                    @isset($page) 
                    <a target="_blank" class="btn btn-success btn-sm mr-5" href="{{route('page_site.index', $page->url)}}"><i class="fas fa-eye mr-2"></i>Просмотреть страницу</a>
                    <a class="btn btn-primary btn-sm float-right" href="{{route('page.create')}}"><i class="far fa-plus-square mr-2"></i>Создать страницу</a>
                    @endisset
                </div>



                <div class="card-body">

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session()->get('message') }}

                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
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
                        @isset($page)
                        action="{{ route('page.update', $page) }}" 
                        @else
                        action="{{ route('page.store') }}"  
                        @endisset



                        method="POST" enctype='multipart/form-data'>
                        @csrf
                        <div class="row">
                            @isset($page) 
                            @method('PUT') 
                            <input type='hidden' name='pageId' value='{{$page->id}}'>
                            @endisset
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="">Meta title <span class="required">*</span></label>
                                    <input class="form-control @error('meta_tag_title') is-invalid @enderror" type="text" 
                                           value='{{old('meta_tag_title', isset($page)? $page->meta_tag_title: null)}}' name="meta_tag_title">     
                                </div>  
                            </div>


                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="">Meta description</label>
                                    <input class="form-control" type="text" 
                                           value='{{old('meta_tag_description', isset($page)? $page->meta_tag_description: null)}}' name="meta_tag_description">     
                                </div>  
                            </div>

                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="">Meta Keywords</label>
                                    <input class="form-control" type="text" value='{{old('meta_tag_keywords', isset($page)? $page->meta_tag_keywords: null)}}' name="meta_tag_keywords">     
                                </div>  
                            </div>

                        </div>



                        <div class="row">
                            <div class="@if(isset($page)) col-xl-4 @else col-xl-6 @endif">
                                <div class="form-group">
                                    <label for="">Название <span class="required">*</span></label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                           value='{{old('name', isset($page)? $page->name: null)}}' placeholder="Название">
                                </div>
                            </div>

                            <div class="@if(isset($page)) col-xl-4 @else col-xl-6 @endif">
                                <div class="form-group">
                                    <label for="">URL адрес <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" 
                                           value='{{old('url', isset($page)? $page->url: null)}}' placeholder="Url адрес">
                                </div>
                            </div>

                            @isset($page)
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="">CSS Класс для страницы (рекомендуется чтобы совпадал с URL)</label>
                                    <input type="text" class="form-control @error('class_page') is-invalid @enderror" name="class_page" 
                                           value='{{old('class_page', isset($page)? $page->class_page: null)}}' placeholder="CSS Класс">
                                </div>
                            </div>
                            @endisset

                        </div>





                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="">Анонс</label>
                                    <textarea rows='6' class="form-control editor" name="anons">{{old('anons', isset($page)? $page->anons: null)}}</textarea>
                                </div>

                            </div>


                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="">Описание <span class="required">*</span></label>
                                    <textarea rows='15' class="form-control @error('description') is-invalid @enderror editor" name="description">{{old('description', isset($page)? $page->description: null)}}</textarea>
                                </div>
                            </div>


                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="">HTML код</label>
                                    <textarea id='codemirror' class="form-control editor-html" name="html">{{old('html', isset($page)? $page->html: null)}}</textarea>
                                </div>
                            </div>


                        </div>


                        @isset($page)
                        <div class="row">
                            @foreach(
                            [
                            'hidden' => 'Показать/Скрыть страницу', 
                            'index' => 'Показать/Скрыть из поиска'] as $field=>$title)
                            <div class="col-xl-3">
                                <div class="form-check">
                                    <input 
                                        @if(isset($page) && $page->$field == 1 || old($field) == 'on')
                                    checked=checked 
                                    @endif
                                    type="checkbox" name="{{$field}}" id="{{$field}}" class="form-check-input">
                                    <label class="form-check-label">{{$title}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endisset



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
<!------------ Plugin CodeMirror ------------>
<link href="{{ mix("css/admin/codemirror.css") }}" rel="stylesheet">
<link href="{{ mix("css/admin/darcula.css") }}" rel="stylesheet">
<script src="{{ mix("js/admin/codemirror.js") }}"></script>


<!------------ End Plugin CodeMirror ------------>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ mix("js/admin/bundle.js") }}"></script>
<script type='text/javascript'>

//Init CodeMirror
var myTextarea = document.getElementById('codemirror');
var editor = CodeMirror.fromTextArea(myTextarea, {
    mode: "htmlmixed",
    theme: "darcula",
    autocorrect: true,
    lineNumbers: true,
    tabMode: "indent",
    matchBrackets: true,
    electricChars: true,
    autoClearEmptyLines: true,
    path: 'js/admin',
    searchMode: 'inline',
    onCursorActivity: function () {
        editor.setLineClass(hlLine, null);
        hlLine = editor.setLineClass(editor.getCursor().line, "activeline");
    }
});
//editor.setSize("100%', 1200);


//$('.CodeMirror').resizable({
//  resize: function() {
//    editor.setSize($(this).width(), $(this).height());
//  }
//});
//var hlLine = editor.setLineClass(0, "activeline");

//
//console.log(editor.getValue());


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


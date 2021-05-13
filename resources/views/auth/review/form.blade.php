@extends('auth.layouts.app')
@isset($review)
    @section('title', 'Редактировать отзыв '. $review->name)
@else
    @section('title', 'Создать отзыв')
@endisset

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        @yield('title')
                        @isset($review)
                            <a class="btn btn-primary btn-sm float-right" href="{{route('review.create')}}">Создать отзыв</a>
                        @endisset

                    </div>

                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content-tab" aria-selected="true">Контент</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images-tab" aria-selected="false">Фото</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fields-tab" data-toggle="tab" href="#fields" role="tab" aria-controls="fields-tab" aria-selected="false">Дополнительные поля</a>
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
                            @isset($review)
                            action="{{ route('review.update', $review) }}"
                            @else
                            action="{{ route('review.store') }}"
                            @endisset



                            method="POST" enctype='multipart/form-data'>
                            @csrf


                            <div class="tab-content mt-4" id="myTabContent">


                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="row">

                                        <div class="col-12">
                                            <div>
                                                @if(!empty($review->img))
                                                    <img  class="img-rounded img-fluid" alt="{{$review->name}}" src="{{Storage::url($review->img)}}">
                                                @endif
                                            </div>
                                            <label>Выберите изображение</label>
                                            <input type="file" name="image" id="image" class="form-control">
                                        </div>

                                    </div>
                                </div>


                                <div class="tab-pane fade" id="fields" role="tabpanel" aria-labelledby="fields-tab">



                                    <div class="row">

                                        <div class='col-xl-6'>
                                            <div class='form-group'>
                                                <label for="">Текст заказа<span class="required">*</span></label>
                                                <textarea class="form-control editor @error('text_order') is-invalid @enderror" name="text_order">{{old('text_order', isset($review)? $review->text_order: null)}}</textarea>
                                            </div>
                                        </div>
                                        <div class='col-xl-6'>
                                            <div class='form-group'>
                                                <label for="">Адрес<span class="required">*</span></label>
                                                <input class="form-control @error('address') is-invalid @enderror" type="text"
                                                        value='{{old('address', isset($review)? $review->address: null)}}' name="address">

                                            </div>
                                        </div>



                                    </div>

                                </div>

                                <!------------- TAB CONTENT ----------------->
                                <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">

                                    <div class="row">
                                        @isset($review)
                                            @method('PUT')
                                            <input type='hidden' name='reviewId' value='{{$review->id}}'>
                                        @endisset
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Имя <span class="required">*</span></label>
                                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                       value='{{old('name', isset($review)? $review->name: null)}}' name="name">
                                            </div>
                                        </div>




                                    </div>




                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="">Анонс</label>
                                                <textarea class="form-control editor" name="anons">{{old('anons', isset($review)? $review->anons: null)}}</textarea>
                                            </div>

                                        </div>


                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <label for="">Текст отзыва <span class="required">*</span></label>
                                                <textarea rows='12' class="form-control @error('text') is-invalid @enderror editor" name="text">{{old('text', isset($review)? $review->text: null)}}</textarea>
                                            </div>
                                        </div>


                                    </div>


                                    @isset($review)
                                        <div class="row">
                                            @foreach(
                                            [
                                            'hidden' => 'Показать/Скрыть отзыв'
                                            ] as $field=>$title)

                                                <div class="col-xl-3">

                                                    <div class="form-check">
                                                        <input
                                                            @if(isset($review) && $review->$field == 1 || old($field) == 'on')
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
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
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



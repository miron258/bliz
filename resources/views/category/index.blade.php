@extends('category.template')
@isset($category)
    @section('meta_tag_title',  $category->meta_tag_title)
@section('meta_tag_description', $category->meta_tag_description)
@section('meta_tag_keywords', $category->meta_tag_keywords)
@endisset

@section('content')
    <div class='block-view-category'>

        <div class="container-main-description">
            <div class='container'>
                <h1 class="block-view-category__header-block-view-category header-block-view-category  w-100">
                    {{$category -> name}}
                </h1>


                <div class="block-view-category__block-list-materials block-list-materials">

                    @foreach ($materials->chunk(2) as $chunk)

                        <div class="block-list-materials__row-list-materials row-list-materials row">

                        @foreach ($chunk as $material)
                            <!---------------------------- ROW MATERIALS -------------------------->
                                <div
                                    class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12 row-list-materials__box-row-materials box-row-materials">


                                @php $class = $loop->index % 2 === 0 ? 'box-material-left' : 'box-material-right'; @endphp

                                <!------------------------ BOX MATERIAL -------------------->
                                    <div class="row no-gutters box-row-materials__box-material box-material {{$class}}">

                                        <div
                                            class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 box-material__box-img-material box-img-material">
                                            @if(!empty($material->img))
                                                @php $images = json_decode($material->img) @endphp
                                                <img class="img-fluid img-material" alt="{{$material->name}}" src="{{Storage::url($images[0])}}">
                                            @else
                                                <div class="box-img-material-empty"></div>
                                            @endif
                                        </div>
                                        <div
                                            class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 box-material__box-anons-material box-anons-material">

                                            <div class="box-anons-material__inner-anons-material inner-anons-material">
                                                <h2 class="box-anons-material__title-anons-material title-anons-material">{{$material->name}}</h2>
                                                <div
                                                    class="box-anons-material__anons-material anons-material">{!!$material->anons!!}</div>
                                                <a class="box-anons-material__link-anons-material link-anons-material"
                                                   href="{{route('material_site.index', $material->url)}}">Подробнее</a>
                                            </div>

                                        </div>


                                    </div>
                                    <!------------------------ END BOX MATERIAL -------------------->


                                </div>
                                <!---------------------------- END ROW MATERIALS -------------------------->
                            @endforeach

                        </div>
                    @endforeach

                </div>


            </div>
        </div>
        <div class="wavy-line"></div>


        <!--------------------------- BLOCK FORM --------------------------------->
        <div class="block-form">
            <div class="container">
                <!------------------ START FORM --------------------->
                <form-order></form-order>
                <!------------------ END  FORM --------------------->
            </div>
        </div>
        <!--------------------------- END BLOCK FORM --------------------------------->


    </div>




@endsection

@push('styles')
    <link href="{{ asset('css/category.css') }}" rel="stylesheet">
@endpush


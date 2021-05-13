@extends('material.template')
@isset($material)
    @section('meta_tag_title',  $material->meta_tag_title)
@section('meta_tag_description', $material->meta_tag_description)
@section('meta_tag_keywords', $material->meta_tag_keywords)
@endisset

@section('content')
    <div class='block-view-material'>

        <div class="container-main-description">
            <div class='container'>
                <h1 class="block-view-material__header-block-view-material header-block-view-material  w-100">
                    {!!$material -> name!!}
                </h1>
                <div
                    class="block-view-material__description-material description-material">
                    {!!$material -> description!!}
                </div>
                <a class="link-prev-articles" href="{{route('category_site.index', $category->url)}}"><span class="text-link">К списку статей<span></a>
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
    <link href="{{ asset('css/material.css') }}" rel="stylesheet">
@endpush

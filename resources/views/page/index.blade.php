@extends('page.template')
@isset($page)
    @section('meta_tag_title',  $page->meta_tag_title)
@section('meta_tag_description', $page->meta_tag_description)
@section('meta_tag_keywords', $page->meta_tag_keywords)
@endisset

@section('content')
    <div
         class='block-view-page @if(!empty($page->class_page))block-view-page-{{$page -> class_page}}@endif'>

        <div class="container-main-description">

            <div class='container'>
                <div class="wrapper-header-block-view-page w-100">
                    <h1 class="wrapper-header-block-view-page__header-block-view-page header-block-view-page">
                        {!! $page -> name !!}
                    </h1>
                </div>
                <div
                    class="block-view-page__description-page description-page @if(!empty($page->class_page))description-page-{{$page -> class_page}}@endif">
                    {!!$page -> description!!}
                </div>
            </div>

        </div>
        <div class="wavy-line"></div>


        @if(!empty($page->html))
            <div class="block-view-page__html-page html-page html-page-{{$page -> class_page}}">
                {!!$page -> html!!}
            </div>
        @endif


    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/page.css') }}" rel="stylesheet">
@endpush

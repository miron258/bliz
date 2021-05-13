@extends('template')
@isset($page)
@section('meta_tag_title',  $page->meta_tag_title)
@section('meta_tag_description', $page->meta_tag_description)
@section('meta_tag_keywords', $page->meta_tag_keywords)
@endisset


@section('content')
    @include('layouts.block-company')
@endsection

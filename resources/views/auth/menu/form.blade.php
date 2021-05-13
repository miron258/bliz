@extends('auth.layouts.app')
@isset($menu)
@section('title', 'Редактировать меню '. $menu->name)
@else
@section('title', 'Создать меню')
@endisset

@section('content')
<div class="container-fluid">

    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    @yield('title')
                    @isset($menu) 
                    <a class="btn btn-primary btn-sm float-right" href="{{route('menu.create')}}"><i class="far fa-plus-square mr-2"></i>Создать меню</a>
                    @endisset
                </div>



                <div class="card-body">

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session()-> get('message')}}

                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
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
                        @isset($menu)
                        action="{{ route('menu.update', $menu)}}" 
                        @else
                        action="{{ route('menu.store')}}"  
                        @endisset



                        method="POST" enctype='multipart/form-data'>
                        @csrf
                        @isset($menu) 
                        @method('PUT') 
                        <input type='hidden' name='menuId' id="menuId" value='{{$menu-> id}}'>
                        @endisset


                        <div class="row">
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="">Название <span class="required">*</span></label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                           value='{{old('name', isset($menu)? $menu-> name: null)}}' placeholder="Название">
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label for="">Класс <span class="required">*</span></label>
                                    <input name="class" type="text" class="form-control @error('class') is-invalid @enderror" 
                                           value='{{old('class', isset($menu)? $menu->class: null)}}' placeholder='CSS Класс'>
                                </div>
                            </div>

                            <div class='col-xl-4'>
                                <div class='form-group'>
                                    <label>Сортировать по<span class="required">*</span></label>
                                    <select class='form-control' name='order'>
                                        <option 
                                            @if(old('order') == 0) selected="selected" @endif 
                                            @if(isset($menu) && $menu->order == 0) selected="selected" @endif 
                                            value="0">по умолчанию</option>
                                        <option 
                                            @if(old('order') == 1) selected="selected" @endif 
                                            @if(isset($menu) && $menu->order == 1) selected="selected" @endif 
                                            value='1'>Дате публикации/ID
                                        </option>

                                        <option 
                                            @if(old('order') == 2) selected="selected" @endif 
                                            @if(isset($menu) && $menu->order == 2) selected="selected" @endif 
                                            value='2'>Алфавиту
                                        </option>

                                        <option 
                                            @if(old('order') == 3) selected="selected" @endif 
                                            @if(isset($menu) && $menu->order == 3) selected="selected" @endif 
                                            value='3'>Позиции
                                        </option>
                                    </select>
                                </div>  
                            </div>

                        </div>


                        <!------------------- Блок создания пунктов меню -------------------->
                        @isset($menu)
                        <div class="row">
                            <div ng-app="appMenuItems" data-no-turbolink ng-controller="formMenuItemsCtrl" class="col-xl-12">
                                <div class="form-group">
                                    <div class="block-modal-form-menu-item">
                                        <a href="" ng-click="openModalSave()" class="btn btn-success"><i class="far fa-plus-square mr-2"></i>Создать пункт меню</a>
                                    </div>
                                </div>
                                <div ng-controller="menuItemsCtrl">
                                    <menu-items ng-if="menuItemsTree.length > 0"></menu-items>   
                                </div>
                            </div>
                        </div>
                        @endisset
                        <!------------------- Конец Блока создания пунктов меню -------------------->



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
<script src="{{ asset('js/admin/angular/appMenuItems.js?v2')}}" defer></script>
<script src="{{ asset('js/admin/angular/appMenuItemsScripts.js?v1')}}" defer></script>
<script src="{{ mix("js/admin/bundle.js")}}"></script>
@endsection


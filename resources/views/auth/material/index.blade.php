@extends('auth.layouts.app')
@section('title', 'Список материалов')
@section('content')
<div ng-app='ngApp' class="container-fluid">
    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div ng-controller="materialCtrl" class="card">
                <div class="card-header">@yield('title')</div>


                <!------------- Form Filter Search ------------------>
                <form ng-submit="submitForm()" name="formMaterialsFilter" method="get">
                    <div class='form-row ml-3'>

                        <div class="col-xl-3">
                            <label>Название</label>
                            <input name="name" type="text" class="form-control" ng-model="filter.name">
                        </div>

                        <div class="col-xl-3">
                            <label>Выбор категории</label>
                            <select class='form-control' ng-model="filter.idCategory" name='id_category'>
                                <option value="">Все категории</option>
                                @if (isset($categories))
                                @php
                                buildTreeSelectOptions($categories);
                                @endphp
                                @endif
                            </select>
                        </div>

                        <div class="col-xl-2">
                            <button style="margin-top: 35px;" type="submit" class="btn btn-primary btn-sm "><i class="fas fa-search-plus mr-2"></i>Искать</button>
                            <button style="margin-top: 35px;" type="reset" class="btn btn-primary btn-sm"><i class="fas fa-filter mr-2"></i>Сбросить фильтр</button>

                        </div>

                    </div>
                </form>
                <!------------- End Form Filter Search ------------------>


                <div class="col-12 ml-1 mt-2">
                    <a class="btn btn-primary btn-sm" href="{{route('material.create')}}"><i class="far fa-plus-square mr-2"></i>Создать материал</a>
                    <button ng-disabled="deleteButton" class="btn btn-danger btn-sm" ng-click="deleteMaterials()"><i class="fas fa-trash mr-2"></i>Удалить отмеченные</button>
                </div>


                <div ng-init="getMaterials()" class="card-body">
                    <div ng-bind-html="message"></div>
                    <table-materials></table-materials>
                    <div class="block-pagination">
                        <materials-pagination></materials-pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- Plugin Angular Resourse JS --->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-resource/1.8.0/angular-resource.min.js"></script>
<script src="{{ asset('js/admin/angular/ngApp.js')}}"></script>
<script src="{{ asset('js/admin/angular/ngAppScripts.js')}}"></script>
@endsection

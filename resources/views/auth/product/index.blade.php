@extends('auth.layouts.app')
@section('title', 'Список товаров')
@section('content')
<div ng-app='ngApp' class="container-fluid">
    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div ng-controller="productCtrl" class="card">
                <div class="card-header">@yield('title')</div>

                <!------------- Form Filter Search ------------------>
                <form ng-submit="submitForm()" name="formProductsFilter" method="get">
                    <div class='form-row ml-3'>

                        <div class="col-xl-3">
                            <label>Название</label>
                            <input name="name" type="text" class="form-control" ng-model="filter.name">
                        </div>

                        <div class="col-xl-2">
                            <label>Артикул</label>
                            <input name="art" type="text" class="form-control" ng-model="filter.art">
                        </div>


                        <div class="col-xl-2">
                            <label>Цена</label>
                            <input name="price" type="text" class="form-control" ng-model="filter.price">
                        </div>


                        <div class="col-xl-3">

                            <label>Выбор каталога</label>
                            <select class='form-control' ng-model="filter.idCatalog" name='id_catalog'>
                                <option value="">Все каталоги</option>
                                @if (isset($catalogs))
                                @php
                                buildTreeSelectOptions($catalogs);
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
                    <a class="btn btn-primary btn-sm" href="{{route('product.create')}}"><i class="far fa-plus-square mr-2"></i>Создать продукт</a>
                    <button ng-disabled="deleteButton" class="btn btn-danger btn-sm" ng-click="deleteProducts()"><i class="fas fa-trash mr-2"></i>Удалить отмеченные</button>
                </div>


                <div ng-init="getProducts()" class="card-body">
                    <div ng-bind-html="message"></div>
                    <table-products></table-products>
                    <div class="block-pagination">
                        <products-pagination></products-pagination>
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

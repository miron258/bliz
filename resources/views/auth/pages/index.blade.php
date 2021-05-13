@extends('auth.layouts.app')
@section('title', 'Список текстовых страниц')
@section('content')
<div ng-app='ngApp' class="container-fluid">
    <div class="row-fluid justify-content-center">
        <div class="col-xl-12">
            <div ng-controller="pageCtrl" class="card">
                <div class="card-header">@yield('title')</div>

                <!------------- Form Filter Search ------------------>
                <form ng-submit="submitForm()" name="formPagesFilter" method="get">
                    <div class='form-row ml-3'>

                        <div class="col-xl-5">
                            <label>Название</label>
                            <input name="name" type="text" class="form-control" ng-model="filter.name">
                        </div>


                        <div class="col-xl-2">
                            <button style="margin-top: 35px;" type="submit" class="btn btn-primary btn-sm "><i class="fas fa-search-plus mr-2"></i>Искать</button>
                            <button style="margin-top: 35px;" type="reset" class="btn btn-primary btn-sm"><i class="fas fa-filter mr-2"></i>Сбросить фильтр</button>

                        </div>

                    </div>
                </form>
                <!------------- End Form Filter Search ------------------>


                <div class="col-12 ml-1 mt-2">
                    <a class="btn btn-primary btn-sm" href="{{route('page.create')}}"><i class="far fa-plus-square mr-2"></i>Создать страницу</a>
                    <button ng-disabled="deleteButton" class="btn btn-danger btn-sm" ng-click="deletePages()"><i class="fas fa-trash mr-2"></i>Удалить отмеченные</button>
                </div>

                <div ng-init="getPages()" class="card-body">
                    <div ng-bind-html="message"></div>
                    <table-pages></table-pages>
                    <div class="block-pagination">
                        <pages-pagination></pages-pagination>
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

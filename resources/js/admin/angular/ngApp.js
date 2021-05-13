'use strict';
global.ngApp = angular.module('ngApp', [
    'pathgather.popeye',
    'ngSanitize',
    'ui.tree',
    'ngRoute',
    'ngResource',
    'ui.bootstrap',
    'ngMessages']).run(function ($rootScope, $templateCache) {

    $templateCache.removeAll();
});
//global.ngApp.config(['$routeProvider', function ($routeProvider) {
//        $routeProvider.
//                when('/products', {
//                    controller: 'productCtrl',
//                    templateUrl: '/admin/table_products'}).
//                otherwise({redirectTo: '/products'});
//    }]);

global.ngApp.config(function ($httpProvider) {

    $httpProvider.interceptors.push(function ($q, $rootScope) {
        return {
            'request': function (config) {
                $rootScope.$broadcast('loading-started');
                return config || $q.when(config);
            },
            'response': function (response) {
                $rootScope.$broadcast('loading-complete');
                return response || $q.when(response);
            }
        };
    });
});


global.ngApp.directive("loadingIndicator", function () {
    return {
        restrict: "A",
        template: "<div id='loading'> <img src='images/loading.gif'/> Loading... < /div>",
        link: function (scope, element, attrs) {
            element.css({"display": "none"});
            scope.$on("loading-started", function (e) {
                element.css({"display": ""});
            });
            scope.$on("loading-complete", function (e) {
                element.css({"display": "none"});
            });
        }
    };

});


global.ngApp.directive("compareTo", function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function (scope, element, attributes, ngModel) {
            ngModel.$validators.compareTo = function (modelValue) {
                return modelValue == scope.otherModelValue;
            };
            scope.$watch("otherModelValue", function () {
                ngModel.$validate();
            });
        }
    };
});


global.ngApp.directive('productsPagination', function () {
    return{
        restrict: 'E',
        template: '<ul class="pagination">' +
                '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getProducts(1)">&laquo;</a></li>' +
                '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getProducts(currentPage-1)">&lsaquo; Назад</a></li>' +
                '<li class="page-item" ng-repeat="i in range" ng-class="{active : currentPage == i}">' +
                '<a class="page-link" href="javascript:void(0)" ng-click="getProducts(i)">{{i}}</a>' +
                '</li>' +
                '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getProducts(currentPage+1)">Вперед &rsaquo;</a></li>' +
                '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getProducts(totalPages)">&raquo;</a></li>' +
                '</ul>'
    };
});
global.ngApp.directive('materialsPagination', function () {
    return{
        restrict: 'E',
        template: '<ul class="pagination">' +
                '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getMaterials(1)">&laquo;</a></li>' +
                '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getMaterials(currentPage-1)">&lsaquo; Назад</a></li>' +
                '<li class="page-item" ng-repeat="i in range" ng-class="{active : currentPage == i}">' +
                '<a class="page-link" href="javascript:void(0)" ng-click="getMaterials(i)">{{i}}</a>' +
                '</li>' +
                '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getMaterials(currentPage+1)">Вперед &rsaquo;</a></li>' +
                '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getMaterials(totalPages)">&raquo;</a></li>' +
                '</ul>'
    };
});
global.ngApp.directive('pagesPagination', function () {
    return{
        restrict: 'E',
        template: '<ul class="pagination">' +
                '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPages(1)">&laquo;</a></li>' +
                '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPages(currentPage-1)">&lsaquo; Назад</a></li>' +
                '<li class="page-item" ng-repeat="i in range" ng-class="{active : currentPage == i}">' +
                '<a class="page-link" href="javascript:void(0)" ng-click="getPages(i)">{{i}}</a>' +
                '</li>' +
                '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getPages(currentPage+1)">Вперед &rsaquo;</a></li>' +
                '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getPages(totalPages)">&raquo;</a></li>' +
                '</ul>'
    };
});






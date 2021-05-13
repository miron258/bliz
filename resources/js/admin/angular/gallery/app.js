'use strict';
Dropzone.autoDiscover = false;
global.API_URL = '/api/v1/';
global.appGallery = angular.module('appGallery', [
    'ngSanitize',
    'thatisuday.dropzone',
    'ui.bootstrap',
    'ngMessages']).run(function ($rootScope, $templateCache) {
    $templateCache.removeAll();





})
        .config(['dropzoneOpsProvider', '$httpProvider', function (dropzoneOpsProvider, $httpProvider) {


                ///CONFIG HTTP PROVIDER
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
                ///END CONFIG HTTP PROVIDER





                dropzoneOpsProvider.setOptions({
                    url: API_URL + "dropzone/upload",
                    acceptedFiles: 'image/jpeg, images/jpg, image/png',
                    addRemoveLinks: true,
                    dictDefaultMessage: 'Перетащите или выберите изображения',
                    dictRemoveFile: 'Удалить',
                    dictResponseError: 'Не удалось загрузить изображение'
                });









            }]);



global.appGallery.directive("loadingIndicator", function () {
    return {
        restrict: "A",
        template: "<div id='loading'> <img src='images/loading.gif'/>Loading... < /div>",
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




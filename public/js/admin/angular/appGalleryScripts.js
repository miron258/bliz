appGallery.controller('dropzoneUploadsCtrl', ['$scope', '$rootScope', '$compile', '$timeout', 'galleryUploadSrv', function ($scope, $rootScope, $compile, $timeout, galleryUploadSrv) {

//        $scope.image = {};
        $scope.saveImg = function (isValid, imgId, image) {

            if (isValid) {
                
                
                
                galleryUploadSrv.saveImg(imgId, image)
                        .then(
                                //Функция в случае успеха получения данных
                                        function (data) {
                                            
                                            
                                            console.log(data);
                                            
                                            var success = data['response']['data']['success'];


                                            if (!success) {
                                                $rootScope.images = [];
                                            } else {
                                                $rootScope.images = data['response']['data']['images'];
                                                $scope.message = data['response']['data']['message'];

                                            }

                                        },
                                        //Фукнция в случае ошибки
                                                function (data) {
                                                    console.error(data);
                                                    console.error('Error get list images.');
                                                });
                                    }


                        };




                $scope.geImages = function () {
                    galleryUploadSrv.getImages($('#galleryId').val())
                            .then(
                                    //Функция в случае успеха получения данных
                                            function (data) {
                                                var success = data['response']['data']['success'];


                                                if (!success) {
                                                    $rootScope.images = [];
                                                } else {
                                                    $rootScope.images = data['response']['data']['images'];

                                                    $scope.message = data['response']['data']['message'];


                                                }

                                            },
                                            //Фукнция в случае ошибки
                                                    function (data) {
                                                        console.error(data);
                                                        console.error('Error get list images.');
                                                    });
                                        };
                                $scope.geImages();




                                $scope.deleteImg = function (idImg) {
                                    var isDelete = confirm("Вы действительно хотите удалить изображение?");
                                    if (isDelete) {

                                        galleryUploadSrv.deleteImg(idImg)
                                                .then(
                                                        //Функция в случае успеха получения данных
                                                                function (data) {
                                                                    var success = data['response']['data']['success'];
                                                                    if (!success) {
                                                                        $scope.message = data['response']['data']['message'];
                                                                    } else {
                                                                        $scope.message = data['response']['data']['message'];
                                                                        $rootScope.images = data['response']['data']['images'];

                                                                        console.log($rootScope.images);

                                                                    }

                                                                },
                                                                //Фукнция в случае ошибки
                                                                        function (data) {
                                                                            console.error(data);
                                                                            console.error('Error delete image.');
                                                                        });
                                                            }




                                                };






                                        var fd = new FormData();
                                        $scope.dzOptions = {
                                            paramName: 'image',
                                            autoProcessQueue: false,
                                            maxFilesize: '100000',
                                            parallelUploads: 200,
                                            previewsContainer: null,
                                            init: function () {


                                            }
                                        };
                                        $scope.uploadProgress = 0;
                                        $scope.dzMethods = {};




                                        $scope.dzCallbacks = {
                                            'addedfile': function (file) {



                                                console.info('File added from dropzone multi.', file);

                                            },

                                            //Событие когда происходит отправка файла на сервер
                                            'sending': function (file, xhr, fd) {
                                                fd.append("alt", $('input[name=header]').val());
                                                fd.append("id_gallery", $('#galleryId').val());


                                            },

                                            'totaluploadprogress': function (progress, totalBytes, totalBytesSent) {

                                                $scope.statusButtonUpload = true;
                                                $scope.uploadProgress = parseInt(progress);


                                            },
                                            'uploadprogress': function (file) {


                                            },
                                            'processing': function (file) {
//                console.log('processing');
//                console.log(file);
                                            },
                                            'complete': function (file) {
                                                $scope.dzMethods.removeFile(file);  //Удалить файл с формы

                                                var myDropzone = $scope.dzMethods.getDropzone();
                                                var countUploadingFiles = myDropzone.getUploadingFiles().length;
                                                var countQueuedFiles = myDropzone.getQueuedFiles().length;


                                                if (countUploadingFiles == 0 && countQueuedFiles == 0) {

                                                }

                                            },

                                            'removedfile': function (file) {

                                                $scope.uploadProgress = 0;
                                                console.info('File removed from dropzone multi.', file);

                                            },

                                            'success': function (file, xhr) {
                                                var response = xhr['success'];
                                                if (response) {

                                                    $scope.message = xhr['message'];
                                                    $rootScope.images = xhr['images'];

                                                }
                                                console.info('File dropdzone multi success uploaded.', file);


                                            },
                                            'error': function (file, xhr) {
                                                console.warn('File failed to upload from dropzone multi', file, xhr);
                                            }
                                        };
                                    }]);

appGallery.directive('listImgs', ['$http', '$compile', '$rootScope',
    function ($http, $compile, $rootScope) {
        //URK шаблона страницы для текущей директивы
        var templateUrl = API_URL + "galleryimages";
        return {
            restrict: "EA", //Тип директивы в данный момент мы указали что созданная директива должна являться как элементтом так и директивой
            replace: true,
            templateUrl: templateUrl,
            link: function (scope, element, attrs) {

                console.log(scope.items);
                console.log(scope.delimg);

            }
        };
    }]);
appGallery.service('galleryUploadSrv', ['$http', '$q', '$timeout', function ($http, $q, $timeout) {


    this.saveImg = function (idImg, formData) {
        
          
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'POST',
                responseType: 'json',
                cache: true,
                url: API_URL + "dropzone/save/" + idImg,
                data: $.param(formData),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
            promise = $http(request);
            promise.then(fulfilled, rejected);

            //В случае успеха ответа сервера регистрируем функцию
            function fulfilled(response) {
                def.resolve({success: true, response: response});
            }
            //В слачае ошибки ответа от сервера регистрируем функцию
            function rejected(error) {
                def.resolve({success: false, response: error});
                console.error(error.status);
            }
            return def.promise;
        };


        this.getImages = function (idGallery) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'GET',
                responseType: 'json',
                cache: true,
                url: API_URL + "dropzone/images/" + idGallery,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
            promise = $http(request);
            promise.then(fulfilled, rejected);

            //В случае успеха ответа сервера регистрируем функцию
            function fulfilled(response) {
                def.resolve({success: true, response: response});
            }
            //В слачае ошибки ответа от сервера регистрируем функцию
            function rejected(error) {
                def.resolve({success: false, response: error});
                console.error(error.status);
            }
            return def.promise;
        };



        this.deleteImg = function (idImg) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'DELETE',
                responseType: 'json',
                cache: true,
                url: API_URL + "dropzone/delete/" + idImg,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
            promise = $http(request);
            promise.then(fulfilled, rejected);

            //В случае успеха ответа сервера регистрируем функцию
            function fulfilled(response) {
                def.resolve({success: true, response: response});
            }
            //В случае ошибки ответа от сервера регистрируем функцию
            function rejected(error) {
                def.resolve({success: false, response: error});
                console.error(error.status);
            }
            return def.promise;
        };








    }]);
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

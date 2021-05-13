ngApp.directive('tablePages', ['$http', '$compile', '$rootScope',
    function ($http, $compile, $rootScope) {
        //URK шаблона страницы для текущей директивы
        var templateUrl = "/admin/table_pages";
        return {
            restrict: "EA", //Тип директивы в данный момент мы указали что созданная директива должна являться как элементтом так и директивой
            replace: true,
            templateUrl: templateUrl,
            link: function (scope, element, attrs) {












            }
        };
    }]);
ngApp.controller('pageCtrl', ['$scope', '$rootScope', '$compile', '$timeout', '$http', 'pageSrv', '$httpParamSerializer',
    function ($scope, $rootScope, $compile, $timeout, $http, pageSrv, $httpParamSerializer) {

        $scope.deleteButton = false;
        $scope.checkboxRecordsAll = false;
        $scope.checkboxRecord = 0; //По умолчанию чекоксы не отмечены
        $scope.options = [];

        $scope.pages = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];
        
        
        $scope.filter = {
            "name": ""
        };

        $scope.predicate = 'name';
        $scope.sort = function (predicate) {
            $scope.predicate = predicate;
        };

        $scope.isSorted = function (predicate) {
            return ($scope.predicate == predicate)
        };


        $scope.submitForm = function () {
            $scope.getPages();
        };


        $scope.deletePages = function () {
            var isDelete = confirm("Вы действительно хотите удалить страницу(ы)?");
            $scope.idRecords = $scope.getCheckedRecords();

            console.log($scope.idRecords);

            if (isDelete) {
                pageSrv.deletePages($scope.idRecords)
                        .then(
                                //Функция в случае успеха получения данных
                                        function (res) {

                                            console.log(res);
                                            var success = res['success'];
                                            if (success) {
                                                var response = res.response.data.pages;
                                                $scope.message = res.response.data.message;
                                                $scope.checkboxRecordsAll = false;

                                                $scope.pages = response.data;
                                                $scope.totalPages = response.last_page;
                                                $scope.currentPage = response.current_page;

                                                // Pagination Range
                                                var pages = [];
                                                for (var i = 1; i <= response.last_page; i++) {
                                                    pages.push(i);
                                                }
                                                $scope.range = pages;
                                            } else {
                                                $scope.message = res.response.data.message;
                                            }

                                        },
                                        //Фукнция в случае ошибки
                                                function (data) {
                                                    console.error(data);
                                                    console.error('Error get pages.');
                                                });

                                    }

                        };


                $scope.getPages = function (pageNumber) {
                    if (pageNumber === undefined) {
                        pageNumber = '1';
                    }

                    pageSrv.getPages(pageNumber, $scope.filter)
                            .then(
                                    //Функция в случае успеха получения данных
                                            function (response) {

                                                console.log(response);
                                                var success = response['success'];
                                                if (success) {
                                                    $scope.pages = response.response.data.data;


                                                    $scope.totalPages = response.response.data.last_page;
                                                    $scope.currentPage = response.response.data.current_page;

                                                    // Pagination Range
                                                    var pages = [];
                                                    for (var i = 1; i <= response.response.data.last_page; i++) {
                                                        pages.push(i);
                                                    }
                                                    $scope.range = pages;
                                                }




                                            },
                                            //Фукнция в случае ошибки
                                                    function (data) {
                                                        console.error(data);
                                                        console.error('Error get pages.');
                                                    });
                                        };



//Количество отмеченных файлов
                                $scope.countCheckedRecords = function () {
                                    var recordsArray = angular.element.find('.checkbox-record');
                                    var count = 0;
                                    angular.forEach(recordsArray, function (elementInput, index) {
                                        var statusChecked = elementInput.checked;
                                        if (statusChecked) {
                                            count++;
                                        }
                                    });
                                    return count;
                                };
//Конец Количество отмеченных файлов
                                $scope.$watch('countCheckedRecords()', function (newValue, oldValue) {
                                    if (newValue > 0) {
                                        $scope.deleteButton = false;

                                    } else {
                                        $scope.deleteButton = true;
                                    }
                                });
                                $scope.getCheckedRecords = function () {
                                    //Собираем названия всех отмеченных файлов гостем
                                    var recordsArray = angular.element.find('.checkbox-record');
                                    var idRecordsArray = [];
                                    angular.forEach(recordsArray, function (elementInput, index) {
                                        var statusChecked = elementInput.checked;
                                        if (statusChecked) {
                                            idRecordsArray.push(angular.element(elementInput).val());
                                        }
                                    });
                                    return idRecordsArray;
                                };
                                $scope.selectAllRecords = function (status) {
                                    $scope.deleteButton = false;
                                    var checked = $scope.checkboxRecordsAll;
                                    for (var i = 0; i < $scope.pages.length; i++) {
                                        $scope.options[i] = checked;
                                    }

                                };


                            }]);



ngApp.service('pageSrv', ['$http', '$q', '$timeout', function ($http, $q, $timeout) {


        this.getPages = function (pageNumber, filter) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'GET',
                responseType: 'json',
                cache: true,
                url: "list_pages?page=" + pageNumber,
                params: filter,
//                data: $.param(formData),
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


        this.deletePages = function (ids) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'DELETE',
                responseType: 'json',
                cache: true,
                url: "page/" + ids,
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
ngApp.directive('tableMaterials', ['$http', '$compile', '$rootScope',
    function ($http, $compile, $rootScope) {
        //URK шаблона страницы для текущей директивы
        var templateUrl = "/admin/table_materials";
        return {
            restrict: "EA", //Тип директивы в данный момент мы указали что созданная директива должна являться как элементтом так и директивой
            replace: true,
            templateUrl: templateUrl,
            link: function (scope, element, attrs) {












            }
        };
    }]);
ngApp.controller('materialCtrl', ['$scope', '$rootScope', '$compile', '$timeout', '$http', 'materialSrv', '$httpParamSerializer', 
    function ($scope, $rootScope, $compile, $timeout, $http, materialSrv, $httpParamSerializer) {

        $scope.deleteButton = false;
        $scope.checkboxRecordsAll = false;
        $scope.checkboxRecord = 0; //По умолчанию чекоксы не отмечены
        $scope.options = [];

        $scope.materials = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];

///По умолчанию создаем фильтра с пустыми значениями
        $scope.filter = {
            "idCategory": "",
            "name": ""
        };
        $scope.predicate = 'name';
        $scope.sort = function (predicate) {
            $scope.predicate = predicate;
        };

        $scope.isSorted = function (predicate) {
            return ($scope.predicate == predicate)
        };


        $scope.submitForm = function () {
            $scope.getMaterials();
        };


        $scope.deleteMaterials = function () {
            var isDelete = confirm("Вы действительно хотите удалить материал(ы)?");
            $scope.idRecords = $scope.getCheckedRecords();

            console.log($scope.idRecords);

            if (isDelete) {
                materialSrv.deleteMaterials($scope.idRecords)
                        .then(
                                //Функция в случае успеха получения данных
                                        function (res) {

                                            console.log(res);
                                            var success = res['success'];
                                            if (success) {
                                                var response = res.response.data.materials;
                                                $scope.message = res.response.data.message;
                                                $scope.checkboxRecordsAll = false;



                                                $scope.materials = response.data;
                                                $scope.totalPages = response.last_page;
                                                $scope.currentPage = response.current_page;

                                                // Pagination Range
                                                var pages = [];
                                                for (var i = 1; i <= response.last_page; i++) {
                                                    pages.push(i);
                                                }
                                                $scope.range = pages;
                                            } else {
                                                $scope.message = res.response.data.message;
                                            }

                                        },
                                        //Фукнция в случае ошибки
                                                function (data) {
                                                    console.error(data);
                                                    console.error('Error get materials.');
                                                });

                                    }

                        };


                $scope.getMaterials = function (pageNumber) {
                    if (pageNumber === undefined) {
                        pageNumber = '1';
                    }

                    materialSrv.getMaterials(pageNumber, $scope.filter)
                            .then(
                                    //Функция в случае успеха получения данных
                                            function (response) {

                                                console.log(response);
                                                var success = response['success'];
                                                if (success) {
                                                    $scope.materials = response.response.data.data;


                                                    $scope.totalPages = response.response.data.last_page;
                                                    $scope.currentPage = response.response.data.current_page;

                                                    // Pagination Range
                                                    var pages = [];
                                                    for (var i = 1; i <= response.response.data.last_page; i++) {
                                                        pages.push(i);
                                                    }
                                                    $scope.range = pages;
                                                }




                                            },
                                            //Фукнция в случае ошибки
                                                    function (data) {
                                                        console.error(data);
                                                        console.error('Error get materials.');
                                                    });
                                        };



//Количество отмеченных файлов
                                $scope.countCheckedRecords = function () {
                                    var recordsArray = angular.element.find('.checkbox-record');
                                    var count = 0;
                                    angular.forEach(recordsArray, function (elementInput, index) {
                                        var statusChecked = elementInput.checked;
                                        if (statusChecked) {
                                            count++;
                                        }
                                    });
                                    return count;
                                };
//Конец Количество отмеченных файлов
                                $scope.$watch('countCheckedRecords()', function (newValue, oldValue) {
                                    if (newValue > 0) {
                                        $scope.deleteButton = false;

                                    } else {
                                        $scope.deleteButton = true;
                                    }
                                });
                                $scope.getCheckedRecords = function () {
                                    //Собираем названия всех отмеченных файлов гостем
                                    var recordsArray = angular.element.find('.checkbox-record');
                                    var idRecordsArray = [];
                                    angular.forEach(recordsArray, function (elementInput, index) {
                                        var statusChecked = elementInput.checked;
                                        if (statusChecked) {
                                            idRecordsArray.push(angular.element(elementInput).val());
                                        }
                                    });
                                    return idRecordsArray;
                                };
                                $scope.selectAllRecords = function (status) {
                                    $scope.deleteButton = false;
                                    var checked = $scope.checkboxRecordsAll;
                                    for (var i = 0; i < $scope.materials.length; i++) {
                                        $scope.options[i] = checked;
                                    }

                                };


                            }]);



ngApp.service('materialSrv', ['$http', '$q', '$timeout', function ($http, $q, $timeout) {


        this.getMaterials = function (pageNumber, filter) {


//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'GET',
                responseType: 'json',
                cache: true,
                url: "list_materials?page=" + pageNumber,
                params: filter,
//                data: $.param(formData),
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






        this.deleteMaterials = function (ids) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'DELETE',
                responseType: 'json',
                cache: true,
                url: "material/" + ids,
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
ngApp.directive('tableProducts', ['$http', '$compile', '$rootScope',
    function ($http, $compile, $rootScope) {
        //URK шаблона страницы для текущей директивы
        var templateUrl = "/admin/table_products";
        return {
            restrict: "EA", //Тип директивы в данный момент мы указали что созданная директива должна являться как элементтом так и директивой
            replace: true,
            templateUrl: templateUrl,
            link: function (scope, element, attrs) {












            }
        };
    }]);
ngApp.controller('productCtrl', ['$scope', '$rootScope', '$compile', '$timeout', '$http', 'productSrv', '$httpParamSerializer', 
    function ($scope, $rootScope, $compile, $timeout, $http, productSrv, $httpParamSerializer) {

        $scope.deleteButton = false;
        $scope.checkboxRecordsAll = false;
        $scope.checkboxRecord = 0; //По умолчанию чекоксы не отмечены
        $scope.options = [];

        $scope.products = [];
        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];

///По умолчанию создаем фильтра с пустыми значениями
        $scope.filter = {
            "art": "",
            "idCatalog": "",
            "name": "",
            "price": ""
        };
        $scope.predicate = 'name';
        $scope.sort = function (predicate) {
            $scope.predicate = predicate;
        };

        $scope.isSorted = function (predicate) {
            return ($scope.predicate == predicate)
        };


        $scope.submitForm = function () {
            $scope.getProducts();
        };


        $scope.deleteProducts = function () {
            var isDelete = confirm("Вы действительно хотите удалить товар(ы)?");
            $scope.idRecords = $scope.getCheckedRecords();

            console.log($scope.idRecords);

            if (isDelete) {
                productSrv.deleteProducts($scope.idRecords)
                        .then(
                                //Функция в случае успеха получения данных
                                        function (res) {

                                            console.log(res);
                                            var success = res['success'];
                                            if (success) {
                                                var response = res.response.data.products;
                                                $scope.message = res.response.data.message;
                                                $scope.checkboxRecordsAll = false;



                                                $scope.products = response.data;
                                                $scope.totalPages = response.last_page;
                                                $scope.currentPage = response.current_page;

                                                // Pagination Range
                                                var pages = [];
                                                for (var i = 1; i <= response.last_page; i++) {
                                                    pages.push(i);
                                                }
                                                $scope.range = pages;
                                            } else {
                                                $scope.message = res.response.data.message;
                                            }

                                        },
                                        //Фукнция в случае ошибки
                                                function (data) {
                                                    console.error(data);
                                                    console.error('Error get products.');
                                                });

                                    }

                        };


                $scope.getProducts = function (pageNumber) {
                    if (pageNumber === undefined) {
                        pageNumber = '1';
                    }

                    productSrv.getProducts(pageNumber, $scope.filter)
                            .then(
                                    //Функция в случае успеха получения данных
                                            function (response) {

                                                console.log(response);
                                                var success = response['success'];
                                                if (success) {
                                                    $scope.products = response.response.data.data;


                                                    $scope.totalPages = response.response.data.last_page;
                                                    $scope.currentPage = response.response.data.current_page;

                                                    // Pagination Range
                                                    var pages = [];
                                                    for (var i = 1; i <= response.response.data.last_page; i++) {
                                                        pages.push(i);
                                                    }
                                                    $scope.range = pages;
                                                }




                                            },
                                            //Фукнция в случае ошибки
                                                    function (data) {
                                                        console.error(data);
                                                        console.error('Error get products.');
                                                    });
                                        };



//Количество отмеченных файлов
                                $scope.countCheckedRecords = function () {
                                    var recordsArray = angular.element.find('.checkbox-record');
                                    var count = 0;
                                    angular.forEach(recordsArray, function (elementInput, index) {
                                        var statusChecked = elementInput.checked;
                                        if (statusChecked) {
                                            count++;
                                        }
                                    });
                                    return count;
                                };
//Конец Количество отмеченных файлов
                                $scope.$watch('countCheckedRecords()', function (newValue, oldValue) {
                                    if (newValue > 0) {
                                        $scope.deleteButton = false;

                                    } else {
                                        $scope.deleteButton = true;
                                    }
                                });
                                $scope.getCheckedRecords = function () {
                                    //Собираем названия всех отмеченных файлов гостем
                                    var recordsArray = angular.element.find('.checkbox-record');
                                    var idRecordsArray = [];
                                    angular.forEach(recordsArray, function (elementInput, index) {
                                        var statusChecked = elementInput.checked;
                                        if (statusChecked) {
                                            idRecordsArray.push(angular.element(elementInput).val());
                                        }
                                    });
                                    return idRecordsArray;
                                };
                                $scope.selectAllRecords = function (status) {
                                    $scope.deleteButton = false;
                                    var checked = $scope.checkboxRecordsAll;
                                    for (var i = 0; i < $scope.products.length; i++) {
                                        $scope.options[i] = checked;
                                    }

                                };


                            }]);



ngApp.service('productSrv', ['$http', '$q', '$timeout', function ($http, $q, $timeout) {


        this.getProducts = function (pageNumber, filter) {


//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'GET',
                responseType: 'json',
                cache: true,
                url: "list_products?page=" + pageNumber,
                params: filter,
//                data: $.param(formData),
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






        this.deleteProducts = function (ids) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'DELETE',
                responseType: 'json',
                cache: true,
                url: "product/" + ids,
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
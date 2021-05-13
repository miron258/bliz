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



appMenuItems.controller('menuItemsCtrl', ['$scope', '$rootScope', '$compile', '$timeout', 'menuItemsSrv', function ($scope, $rootScope, $compile, $timeout, menuItemsSrv) {


        $scope.message = "";


        $scope.remove = function (scope) {
            scope.remove();
        };

        $scope.toggle = function (scope) {
            scope.toggle();
        };

        $scope.moveLastToTheBeginning = function () {
            var a = $scope.data.pop();
            $scope.data.splice(0, 0, a);
        };

        $scope.newSubItem = function (scope) {
            var nodeData = scope.$modelValue;
            nodeData.nodes.push({
                id: nodeData.id * 10 + nodeData.nodes.length,
                title: nodeData.title + '.' + (nodeData.nodes.length + 1),
                nodes: []
            });
        };

        $scope.collapseAll = function () {
            $scope.$broadcast('angular-ui-tree:collapse-all');
        };

        $scope.expandAll = function () {
            $scope.$broadcast('angular-ui-tree:expand-all');
        };





        $scope.getMenuItems = function () {
            menuItemsSrv.getMenuItems($rootScope.menuId)
                    .then(
                            //Функция в случае успеха получения данных
                                    function (data) {
                                        var success = data['response']['data']['success'];
                                        if (!success) {
                                            $rootScope.menuItemsTree = [];
                                        } else {
                                            $rootScope.menuItemsTree = data['response']['data']['menuItemsTree'];
                                            $rootScope.menuItemsTreeSelectOptions = data['response']['data']['menuItemsTreeSelectOptions'];
                                            $scope.message.success = data['response']['data']['message'];

                                            console.log("Новое значение");
                                            console.log($rootScope.menuItemsTree);

                                        }

                                    },
                                    //Фукнция в случае ошибки
                                            function (data) {
                                                console.error(data);
                                                console.error('Error get menu items.');
                                            });
                                };
                        $scope.getMenuItems();




                        $scope.deleteMenuItem = function (idItem) {
                            var isDelete = confirm("Вы действительно хотите удалить пункт меню?");
                            if (isDelete) {
                                menuItemsSrv.deleteMenuItem(idItem)
                                        .then(
                                                //Функция в случае успеха получения данных
                                                        function (data) {
                                                            var response = data['response']['data'];
                                                            var success = response['success'];
                                                            if (!success) {
                                                                $scope.messages = response['message'];
                                                            } else {

                                                                console.log("response");
                                                                console.log(response);

                                                                $scope.messages = response['message'];
                                                                $rootScope.menuItemsTree = response['menuItemsTree'];
                                                                $rootScope.menuItemsModal = response['menuItemsTreeSelectOptions'];

                                                                console.log($rootScope.menuItemsTree);
                                                                console.log($rootScope.menuItemsModal);


                                                            }

                                                        },
                                                        //Фукнция в случае ошибки
                                                                function (data) {
                                                                    console.error(data);
                                                                    console.error('Error get menu items.');
                                                                });
                                                    }
                                            ;
                                        };



                            }]);



appMenuItems.controller('formMenuItemsCtrl', ['$scope', '$rootScope', '$timeout', 'menuItemsSrv', '$compile', 'Popeye', '$filter', '$compile', function ($scope, $rootScope, $timeout, menuItemsSrv, $compile, Popeye, $filter, $compile) {

        $rootScope.openModalSave = function (idItem = '') {
            var url = API_URL + "menu_items_form";
            var modal = Popeye.openModal({
                templateUrl: url,
                controller: function ($scope, menuItemsModal, menuItem) {
                    $scope.menuItem = menuItem;
                    $scope.message = "";
                    $rootScope.menuItemsModal = menuItemsModal;
///LIST ROUTES FOR URL
                    $scope.routes = [
                        {
                            'value': 'page',
                            'name': 'Статическая страница'
                        },
                        {
                            'value': 'catalog',
                            'name': 'Каталог'
                        },
                        {
                            'value': 'product',
                            'name': 'Товар'
                        },

                        {
                            'value': 'category',
                            'name': 'Категория'
                        },
                        {
                            'value': 'material',
                            'name': 'Материал'
                        }
                    ];
                    console.log(menuItem);

                    if (idItem !== '') {
                        $scope.modalState = 'update';
                        var valueSearch = $scope.menuItem.route;
                        //filter the array
                        var foundItem = $filter('filter')($scope.routes, {value: valueSearch}, true)[0];

                        //get the index
                        var index = $scope.routes.indexOf(foundItem);
                        $scope.selectedRoute = $scope.routes[index];
                    } else {
                        $scope.menuItem.route = undefined;
                        $scope.menuItem.parent_id = undefined;
                        $scope.menuItem.hidden = 1;
                        $scope.modalState = 'create';
                    }

                    $scope.getRoute = function (selectedRoute) {

                        if (selectedRoute === null || selectedRoute === '') {
                            $scope.menuItem.route = undefined;
                        } else {
                            $scope.menuItem.route = selectedRoute;
                        }

                        console.log($scope.menuItem);

                    };


                    //Добавление и обновления пункта меню
                    $scope.saveMenuItem = function (isValid) {
                        if (isValid) {
                            $scope.menuItem.menu_id = $rootScope.menuId;
                            menuItemsSrv.saveMenuItem($scope.modalState, $scope.menuItem, idItem)
                                    .then(
                                            //Функция в случае успеха получения данных
                                                    function (data) {
                                                        var response = data['response']['data'];
                                                        var success = response['success'];
                                                        if (!success) {
                                                            $scope.messages = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
                                                            $scope.messages += '' + data['response']['data']['message'] + "</div>";
                                                            $scope.message = data['response']['data']['errors'];

                                                        } else {
                                                            $scope.messages = response['message'];
                                                            $rootScope.menuItemsTree = response['menuItemsTree'];
                                                            $rootScope.menuItemsModal = response['menuItemsTreeSelectOptions'];

                                                            if (idItem === '') {
                                                                $scope.selected = undefined; //Сборасываем SELECT выбора Родительского пункта меню
                                                                $scope.selectedRoute = undefined; //Сбрасываем SELECT выбора роута
                                                                $scope.menuItem = {};
                                                                $scope.menuItem.hidden = 1;
                                                            }



                                                        }

                                                    },
                                                    //Фукнция в случае ошибки
                                                            function (data) {
                                                                console.log(data);
                                                                console.error(data);
                                                                console.error('Error get menu items.');
                                                            });

                                                }

                                    };
                            //Конец Добавления и обновления пункта меню



                        },
                        resolve: {
                            menuItem: function () {
                                if (idItem !== '') {
                                    return menuItemsSrv.getMenuItem(idItem)
                                            .then(
                                                    //Функция в случае успеха получения данных
                                                            function (data) {
                                                                var response = data['response']['data'];
                                                                var success = response['success'];
                                                                if (!success) {
                                                                    return  {};
                                                                } else {
                                                                    var menuItem = response['menuItem'];
                                                                    return menuItem;
                                                                }

                                                            },
                                                            //Фукнция в случае ошибки
                                                                    function (data) {
                                                                        console.error(data);
                                                                        console.error('Error get menu item.');
                                                                    });
                                                        } else {
                                                    return {};
                                                }
                                            },
                                    menuItemsModal: function () {
                                        if (idItem !== '') {
                                            return  menuItemsSrv.getMenuItemsExclude($rootScope.menuId, idItem)
                                                    .then(
                                                            //Функция в случае успеха получения данных
                                                                    function (data) {
                                                                        var response = data['response']['data'];

                                                                        console.log(response);

                                                                        var success = data['response']['data']['success'];
                                                                        if (!success) {
                                                                            return  [];
                                                                        } else {
                                                                            var menuItemsModal = data['response']['data']['menuItemsTreeSelectOptions'];
                                                                            return menuItemsModal;
                                                                        }
                                                                    },
                                                                    //Фукнция в случае ошибки
                                                                            function (data) {
                                                                                console.log(data);
                                                                                console.error(data);
                                                                                console.error('Error get menu items.');
                                                                            });

                                                                } else {

                                                            var menuItemsModal = $rootScope.menuItemsTreeSelectOptions;
                                                            return menuItemsModal;
                                                        }









                                                    }
                                        }
                                    });

//                    $compile(modal)($scope);


                            // Show a spinner while modal is resolving dependencies
//            $scope.showLoading = true;
                            modal.resolved.then(function () {



                                $scope.showLoading = false; //Ajax анимация
                            });
//
//            // Update user after modal is closed
//            modal.closed.then(function () {
//                $scope.updateUser(); //Динамическое обновление данных в шаблоне
//            });


                        };











                    }]);



appMenuItems.directive('menuItems', ['$http', '$compile', '$rootScope',
    function ($http, $compile, $rootScope) {
        //URK шаблона страницы для текущей директивы
        var templateUrl = API_URL + "menu_items";
        return {
            restrict: "EA", //Тип директивы в данный момент мы указали что созданная директива должна являться как элементтом так и директивой
            replace: true,
//            scope: {
//                items: '=',
//                openModalSave: '='
//            },
            templateUrl: templateUrl,
            link: function (scope, element, attrs) {



                scope.isLoading = function () {
                    return $http.pendingRequests.length > 0;
                };
                scope.$watch(scope.isLoading, function (v)
                {
                    //Если ложь тоесть значение изменилось то значит данные получены с AJAX запроса или AJAX запрос прошел
                    //Удаление, Обновление или Добавление данных на сервер путем AJAX запроса
                    if (!v) {
//                        var menuItems = angular.element('.list-menu-items');
//                        console.log("В директиве пунктов меню");
//                        console.log(menuItems);
//                        $compile(menuItems)(scope);

                    }
                });










            }
        };
    }]);
appMenuItems.directive('selectOptionsMenuItems', ['$http', '$compile', '$rootScope',
    function ($http, $compile, $rootScope) {
        //URK шаблона страницы для текущей директивы
        var templateUrl = API_URL + "menu_items_select_options";
        return {
            restrict: "EA", //Тип директивы в данный момент мы указали что созданная директива должна являться как элементтом так и директивой
            replace: true,
            controller: ['$scope', '$filter', function ($scope, $filter) {
                    if (!$scope.menuItem.parent_id) {
                        $scope.selected = undefined;
                    } else {

                        var idSearch = $scope.menuItem.parent_id;
                        //filter the array
                        var foundItem = $filter('filter')($rootScope.menuItemsModal, {id: idSearch}, true)[0];
                        //get the index
                        var index = $rootScope.menuItemsModal.indexOf(foundItem);
                        $scope.selected = $rootScope.menuItemsModal[index];
                    }
                    $scope.getParentId = function (selected) {
                        if (selected === null) {
                            $scope.menuItem.parent_id = null;
                        } else {
                            $scope.menuItem.parent_id = selected.id;
                        }
                    };

                }],
            scope: {
                items: '=',
                menuItem: '='
            },
            templateUrl: templateUrl,
            link: function (scope, element, attrs) {




            }
        };
    }]);
appMenuItems.service('menuItemsSrv', ['$http', '$q', '$timeout', function ($http, $q, $timeout) {

        this.deleteMenuItem = function (idItem) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'DELETE',
                responseType: 'json',
                cache: true,
                url: API_URL + "menuitems/" + idItem,
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


        this.getMenuItems = function (idMenu) {
//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'GET',
                responseType: 'json',
                cache: true,
                url: API_URL + "listitems/" + idMenu,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
            promise = $http(request);
            promise.then(fulfilled, rejected);

            //В случае успеха ответа сервера регистрируем функцию
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



        this.getMenuItemsExclude = function (idMenu, idItem) {

//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'GET',
                responseType: 'json',
                cache: true,
                url: API_URL + "listitemsexclude/" + idMenu + "/" + idItem,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };
            promise = $http(request);
            promise.then(fulfilled, rejected);

            //В случае успеха ответа сервера регистрируем функцию
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




        this.getMenuItem = function (idPunkt) {

//Формируем пост данные для запроса на сервер
            var def = $q.defer();
            var request = {
                method: 'GET',
//            async:   false,
                responseType: 'json',
                cache: true,
                url: API_URL + "menuitems/" + idPunkt,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            };

            promise = $http(request);
            promise.then(fulfilled, rejected);

            //В случае успеха ответа сервера регистрируем функцию
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

        this.saveMenuItem = function (modalState, formData, idItem = '') {

//Формируем пост данные для запроса на сервер
            var def = $q.defer();

//Составляем объект запроса к серверу
            var request = {
//            async:   false,
                url: API_URL + "menuitems",
                responseType: 'json',
                cache: true,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                data: $.param(formData)
            };
            if (modalState == 'create') {
                request.url = API_URL + "menuitems";
                request.method = 'POST';
            }
            if (modalState == 'update') {
                if (idItem !== '') {
                    request.url = API_URL + "menuitems/" + idItem;
                } else {
                    request.url = API_URL + "menuitems";
                }
                request.method = 'PUT';
            }
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

    }]);
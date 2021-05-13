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



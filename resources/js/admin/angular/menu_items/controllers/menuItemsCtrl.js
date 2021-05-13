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



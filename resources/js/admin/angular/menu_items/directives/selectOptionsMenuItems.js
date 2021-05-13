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
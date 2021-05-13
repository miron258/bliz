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
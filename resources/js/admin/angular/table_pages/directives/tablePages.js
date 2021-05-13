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
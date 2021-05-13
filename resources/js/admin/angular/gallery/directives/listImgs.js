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
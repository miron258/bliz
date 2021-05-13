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
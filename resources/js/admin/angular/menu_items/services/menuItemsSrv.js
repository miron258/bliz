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
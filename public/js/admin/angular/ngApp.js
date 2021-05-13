/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/webpack/buildin/global.js":
/*!***********************************!*\
  !*** (webpack)/buildin/global.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || new Function("return this")();
} catch (e) {
	// This works if the window reference is available
	if (typeof window === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),

/***/ "./resources/js/admin/angular/ngApp.js":
/*!*********************************************!*\
  !*** ./resources/js/admin/angular/ngApp.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {

global.ngApp = angular.module('ngApp', ['pathgather.popeye', 'ngSanitize', 'ui.tree', 'ngRoute', 'ngResource', 'ui.bootstrap', 'ngMessages']).run(function ($rootScope, $templateCache) {
  $templateCache.removeAll();
}); //global.ngApp.config(['$routeProvider', function ($routeProvider) {
//        $routeProvider.
//                when('/products', {
//                    controller: 'productCtrl',
//                    templateUrl: '/admin/table_products'}).
//                otherwise({redirectTo: '/products'});
//    }]);

global.ngApp.config(function ($httpProvider) {
  $httpProvider.interceptors.push(function ($q, $rootScope) {
    return {
      'request': function request(config) {
        $rootScope.$broadcast('loading-started');
        return config || $q.when(config);
      },
      'response': function response(_response) {
        $rootScope.$broadcast('loading-complete');
        return _response || $q.when(_response);
      }
    };
  });
});
global.ngApp.directive("loadingIndicator", function () {
  return {
    restrict: "A",
    template: "<div id='loading'> <img src='images/loading.gif'/> Loading... < /div>",
    link: function link(scope, element, attrs) {
      element.css({
        "display": "none"
      });
      scope.$on("loading-started", function (e) {
        element.css({
          "display": ""
        });
      });
      scope.$on("loading-complete", function (e) {
        element.css({
          "display": "none"
        });
      });
    }
  };
});
global.ngApp.directive("compareTo", function () {
  return {
    require: "ngModel",
    scope: {
      otherModelValue: "=compareTo"
    },
    link: function link(scope, element, attributes, ngModel) {
      ngModel.$validators.compareTo = function (modelValue) {
        return modelValue == scope.otherModelValue;
      };

      scope.$watch("otherModelValue", function () {
        ngModel.$validate();
      });
    }
  };
});
global.ngApp.directive('productsPagination', function () {
  return {
    restrict: 'E',
    template: '<ul class="pagination">' + '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getProducts(1)">&laquo;</a></li>' + '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getProducts(currentPage-1)">&lsaquo; Назад</a></li>' + '<li class="page-item" ng-repeat="i in range" ng-class="{active : currentPage == i}">' + '<a class="page-link" href="javascript:void(0)" ng-click="getProducts(i)">{{i}}</a>' + '</li>' + '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getProducts(currentPage+1)">Вперед &rsaquo;</a></li>' + '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getProducts(totalPages)">&raquo;</a></li>' + '</ul>'
  };
});
global.ngApp.directive('materialsPagination', function () {
  return {
    restrict: 'E',
    template: '<ul class="pagination">' + '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getMaterials(1)">&laquo;</a></li>' + '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getMaterials(currentPage-1)">&lsaquo; Назад</a></li>' + '<li class="page-item" ng-repeat="i in range" ng-class="{active : currentPage == i}">' + '<a class="page-link" href="javascript:void(0)" ng-click="getMaterials(i)">{{i}}</a>' + '</li>' + '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getMaterials(currentPage+1)">Вперед &rsaquo;</a></li>' + '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getMaterials(totalPages)">&raquo;</a></li>' + '</ul>'
  };
});
global.ngApp.directive('pagesPagination', function () {
  return {
    restrict: 'E',
    template: '<ul class="pagination">' + '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPages(1)">&laquo;</a></li>' + '<li class="page-item" ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPages(currentPage-1)">&lsaquo; Назад</a></li>' + '<li class="page-item" ng-repeat="i in range" ng-class="{active : currentPage == i}">' + '<a class="page-link" href="javascript:void(0)" ng-click="getPages(i)">{{i}}</a>' + '</li>' + '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getPages(currentPage+1)">Вперед &rsaquo;</a></li>' + '<li class="page-item" ng-show="currentPage != totalPages"><a class="page-link" href="javascript:void(0)" ng-click="getPages(totalPages)">&raquo;</a></li>' + '</ul>'
  };
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../../node_modules/webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ 2:
/*!***************************************************!*\
  !*** multi ./resources/js/admin/angular/ngApp.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/domains/bliz.webeffects.ru/bliz/resources/js/admin/angular/ngApp.js */"./resources/js/admin/angular/ngApp.js");


/***/ })

/******/ });
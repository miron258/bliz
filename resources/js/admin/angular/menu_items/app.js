'use strict';
global.appMenuItems = angular.module('appMenuItems', [
    'pathgather.popeye',
    'ngSanitize',
    'ui.tree',
    'ui.bootstrap',
    'ngMessages']).run(function ($rootScope, $templateCache) {

    $templateCache.removeAll();
//    $rootScope.$on('$viewContentLoaded', function () {
//        $templateCache.removeAll();
//    });

    var menuId = $('#menuId').val();
    $rootScope.menuId = (menuId === undefined) ? '' : menuId;
});

global.appMenuItems.constant('treeConfig', {
    treeClass: 'angular-ui-tree',
    emptyTreeClass: 'angular-ui-tree-empty',
    dropzoneClass: 'angular-ui-tree-dropzone',
    hiddenClass: 'angular-ui-tree-hidden',
    nodesClass: 'angular-ui-tree-nodes',
    nodeClass: 'angular-ui-tree-node',
    handleClass: 'angular-ui-tree-handle',
    placeholderClass: 'angular-ui-tree-placeholder',
    dragClass: 'angular-ui-tree-drag',
    dragThreshold: 3,
    defaultCollapsed: false,
    appendChildOnHover: true
});

global.API_URL = '/api/v1/';









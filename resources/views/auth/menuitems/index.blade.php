<div class='list-menu-items' ui-tree data-drag-enabled="false">
    <ol ui-tree-nodes="" ng-model="menuItemsTree" id="tree-root">
        <li ng-repeat="item in menuItemsTree" ui-tree-node ng-include="'/api/v1/menu_items_nodes'"></li>
    </ol>
</div>

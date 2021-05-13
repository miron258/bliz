<div class='box-menu-item d-flex' ui-tree-handle>
    <div class='col'>
        <a class="btn btn-success btn-xs" ng-if="item.children && item.children.length > 0" data-nodrag="" ng-click="toggle(this)">
            <span class="glyphicon glyphicon-chevron-down" ng-class="{
          'glyphicon-chevron - right': collapsed,
          'glyphicon-chevron - down': !collapsed
        }"></span>
        </a>
        @{{item.title}}
    </div>
    <div class="col">
        <a target="_blank" href="@{{item.url}}">@{{item.url}}</a>
    </div>
    <div class="col">
        @{{item.position}}
    </div>
    <div class="box-menu-item__bt-edit-menu-item bt-edit-menu-item col">
        <a ng-click="openModalSave(item.id)" href="" class="btn btn-success"><i class="far fa-edit mr-2"></i>Редактировать</a>
    </div>
    <div class="box-menu-item__bt-edit-menu-item bt-edit-menu-item col">
        <a ng-click="deleteMenuItem(item.id)" href="" class="btn btn-danger"><i class="fas fa-trash mr-2"></i>Удалить</a>
    </div>
</div>
<ol ui-tree-nodes="" ng-model="item.children">
    <li ng-repeat="item in item.children" ui-tree-node ng-include="'/api/v1/menu_items_nodes'"></li>
</ol>
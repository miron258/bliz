<table class="table table-bordered table-responsive table-striped table-hover w-100">
    <thead>
        <tr>
            <th>
                <input ng-change="selectAllRecords(checkboxRecordsAll)"  value="@{{checkboxRecordsAll}}" ng-model="checkboxRecordsAll"  class="checked_all" type="checkbox">  
            </th>
            <th>
                Имя
                <a href="#" ng-click="sort('name')" class="sortDir" ng-class="{ active: isSorted('name') }">&#x25B2;</a>
                <a href="#" ng-click="sort('-name')" class="sortDir" ng-class="{ active: isSorted('-name') }">&#x25BC;</a>
            </th>
            <th>Ссылка</th>
            <th>Изображение</th>
            <th>Категория</th>
            <th>В индексе</th>
            <th>Видимость</th>
            <th>Дата создания</th>
            <th></th>
        </tr>
    </thead>


    <tbody>
        <tr ng-class="options[$index] || checkboxRecordsAll ? 'table-active' : ''" ng-repeat="material in materials| orderBy:predicate:reverse"">
            <td>
                <input ng-checked="checkboxRecordsAll" value="@{{material.id}}" ng-model="options[$index]"  class='checkbox-record' name="materialId[]" ng-value="@{{material.id}}" type="checkbox">
            </td>
            <td>@{{material.name}}</td>
            <td>
                <a target="_blank" href="/material/@{{material.url}}">Перейти на страницу продукта</a>
            </td>
            <td>
                <img ng-if="material.img" class="d-block img-fluid" style="width: 50px;" alt="@{{ material.name}}" src="/storage/@{{material.img}}">
            </td>
            <td>@{{material.name_category}}</td>
            <td>
                <i ng-class="material.index ? 'fas fa-search' : 'fas fa-search-minus'"></i> 
            </td>
            <td> 
                <i ng-class="material.hidden ? 'far fa-eye' : 'far fa-eye-slash'"></i> 
            </td>
            <td>@{{ material.created_at}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/material/@{{material.id}}/edit">
                    <i class="far fa-edit"></i>
                    Редактировать</a>
            </td>
        </tr>
    </tbody>

</table>



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
            <th>В индексе</th>
            <th>Видимость</th>
            <th>Дата создания</th>
            <th></th>
        </tr>
    </thead>


    <tbody>
        <tr ng-class="options[$index] || checkboxRecordsAll ? 'table-active' : ''" ng-repeat="page in pages| orderBy:predicate:reverse"">
            <td>
                <input ng-checked="checkboxRecordsAll" value="@{{page.id}}" ng-model="options[$index]"  class='checkbox-record' name="pageId[]" ng-value="@{{page.id}}" type="checkbox">
            </td>
            <td>@{{page.name}}</td>
            <td>
                <a target="_blank" href="/page/@{{page.url}}">Перейти на страницу</a>
            </td>
            <td>
                <i ng-class="page.index ? 'fas fa-search' : 'fas fa-search-minus'"></i> 
            </td>
            <td> 
                <i ng-class="page.hidden ? 'far fa-eye' : 'far fa-eye-slash'"></i> 
            </td>
            <td>@{{ page.created_at}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/page/@{{page.id}}/edit">
                    <i class="far fa-edit"></i>
                    Редактировать</a>
            </td>
        </tr>
    </tbody>

</table>



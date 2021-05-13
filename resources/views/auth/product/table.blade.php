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
            <th>Каталог</th>
            <th>Цена
                <a href="#" ng-click="sort('price')" class="sortDir" ng-class="{ active: isSorted('price') }">&#x25B2;</a>
                <a href="#" ng-click="sort('-price')" class="sortDir" ng-class="{ active: isSorted('-price') }">&#x25BC;</a>
            </th>
            <th>Артикул</th>

            <th>В индексе</th>
            <th>Видимость</th>
            <th>Дата создания</th>
            <th></th>
        </tr>
    </thead>


    <tbody>
        <tr ng-class="options[$index] || checkboxRecordsAll ? 'table-active' : ''" ng-repeat="product in products| orderBy:predicate:reverse"">
            <td>
                <input ng-checked="checkboxRecordsAll" value="@{{product.id}}" ng-model="options[$index]"  class='checkbox-record' name="productId[]" ng-value="@{{product.id}}" type="checkbox">
            </td>
            <td>@{{product.name}}</td>
            <td>
                <a target="_blank" href="/product/@{{product.url}}">Перейти на страницу продукта</a>
            </td>
            <td>
                <img ng-if="product.img != ''" class="d-block img-fluid" style="width: 50px;" alt="@{{ product.name}}" src="/storage/@{{product.img}}">
            </td>
            <td>@{{product.name_catalog}}</td>
            <td>@{{product.price}}</td>
            <td>@{{product.art}}</td>
            <td>
                <i ng-class="product.index ? 'fas fa-search' : 'fas fa-search-minus'"></i> 
            </td>
            <td> 
                <i ng-class="product.hidden ? 'far fa-eye' : 'far fa-eye-slash'"></i> 
            </td>
            <td>@{{ product.created_at}}</td>
            <td>
                <a class="btn btn-primary btn-sm" href="/admin/product/@{{product.id}}/edit">
                    <i class="far fa-edit"></i>
                    Редактировать</a>
            </td>
        </tr>
    </tbody>

</table>



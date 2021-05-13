<!-- Modal structure -->
<div class="modal-form-menu-item popeye-modal-container"> 

    <div class="modal-form-menu-item__modal-content-menu-item modal-content-menu-item popeye-modal">
        <a class="popeye-close-modal" href ng-click="$close()"></a>
        <div ng-bind-html="messages"></div>
        <form ng-submit="saveMenuItem(formMenuItem.$valid)"  name="formMenuItem" novalidate>

            <div class="form-row">
                <div class="col-xl-4">
                    <div class="form-group" ng-class="{ 'has-error' : formMenuItem.title.$invalid && !formMenuItem.title.$pristine }">
                        <label>Название <span class="required">*</span></label>
                        <input ng-class="{ 'is-invalid' : message.title[0] }" required ng-model="menuItem.title" class="form-control" type="text" placeholder="Название пункта" name="title">
                        <div ng-class="{ 'd-block' : message.title[0] }" ng-bind="message.title[0]" class="invalid-feedback"></div>

                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>Выберите роут <span class="required">*</span></label>

                        <select 
                            ng-class="{ 'is-invalid' : message.route[0] }" 
                            ng-change='getRoute(selectedRoute)'
                            ng-options='route.value as route.name for route in routes track by route.value'
                            name="route" ng-model="selectedRoute" class="form-control select-route">
                            <option value="">произвольный</option>
                        </select>

                        <div ng-class="{ 'd-block' : message.route[0] }" ng-bind="message.route[0]" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="form-group">
                        <label>URL <span class="required">*</span></label>
                        <input ng-class="{ 'is-invalid' : message.url[0] }" ng-model="menuItem.url" class="form-control" type="text" placeholder="URL" name="url">
                        <div ng-class="{ 'd-block' : message.url[0] }" ng-bind="message.url[0]" class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-xl-12">
                    <div class="form-group">
                        <label>Выберите родителя<span class="required">*</span></label>
                        <select-options-menu-items menu-item="menuItem" items="menuItemsModal"></select-options-menu-items>
                        <div ng-class="{ 'd-block' : message.parent_id[0] }" ng-bind="message.parent_id[0]" class="invalid-feedback"></div>
                    </div>
                </div>
            </div>


            <div class="form-row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>Позиция</label>
                        <input ng-class="{ 'is-invalid' : message.position[0] }" ng-model="menuItem.position" class="form-control" type="number" placeholder="Позиция" name="position">
                        <div ng-class="{ 'd-block' : message.position[0] }" ng-bind="message.position[0]" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>Класс</label>
                        <input ng-model="menuItem.class" class="form-control" type="text" placeholder="Класс" name="class">
                    </div>
                </div>
            </div>




            <div class="form-row">
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>Иконка</label>
                        <input ng-model="menuItem.icon" class="form-control" type="text" placeholder="Иконка" name="icon">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>Аттрибуты</label>
                        <input ng-model="menuItem.attr" class="form-control" type="text" placeholder="Аттрибуты" name="attr">
                    </div>
                </div>
            </div>


            <div class="form-row"> 
                <div class="col-xl-12">
                    <div class="form-check">
                        <input ng-checked="menuItem.hidden" ng-true-value="1" ng-false-value="0" ng-model="menuItem.hidden" type="checkbox" name="hidden" id="hidden" class="form-check-input">
                        <label class="form-check-label">Показать/Скрыть</label>
                    </div>
                </div>  
            </div>

            <div class="form-row mt-3">
                <div class="col-xl-12">
                    <div class="form-group">
                        <button type="reset" class="btn btn-primary btn-reset float-left ">Сбросить</button>
                        <button ng-disabled="formMenuItem.$invalid" type="submit" class="btn btn-primary btn-save float-right"><i class="fas fa-save mr-2"></i>Сохранить</button>  
                    </div>
                </div>
            </div>


        </form>

    </div>
</div> 
<script type='text/javascript'>
//Cyrillic To translite
var inputTitle = $('.modal-content-menu-item input[name=title]');
var inputUrl = $('.modal-content-menu-item input[name=url]');
inputTitle.on('blur focus keyup keypress', function (event) {
    inputUrl.val(cyrillicToTranslit().transform(inputTitle.val().toLowerCase(), "_"));
});
</script>
<div class="list-images row">
    <div class="w-100" ng-bind-html="message"></div>

    <div ng-repeat="image in images" class="col-xl-2 card" align="center">

        <form ng-submit="saveImg(formImgItem.$valid, image.id, image)"  name="formImgItem" novalidate>
            <div class="card-img mt-2" style="height: 200px;overflow: hidden;">
                <img src="/storage/@{{image.name}}" alt="@{{image.alt}}" class="card-img-top img-fluid" />
            </div>
            <div class="card-body">
                <div ng-class="{ 'has-error' : formImgItem.alt.$invalid && !formImgItem.alt.$pristine }" class="form-row form-group">
                    <input ng-class="{ 'is-invalid' : message.title[0] }" required ng-model="image.alt" type="text" name="alt" class="form-control" placeholder="ALT Описание">
                    <div ng-class="{ 'd-block' : message.alt[0] }" ng-bind="message.alt[0]" class="invalid-feedback"></div>
                </div>
               
                <button ng-click="deleteImg(image.id)" type="button" class="btn w-100 btn-danger remove-image mt-2"><i class="fas fa-trash mr-2"></i>Удалить</button>
                <button ng-disabled="formImgItem.$invalid" type="submit" class="btn w-100 btn-success save-image  mt-2"><i class="fas fa-save mr-2"></i>Сохранить</button>
            </div>
        </form>

    </div>



</div>
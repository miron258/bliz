<select 
    ng-class="{ 'is-invalid' : message.parent_id[0] }"
    ng-options='item as item.title disable when item.disabled for item in items track by item.id'
    ng-change='getParentId(selected)'
    ng-model="selected" 
    class="form-control select-parent-id">   
    <option value="">Корневой элемент</option>
</select>  


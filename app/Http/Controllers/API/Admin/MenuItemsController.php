<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Admin\MenuController as Menu;
use App\Models\API\Admin\MenuItems;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\MenuItemsRequest as MenuItemsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MenuItemsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//        return view('auth.menuitems.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuItemsRequest $request) {

        $params = $request->all(); //Все данные с инпутов формы

        $menuItem = new MenuItems();
        $menuItem->title = isset($params['title']) ? $params['title'] : '';
        $menuItem->route = isset($params['route']) ? $params['route'] : '';
        $menuItem->url = isset($params['url']) ? $params['url'] : '';
        $menuItem->position = isset($params['position']) ? $params['position'] : 0;
        $menuItem->class = isset($params['class']) ? $params['class'] : '';
        $menuItem->parent_id = (isset($params['parent_id']) && $params['parent_id'] != '') ? $params['parent_id'] : null;
        $menuItem->icon = isset($params['icon']) ? $params['icon'] : '';
        $menuItem->attr = isset($params['attr']) ? $params['attr'] : '';
        $menuItem->hidden = isset($params['hidden']) ? $params['hidden'] : $request->has('hidden');
        $menuId = isset($params['menu_id']) ? (int) $params['menu_id'] : '';
        $menuItem->menu_id = $menuId;


        MenuItems::fixTree();
        $menuItem->save();

        $menuItemsTree = MenuItems::getMenuItemsTree($menuId);
        $menuItemsTreeSelectOptions = formMenuItemsTree($menuItemsTree);
        return response()->json([
                    'success' => true,
                    'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Пункт меню успешно добавлен</div>',
                    'menuItem' => $menuItem,
                    'menuItemsTree' => $menuItemsTree,
                    'menuItemsTreeSelectOptions' => $menuItemsTreeSelectOptions
                        ], 200);
    }

    public function listItems($id) {
        $menuItemsTree = MenuItems::getMenuItemsTree($id);
        $menuItemsTreeSelectOptions = formMenuItemsTree($menuItemsTree);

        if (is_null($menuItemsTree)) {
            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Меню с данным ID не найдено</div>',
                            ], 404);
        }

        return response()->json([
                    'success' => true,
                    'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Данные успещно получены</div>',
                    'menuItemsTree' => $menuItemsTree,
                    'menuItemsTreeSelectOptions' => $menuItemsTreeSelectOptions
                        ], 200);
    }

    public function listItemsExclude($id, $idItem) {
        $menuItemsTree = MenuItems::getMenuItemsTree($id);
        if (is_null($menuItemsTree)) {
            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Меню с данным ID не найдено</div>',
                            ], 404);
        }
        $menuItemsTreeSelectOptions = formMenuItemsTree($menuItemsTree, '', $idItem);
        return response()->json([
                    'success' => true,
                    'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Данные успещно получены</div>',
                    'menuItemsTree' => $menuItemsTree,
                    'menuItemsTreeSelectOptions' => $menuItemsTreeSelectOptions
                        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $menuItem = MenuItems::find($id);
        if (is_null($menuItem)) {
            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Пункт меню с данным ID не найден в БД</div>',
                            ], 404);
        }
        return response()->json([
                    'success' => true,
                    'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Данные успешно получены</div>',
                    'menuItem' => $menuItem,
                        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function update(MenuItemsRequest $request, $id) {
        $params = $request->all(); //Все данные с инпутов формы

        $menuItem = MenuItems::find($id);
        $menuItem->title = isset($params['title']) ? $params['title'] : $menuItem->title;
        $menuItem->url = isset($params['url']) ? $params['url'] : $menuItem->url;
        $menuItem->route = isset($params['route']) ? $params['route'] :  $params['route'];
        $menuItem->position = $params['position'];
        $menuItem->class = $params['class'];
        $menuItem->parent_id = (isset($params['parent_id']) && $params['parent_id'] != '') ? $params['parent_id'] : null;

        $menuItem->icon = $params['icon'];
        $menuItem->attr = $params['attr'];
        $menuItem->hidden = isset($params['hidden']) ? $params['hidden'] : $menuItem->hidden;


        $menuId = isset($params['menu_id']) ? (int) $params['menu_id'] : $menuItem->menu_id;
        $menuItem->menu_id = $menuId;
        MenuItems::fixTree();
        $menuItem->save();
        $menuItemsTree = MenuItems::getMenuItemsTree($menuId);
        $menuItemsTreeSelectOptions = formMenuItemsTree($menuItemsTree);

        return response()->json([
                    'success' => true,
                    'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Пункт меню успешно обновлен</div>',
                    'menuItem' => $menuItem,
                    'menuItemsTree' => $menuItemsTree,
                    'menuItemsTreeSelectOptions' => $menuItemsTreeSelectOptions
                        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItems  $menuItems
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $menuItem = MenuItems::find($id);
        if (is_null($menuItem)) {
            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Пункт меню с данным ID не найден в БД</div>',
                            ], 404);
        }

        $menuItem->delete();

        $menuId = $menuItem->menu_id;
        $menuItemsTree = MenuItems::getMenuItemsTree($menuId);
        $menuItemsTreeSelectOptions = formMenuItemsTree($menuItemsTree);

        return response()->json([
                    'success' => true,
                    'menuItem' => $menuItem,
                    'menuItemsTree' => $menuItemsTree,
                    'menuItemsTreeSelectOptions' => $menuItemsTreeSelectOptions,
                    'message' => '<div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>Пункт меню был успешно удален</div>',
                        ], 200);
    }

}

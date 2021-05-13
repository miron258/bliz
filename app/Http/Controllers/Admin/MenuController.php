<?php

namespace App\Http\Controllers\Admin;

use App\Models\API\Admin\MenuItems as MenuItems;
use App\Http\Controllers\API\Admin\MenuItemsController as MenuItemsController;
use App\Models\Admin\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use Illuminate\Http\Request;

class MenuController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $menus = Menu::paginate(30);
        //Передаем в представление наш массив со страницами
        return view('auth.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {


        return view('auth.menu.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request) {
        $params = $request->all(); //Все данные с инпутов формы
        $menu = new Menu();
        $menu->name = $params['name'];
        $menu->class = $params['class'];
        $menu->order = $params['order'];
        $menu->save();
        return redirect()->route('menu.create')->with('message', 'Меню успешно создано');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu) {
        return view('auth.menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu) {

        $menuItems = MenuItems::where('parent_id', $menu->id)->get();

        return view('auth.menu.form', compact('menu', 'menuItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu) {
        $params = $request->all(); //Все данные с инпутов формы
        $id = $params['menuId'];
        $menu = Menu::find($id);
        $menu->name = $params['name'];
        $menu->class = $params['class'];
        $menu->order = $params['order'];
        $menu->save();
        return redirect()->route('menu.edit', $menu->id)->with('message', 'Меню успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu) {
        $menu->delete();
        return redirect()->route('menu.index')->with('message', 'Меню ' . $menu->name . ' успешно удалено');
    }

}

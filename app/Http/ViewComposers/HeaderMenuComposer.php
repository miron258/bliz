<?php

namespace App\Http\ViewComposers;

use App\Models\Admin\Menu;
use Illuminate\View\View;
use App\Models\API\Admin\MenuItems;

class HeaderMenuComposer
{

    protected $headerMenu;

    function __construct()
    {
        $this->menuItems = new MenuItems;
        //Главное навигационное меню вверху сайта
        $this->headerMenu = array(
            'mainmenujson' => array('mmenu'=> buildMenu($this->menuItems->getMenuItems(1), 'mainMenuMobile', Menu::where('id', 1)->first()->class, true, false)),
            'mainmenuitems' => $this->menuItems->getMenuItems(1),
            'mainmenu' => buildMenu($this->menuItems->getMenuItems(1), 'mainMenu', Menu::where('id', 1)->first()->class),
        );




    }

    /** Привязывание динамических данных к конкретной ячейке в объекте View
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menu', $this->headerMenu);
    }
}

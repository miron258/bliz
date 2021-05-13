<?php

namespace App\Http\ViewComposers;

use App\Models\Admin\Menu;
use Illuminate\View\View;
use App\Models\API\Admin\MenuItems;

class FooterMenuComposer
{

    protected $footerMenu;

    function __construct()
    {
        $this->menuItems = new MenuItems;
        $this->footerMenu = array(
            'footermenu' => buildMenu($this->menuItems->getMenuItems(3), 'footerMenu', Menu::where('id', 3)->first()->class),
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
        $view->with('menu', $this->footerMenu);
    }
}

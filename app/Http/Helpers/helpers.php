<?php
if (!function_exists('latin_to_cyrillic')) {
    function latin_to_cyrillic($latinString)
    {
        $cyr = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
        ];
        $lat = [
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
        ];
        return str_replace($lat, $cyr, $latinString);
    }
}

if (!function_exists('cyrillic_to_latin')) {
    function cyrillic_to_latin($cyrillicString)
    {
        $cyr = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', " "
        ];
        $lat = [
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P',
            'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya', "_"
        ];
        return str_replace($cyr, $lat, $cyrillicString);
    }
}
if (!function_exists('buildMenu')) {


    function buildMenu($arrMenu, $nameMenu, $classMenu, $render=false, $megaMenu = true)
    {
        $mBuilder = Menu::make($nameMenu, function ($m) use ($arrMenu) {
            foreach ($arrMenu as $item) {
                /*
                 * Для родительского пункта меню формируем элемент меню в корне
                 * и с помощью метода id присваиваем каждому пункту идентификатор
                 */
                if ($item->parent_id == 0) {
                    $itemParent = $m->add($item->title, $item->url)->id($item->id);
                    if (!empty($item['icon'])) {

                        $itemParent->append('</span>')
                            ->prepend('<i class="fa ' . $item->icon . '"></i> <span class="text-item">')
                            ->link
                            ->attr($item->attr);
                    }
                } //иначе формируем дочерний пункт меню
                else {
                    //ищем для текущего дочернего пункта меню в объекте меню ($m)
                    //id родительского пункта (из БД)
                    if ($m->find($item->parent_id)) {
                        $itemChild = $m->find($item->parent_id)->add($item->title, $item->url)->id($item->id);
                        if (!empty($item->icon)) {
                            $itemChild->append('</span>')
                                ->prepend('<i class="fa ' . $item->icon . '"></i> <span class="text-item">')
                                ->link
                                ->attr($item->attr);
                        }
                    }
                }
            }
        });

        if ($render){
            return view('custom-menu.custom-menu', [
                'menu' => $mBuilder,
                'classMenu' => $classMenu,
                'megaMenu' => $megaMenu
            ])->render();
        } else {
            return view('custom-menu.custom-menu', [
                'menu' => $mBuilder,
                'classMenu' => $classMenu,
                'megaMenu' => $megaMenu
            ]);
        }


    }

}


if (!function_exists('buildFormMenuItemsTree')) {

    function buildFormMenuItemsTree($menuItemsTree, $prefix = '', $curId = '')
    {

        $i = 0;
        global $i;
        global $optionItems;
        foreach ($menuItemsTree as $k => $v) {
            $selected = '';
            $disabled = '';

            if ($i == 0) {
                $optionItems .= "<option value=''>Корневой элемент</option>";
            }
            if ($v->parent_id == $curId && !is_null($curId)) {
                $selected = 'ng-selected="selected"';
            }
            if ($v->id == $curId && !is_null($curId)) {
                $disabled = 'disabled';
            }
            $title = $prefix . $v->title;
            $optionItems .= "<option {$selected} {$disabled} value='{$v->id}'>{$title}</option>";
            $i++;
            if (isset($v->children)) {
                buildFormMenuItemsTree($v->children, $prefix . '-', $curId);
            }
        }

        return $optionItems;
    }

}

if (!function_exists('formMenuItemsTree')) {


    function formMenuItemsTree($menuItemsTree, $prefix = '', $curId = '')
    {
        $menuItems = array();
        $i = 0;
        foreach ($menuItemsTree as $v) {
            global $menuItems;
            global $i;
            if (empty($i)) {
                $i = 0;
            }
            $index = $i++;
            $menuItems[$index]['id'] = $v->id;
            $menuItems[$index]['title'] = $prefix . $v->title;
            $menuItems[$index]['url'] = $v->url;
            $menuItems[$index]['parent_id'] = $v->parent_id;
            $menuItems[$index]['position'] = $v->position;


            if ($v->parent_id == $curId) {
                $menuItems[$index]['selected'] = true;
            }

            if ($v->id == $curId) {
                $menuItems[$index]['disabled'] = true;
            }

            if (isset($v->children)) {
                formMenuItemsTree($v->children, $prefix . '-', $curId);
            }
        }
        return $menuItems;
    }

}

if (!function_exists('buildTreeCatalogs')) {

    function buildTreeCatalogs($nodes)
    {
        $traverse = function ($array, $prefix = '') use (&$traverse) {
            foreach ($array as $item) {
                echo view('auth.catalog.table-tree',
                    [
                        'item' => $item,
                        'prefix' => $prefix
                    ])->render();
                $traverse($item->children, $prefix . '-');
            }
        };
        $traverse($nodes);
    }

}
if (!function_exists('buildTreeCategories')) {

    function buildTreeCategories($nodes)
    {
        $traverse = function ($array, $prefix = '') use (&$traverse) {
            foreach ($array as $item) {
                echo view('auth.category.table-tree',
                    [
                        'item' => $item,
                        'prefix' => $prefix
                    ])->render();
                $traverse($item->children, $prefix . '-');
            }
        };
        $traverse($nodes);
    }

}
if (!function_exists('buildTreeSelectOptions')) {

    function buildTreeSelectOptions($nodes, $cat = '', $type = 'create')
    {

        $traverse = function ($array, $prefix = '') use (&$traverse, $cat, $type) {

            foreach ($array as $item) {
                if (!empty($cat) && isset($cat)) {

                    //Список рубрик в созданиии каталогов и категорий
                    if ($type == 'create') {
                        $selected = ($item->id == $cat->parent_id) ? 'selected' : '';
                        $disabled = ($cat->id == $item->id) ? 'disabled' : '';
                    }
                    //Список рубрик в созданиии материалов и товаров
                    if ($type == 'update') {
                        $selected = ($item->id == $cat->id_category || $item->id == $cat->id_catalog) ? 'selected' : '';
                        $disabled = '';
                    }
                } else {
                    $disabled = '';
                    $selected = '';
                }

                if (old('parent_id') || old('id_catalog') || old('id_category')) {
                    $selected = (
                        old('parent_id') == $item->id ||
                        old('id_catalog') == $item->id ||
                        old('id_category') == $item->id
                    ) ? 'selected' : '';
                }


                echo "<option $disabled $selected value=" . $item->id . ">" . PHP_EOL . $prefix . $item->name . "</option>";
                $traverse($item->children, $prefix . '-', $cat, $type);
            }
        };
        $traverse($nodes);
    }

}

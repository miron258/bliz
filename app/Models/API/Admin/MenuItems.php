<?php

namespace App\Models\API\Admin;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\API\Admin\MenuItems
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property int $position
 * @property string|null $class
 * @property string|null $icon
 * @property string|null $attr
 * @property int $hidden
 * @property int $parent_id
 * @property int $menu_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|MenuItems[] $childs
 * @property-read int|null $childs_count
 * @property-read \App\Models\Admin\Menu $menu
 * @property-read MenuItems|null $parendId
 * @property-read MenuItems $parent
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereAttr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItems whereUrl($value)
 * @mixin \Eloquent
 */
class MenuItems extends Model {

    protected $table = 'menus_items';
    protected $primarykey = 'id';

    use NodeTrait;

    protected $guarded = [];
    protected $fillable = [
        'id',
        'title',
        'url',
        'position',
        'class',
        'icon',
        'attr',
        'hidden',
        'parent_id',
        'menu_id',
        'created_at',
        'updated_at'
    ];

    static function getMenuItemsTree($id) {
        $menuItems = MenuItems::where('menu_id', $id)->get()->map(function ($item) {
            if (!empty($item->route) && !is_null($item->route)) {
                $item->url = url($item->route, $item->url);
            } else {
                $item->url = $item->url;
            }
            return $item;
        });
        return $menuItems->toTree();
    }

    static function getMenuItems($id) {
        $menuItems = MenuItems::where('menu_id', $id)->get()->map(function ($item) {
            if (!empty($item->route) && !is_null($item->route)) {
                $item->url = url($item->route, $item->url);
            } else {
                $item->url = $item->url;
            }
            return $item;
        });
        return $menuItems;
    }

    //Используем для связывания с таблицей меню JOIN
    //Вытащить меню к которому относится пункт меню
    public function menu() {
        return $this->belongsTo('App\Models\Admin\Menu', 'menu_id');
    }

    /*     * ****************** ПРИМЕРЫ *********************** */

    /**
     * Получить запись с номером телефона пользователя.
     */
    public function parentId() {
        return $this->hasOne('App\Models\API\Admin\MenuItems');
    }

    public function scopeHasChildren($query) {
        return $query->where('id', false);
    }

    public function scopeHidden($query) {
        return $query->where('hidden', 0);
    }

    public function scopeVisible($query) {
        return $query->where('hidden', 1);
    }

    //Вытащить родителя пункта меню
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    //Вытащить дочерние элементы пункта меню
    public function children() {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

}

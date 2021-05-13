<?php

namespace App\Models\Admin;
use App\Models\API\Admin\MenuItems;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Menu
 *
 * @property int $id
 * @property string $name
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\API\Admin\MenuItems[] $mitems
 * @property-read int|null $mitems_count
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Menu extends Model {

//    protected $fillable = ['id',' name', 'order'];
//Получить все пукты конкретного меню
    public function items() {
        return $this->hasMany(MenuItems::class, 'menu_id');
    }

}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Admin\Category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @mixin \Eloquent
 */
class Category extends Model {

    //EVENTS ELOQUENT MODEL
    public static function boot() {
        parent::boot();
        //Срабытывает событие когда удаляется товар
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function(Category $category) {
            if (!empty($category->img)) {
                Storage::delete($category->img);
            }
        });
    }

    use NodeTrait;

    protected $table = 'categories';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
        'name',
        'anons',
        'description',
        'url',
        'position',
        'sort',
        'sort_order',
        'img',
        'hidden',
        'index',
        'parent_id'
    ];
    protected $guarded = ['lft', 'rgt', 'parent_id'];

    /**
     *  @return array $materials
     */
    public function scopePublish($q) {
        return $q->where('hidden', 1);
    }

    public function scopeIndex($q) {
        return $q->where('index', 1);
    }

    public function getPublish() {
        return $this->publish()->get();
    }

    public function getIndex() {
        return $this->index()->get();
    }


    public function category() {
        return $this->hasMany(Catalog::class);
    }

    //Получение всех дочерних категорий
    public function children() {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

//Получения родителя категории
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

//Получение всех материалов из категории
    public function materials() {
        return $this->hasMany(Material::class, 'id_category');
    }

}

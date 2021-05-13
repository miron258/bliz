<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\Admin\Catalog
 *
 * @property int $id
 * @property string $meta_tag_title
 * @property string|null $meta_tag_keywords
 * @property string|null $meta_tag_description
 * @property string $name
 * @property string|null $anons
 * @property string $description
 * @property string $url
 * @property int $parent_id
 * @property int $per_page
 * @property int|null $position
 * @property int|null $sort
 * @property int|null $sort_order
 * @property string|null $img
 * @property string $author
 * @property string $update_author
 * @property int $hidden
 * @property int $index
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereAnons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereMetaTagDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereMetaTagKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereMetaTagTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog wherePerPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereUpdateAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereUrl($value)
 * @mixin \Eloquent
 */
class Catalog extends Model {

    //EVENTS ELOQUENT MODEL
    public static function boot() {
        parent::boot();
        //Срабытывает событие когда удаляется товар
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function(Catalog $catalog) {
            if (!empty($catalog->img)) {
                Storage::delete($catalog->img);
            }
        });
    }

    use NodeTrait;

    protected $table = 'catalogs';
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

    public function catalog() {
        return $this->hasMany(Catalog::class);
    }

    //Получение всех дочерних каталогов
    public function children() {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

//Получения родителя каталога
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

//Получение всех продуктов из каталога
    public function products() {
        return $this->hasMany(Product::class, 'id_catalog');
    }

}

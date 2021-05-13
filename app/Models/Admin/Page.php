<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\Page
 *
 * @property int $id
 * @property string $meta_tag_title
 * @property string|null $meta_tag_keywords
 * @property string|null $meta_tag_description
 * @property string $name
 * @property string|null $anons
 * @property string $description
 * @property string $url
 * @property string $author
 * @property string $update_author
 * @property int $hidden
 * @property int $index
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereAnons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaTagDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaTagKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereMetaTagTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdateAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUrl($value)
 * @mixin \Eloquent
 */
class Page extends Model {

    protected $fillable = [
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
        'name',
        'url',
        'author',
        'update_author',
        'description',
        'anons',
        'index',
        'hidden'
    ];

    //


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

    public function getAllPages($perPage = 100, $name = '') {
        $pages = Page::query();
        if (!is_null($name) && !empty($name)) {
            $pages->where('pages.name', 'like', '%' . $name . '%');
        }
        return $pages->paginate($perPage);
    }

}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Laravel\Scout\Searchable;
use Illuminate\Support\Facades\Storage;
/**
 * App\Models\Admin\Product
 *
 * @property int $id
 * @property string $meta_tag_title
 * @property string|null $meta_tag_keywords
 * @property string|null $meta_tag_description
 * @property string|null $art
 * @property string $name
 * @property string|null $anons
 * @property string $description
 * @property string $url
 * @property int $id_catalog
 * @property int $price
 * @property int|null $old_price
 * @property string|null $img
 * @property string|null $properties
 * @property int|null $count_stock
 * @property string|null $video
 * @property string $author
 * @property string $update_author
 * @property int $sale
 * @property int $new
 * @property int $popular
 * @property int $availability
 * @property int $hidden
 * @property int $index
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAnons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereArt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCountStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIdCatalog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaTagDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaTagKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereMetaTagTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePopular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdateAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereVideo($value)
 * @mixin \Eloquent
 */
class Product extends Model {

    //EVENTS ELOQUENT MODEL
    public static function boot() {
        parent::boot();
        //Срабытывает событие когда удаляется товар
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function(Product $product) {

            if (!empty($product->img)) {
                $images = json_decode($product->img);
                if (is_array($images)) {
                    foreach ($images as $index => $img) {
                        $isDelete = Storage::delete($img);
                    }
                }
            }
        });
    }

    use Searchable;

    protected $fillable = [
        'id', 'name', 'description', 'url'
    ];
    public $asYouType = false;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray() {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }

    public function scopeIndex($q) {
        return $q->where('products.index', 1);
    }

    public function getIndex() {
        return $this->index()->get();
    }

    public function scopePublish($q) {
        return $q->where('products.hidden', 1);
    }

    public function getPublish() {
        return $this->publish()->get();
    }

    public function getAllProducts($perPage = 100, $idCatalog = '', $price = '', $name = '', $art = '') {


        $products = Product::join('catalogs', 'products.id_catalog', '=', 'catalogs.id')
                ->select(array('products.*', 'catalogs.name as name_catalog', 'catalogs.id as idCatalog'));

        if (!is_null($idCatalog) && !empty($idCatalog)) {
            $products->whereIdCatalog($idCatalog);
        }
        if (!is_null($price) && !empty($price)) {
            $products->where('products.price', 'like', '%' . $price . '%');
        }
        if (!is_null($name) && !empty($name)) {
            $products->where('products.name', 'like', '%' . $name . '%');
        }
        if (!is_null($art) && !empty($art)) {
            $products->where('products.art', 'like', '%' . $art . '%');
        }

        $paginator = $products->paginate($perPage);

//Обрабатываем все элементы массива
        $items = $paginator->getCollection()->transform(function ($product, $key) {
                    if (!empty($product->img)) {
                        $product->img = json_decode($product->img)[0];
                    }
                    return $product;
                })->toArray();

        return $itemsTransformedAndPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $paginator->total(),
                $paginator->perPage(),
                $paginator->currentPage(), [
            'path' => \Request::url(),
            'query' => [
                'page' => $paginator->currentPage()
            ]
                ]
        );
    }

    /**
     * 
     * @param integer $id
     * @return object $product
     */
    public function getProduct($id) {
        return $products = DB::table('products')
                ->join('catalogs', 'products.id_catalog', '=', 'catalogs.id')
                ->select('products.*', 'catalogs.name, catalogs.id')
                ->where("products.id", '=', $id)
                ->get()
                ->limit(1);
    }

    /**
     * Получить информацию о категории материала
     */
    public function catalog() {
        return $this->belongsTo(Catalog::class, 'id_catalog');
    }

}

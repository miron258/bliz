<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Storage;

class Material extends Model {

    //EVENTS ELOQUENT MODEL
    public static function boot() {
        parent::boot();
        //Срабытывает событие когда удаляется товар
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function(Material $material) {

            if (!empty($material->img)) {
                $images = json_decode($material->img);
                if (is_array($images)) {
                    foreach ($images as $index => $img) {
                        $isDelete = Storage::delete($img);
                    }
                }
            }
        });
    }

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

    public function getAllMaterials($perPage = 100, $idCategory = '', $name = '') {


        $materials = Material::join('categories', 'materials.id_category', '=', 'categories.id')
                ->select(array('materials.*', 'categories.name as name_category', 'categories.id as idCategory'));

        if (!is_null($idCategory) && !empty($idCategory)) {
            $materials->whereIdCategory($idCategory);
        }
        if (!is_null($name) && !empty($name)) {
            $materials->where('materials.name', 'like', '%' . $name . '%');
        }

        $paginator = $materials->paginate($perPage);

//Обрабатываем все элементы массива
        $items = $paginator->getCollection()->transform(function ($material, $key) {
                    if (!empty($material->img)) {
                        $material->img = json_decode($material->img)[0];
                    }
                    return $material;
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
     * @return object $material
     */
    public function getMaterial($id) {
        return $products = DB::table('materials')
                ->join('materials', 'materials.id_category', '=', 'categories.id')
                ->select('categories.*', 'categories.name, categories.id')
                ->where("categories.id", '=', $id)
                ->get()
                ->limit(1);
    }

    /**
     * Получить информацию о категории материала
     */
    public function category() {
        return $this->belongsTo(Category::class, 'id_category');
    }

}

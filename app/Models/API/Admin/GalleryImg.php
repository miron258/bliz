<?php

namespace App\Models\API\Admin;

use Illuminate\Database\Eloquent\Model;

class GalleryImg extends Model {

    protected $table = 'gallery_imgs';

    static function getGalleryImages($id) {
        $images = GalleryImg::where('id_gallery', $id)->get();
        return $images;
    }

    static function getImg($id) {
        $image = GalleryImg::where('id', $id)->get()->first();
        return $image;
    }

}

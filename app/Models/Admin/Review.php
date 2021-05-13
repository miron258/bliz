<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Review extends Model
{
    protected $table = 'reviews';

    //EVENTS ELOQUENT MODEL
    public static function boot() {
        parent::boot();
        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function(Review $review) {
            if (!empty($review->img)) {
                Storage::delete($review->img);
            }
        });
    }
    /**
     *  @return array $materials
     */
    public function scopePublish($q) {
        return $q->where('hidden', 1);
    }

    public function getPublish() {
        return $this->publish()->get();
    }



}

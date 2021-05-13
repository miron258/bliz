<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getReviews(){

        $reviews = Review::publish()->get();

        if (is_null($reviews)){
            return response()->json([
                'success' => false,
                'message' => '',
                'reviews' => $reviews
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'message' => '',
                'reviews' => $reviews
            ], 200);
        }




    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Review;
use App\Http\Requests\Admin\ReviewRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::paginate(30);
        //Передаем в представление наш массив со страницами
        return view('auth.review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.review.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request)
    {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $review = new Review();
        $review->name = $params['name'];
        $review->anons = $params['anons'];
        $review->text = $params['text'];
        $review->text_order = $params['text_order'];
        $review->address = $params['address'];
        $review->hidden = 1;

        if ($request->has('image')) {
            $path = $request->file('image')->store('reviews');

            $width = 84; // your max width
            $height = 84; // your max height
            $img = Image::make('storage/'.$path);
            $img->height() > $img->width() ? $width=null : $height=null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            //Перезаписываем и сохраняем образанное изображение
            $img->save('storage/'.$path);
            $review->img = $path;
        }

        $review->save();
        return redirect()->route('review.create')->with('message', 'Отзыв успешно создан');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return view('auth.review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        return view('auth.review.form', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $id = $params['reviewId'];

        $review = Review::find($id);
        $review->name = $params['name'];
        $review->anons = $params['anons'];
        $review->text = $params['text'];
        $review->text_order = $params['text_order'];
        $review->address = $params['address'];
        $review->hidden = $request->has('hidden');


        if ($request->has('image')) {
            $isDelete = Storage::delete($review->img);
            $path = $request->file('image')->store('reviews');

            $width = 84; // your max width
            $height = 84; // your max height
            $img = Image::make('storage/'.$path);
            $img->height() > $img->width() ? $width=null : $height=null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            //Перезаписываем и сохраняем образанное изображение
            $img->save('storage/'.$path);
            $review->img = $path;
        }

        $review->save();
        return redirect()->route('review.edit', $review->id)->with('message', 'Отзыв ' . $review->name . ' успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('review.index')->with('message', 'Отзыв ' . $review->name . ' успешно удален');
    }
}

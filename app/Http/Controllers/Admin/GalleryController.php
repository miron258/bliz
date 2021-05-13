<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Gallery;
use App\Models\Admin\GalleryImg;
use App\Http\Requests\Admin\GalleryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $galleries = Gallery::paginate(30);
        //Передаем в представление наш массив со страницами
        return view('auth.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('auth.gallery.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $gallery = new Gallery();
        $gallery->name = $params['name'];
        $nameFolder = strtolower(cyrillic_to_latin($params['name']));
        $gallery->path = "galleries/" . $nameFolder;
        Storage::makeDirectory($gallery->path);
        $gallery->header = $params['header'];
        $gallery->class = (empty($params['class'])) ? "gallery_" . $nameFolder : $params['class'];
        $gallery->description = $params['description'];
        $gallery->hidden = 1;
        $gallery->author = $user->name;
        $gallery->update_author = $user->name;

        $gallery->save();
        return redirect()->route('gallery.create')->with('message', 'Галерея успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery) {


        return view('auth.gallery.form', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $id = $params['galleryId'];

        $gallery = Gallery::find($id);
        $gallery->name = $params['name'];
        $gallery->header = $params['header'];
        $gallery->class = $params['class'];
        $gallery->description = $params['description'];
        $gallery->hidden = $request->has('hidden');
        $gallery->author = $gallery->author;
        $gallery->update_author = $user->name;

        $gallery->save();
        return redirect()->route('gallery.edit', $gallery->id)->with('message', 'Галерея ' . $gallery->name . ' успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery) {
        $gallery->delete(); //Удаляем галерею из базы данных
        Storage::deleteDirectory($gallery->path); //Удаляем директорию с файлами галереи

        return redirect()->route('gallery.index')->with('message', 'Галерея ' . $gallery->name . ' успешно удалена');
    }

}

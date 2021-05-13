<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Http\Requests\Admin\PageRequest;
use Illuminate\Http\Request;


class PageController extends Controller {

    public function __construct() {
        //Подключение модели продукта
        $this->page = new Page;
    }

    //AJAX QUERY

    public function tablePages() {
        return view('auth.pages.table');
    }

    public function getPages(Request $request) {
        $numPage = $request->input('page'); //Номер страницы
        $name = $request->input('name');
        return $pages = $this->page->getAllPages(100, $name);
    }

    public function index() {
        //Передаем в представление наш массив со страницами
        return view('auth.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('auth.pages.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();

        $page = new Page();
        $page->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $page->meta_tag_description = $params['meta_tag_description'];
        $page->meta_tag_keywords = $params['meta_tag_keywords'];
        $page->name = $params['name'];
        $page->url = $params['url'];
        $page->class_page = $params['url'];
        $page->anons = $params['anons'];
        $page->description = $params['description'];
        $page->html = $params['html'];
        $page->index = 1;
        $page->hidden = 1;
        $page->author = $user->name;
        $page->update_author = $user->name;

        $page->save();
        return redirect()->route('page.create')->with('message', 'Страница успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page) {

        return view('auth.pages.show', compact('page'));

//       $page = Page::where('id',$id)->first();
//      return view('display-article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page) {
        return view('auth.pages.form', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page) {
        $params = $request->all(); //Все данные с инпутов формы
        $user = auth()->user();
// Если получать в Facade то так $user = Auth::user();

        $id = $params['pageId'];

        $page = Page::find($id);
        $page->meta_tag_title = (empty($params['meta_tag_title'])) ? $params['name'] : $params['meta_tag_title'];
        $page->meta_tag_description = $params['meta_tag_description'];
        $page->meta_tag_keywords = $params['meta_tag_keywords'];
        $page->name = $params['name'];
        $page->url = $params['url'];
        $page->class_page = $params['class_page'];
        $page->anons = $params['anons'];
        $page->description = $params['description'];
        $page->html = $params['html'];
        $page->index = $request->has('index');
        $page->hidden = $request->has('hidden');
        $page->author = $page->author;
        $page->update_author = $user->name;


        $page->save();
        return redirect()->route('page.edit', $page->id)->with('message', 'Страница ' . $page->name . ' успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids) {
        if ($ids && !empty($ids)) {
            $ids = explode(",", $ids);
            Page::find($ids)->each(function ($page, $key) {

//Удаляем саму страницу
                $page->delete();
            });

            $pages = $this->page->getAllPages();
            return response()->json([
                        'success' => true,
                        'pages' => $pages,
                        'message' => '<div class="alert alert-success">Страница(ы) успешно удалены</div>',
                            ], 200);
        } else {
            return response()->json([
                        'success' => false,
                        'message' => '<div class="alert alert-danger">Не удалось удалить страница(ы)</div>',
                            ], 500);
        }
    }

}

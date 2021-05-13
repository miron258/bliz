<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Admin\Catalog;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index($url)
    {
        $page = Page::where('url', $url)->publish()->first(); //First значить возврать единственный элмент одну строку массива используется LIMIT


        if (is_null($page)) {
            return response()
                ->view(
                    'errors.404',
                    ['message' => 'Такая страница не найдена', 'meta_tag_title' => 'Страница не найдена 404'],
                    404);
        } else {
            return view('page.index', compact('page'));
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Page;

class MainController extends Controller {

    public function index(Request $request)
    {
        $page = Page::where('url', 'main')->publish()->first();
        return view('index', compact('page'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PageController extends Controller
{

    public function show($page)
    {
        //return view('pages.show', ['page' => $page]);
        return view('pages.show', ['page' => Page::findOrFail($page)]);
    }

    public function index()
    {
        return view('pages.index', ['pages' => Page::all()]);
    }

}